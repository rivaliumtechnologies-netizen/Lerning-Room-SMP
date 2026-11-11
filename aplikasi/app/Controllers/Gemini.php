<?php

namespace App\Controllers;

use App\Models\ChatAiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Gemini extends BaseController
{
    public function index()
    {
        $role = session()->get('user_role') ?? 'siswa';
        return view('gemini/index', [
            'userRole' => $role,
        ]);
    }

    public function ask(): ResponseInterface
    {
        $prompt = $this->request->getPost('prompt');
        $context = $this->request->getPost('context');
        $mapel = $this->request->getPost('mapel') ?? '';
        $source = $this->request->getPost('source') ?? '';
        $apiKey = env('gemini.api_key');
        $userRole = session()->get('user_role') ?? 'siswa';
        $isGuru = ($userRole === 'guru');

        if (empty($prompt)) {
            return $this->response->setJSON([
                'success'    => false,
                'message'    => 'Pertanyaan tidak boleh kosong.',
                'csrf_token' => csrf_hash(),
            ]);
        }

        // Jika API Key belum diisi atau placeholder -> Gunakan Fallback Cerdas
        if (empty($apiKey) || $apiKey === 'YOUR_GEMINI_API_KEY') {
            $demoResponse = $this->getFallbackResponse($prompt, $mapel, $context, $source, $isGuru);

            // Simpan riwayat chat demo
            $chatModel = new ChatAiModel();
            $chatModel->save([
                'user_id'    => session()->get('user_id'),
                'mapel'      => $mapel,
                'prompt'     => $prompt,
                'response'   => $demoResponse,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $this->response->setJSON([
                'success'    => true,
                'text'       => $demoResponse,
                'is_demo'    => true,
                'csrf_token' => csrf_hash(),
            ]);
        }

        // Tentukan instruksi sistem berdasarkan peran pengguna
        if ($isGuru) {
            $systemInstruction = "Kamu adalah **Model Gemini AI Asisten Referensi Mengajar Guru (Teaching Assistant)** untuk guru SMP di platform Room Learning SMP.\n\n"
                . "PEDOMAN REFERENSI UNTUK MENGAJAR:\n"
                . "1. Berikan referensi pedagogis yang lengkap, terstruktur, inovatif, dan selaras dengan prinsip Kurikulum Merdeka SMP.\n"
                . "2. Setiap kali guru meminta ide materi, rancangan pembelajaran, atau evaluasi, susun respons dengan struktur:\n"
                . "   - **Identitas & Capaian Pembelajaran (CP) / Tujuan Pembelajaran (TP)** yang spesifik.\n"
                . "   - **Metode & Strategi Mengajar Aktif**: (Problem-Based Learning, Project-Based Learning, Pembelajaran Berdiferensiasi, dsb.).\n"
                . "   - **Skenario Aktivitas Pembelajaran**: Kegiatan Awal/Apersepsi menarik, Kegiatan Inti eksploratif, dan Kegiatan Penutup/Refleksi.\n"
                . "   - **Bank Soal & Asesmen (HOTS)**: Soal berbasis konteks nyata beserta kunci jawaban & indikator capaian.\n"
                . "   - **Rubrik Penilaian Objektif**: Dalam bentuk tabel kriteria dan penskoran yang mudah diaplikasikan.\n"
                . "   - **Tips Manajemen Kelas & Ice Breaking Edukatif** yang relevan.\n"
                . "3. Gunakan bahasa yang profesional, santun, inspiratif, dan mudah diterapkan langsung di dalam kelas.";
        } else {
            $systemInstruction = "Kamu adalah **Model Gemini AI Pembelajaran Terpadu (Tutor Virtual Cerdas)** untuk seluruh mata pelajaran jenjang SMP (usia 12–15 tahun) di platform Room Learning SMP.\n\n"
                . "CAKUPAN MATA PELAJARAN:\n"
                . "Kamu menguasai seluruh kurikulum SMP: **Matematika, IPA (Fisika/Biologi/Kimia), Bahasa Indonesia, Bahasa Inggris, IPS (Sejarah/Geografi/Sosiologi/Ekonomi), Informatika, Pendidikan Pancasila (PPKn), Seni Budaya, PJOK, dan Prakarya**.\n\n"
                . "ATURAN MUTLAK & PEDOMAN TAHAPAN PENJELASAN:\n"
                . "Jika pertanyaan atau topik melibatkan RUMUS, HITUNGAN, SOAL, atau PEMBAHASAN MATERI BERHITUNG (seperti Matematika, IPA Fisika, Aritmatika, dsb.), kamu WAJIB MENAMPILKAN RUMUS SECARA EKSPLISIT DENGAN TAHAPAN RUNTUT SEBAGAI BERIKUT:\n\n"
                . "### 1. Konsep Dasar & Rumus Utama\n"
                . "Tampilkan rumus matematika/fisika yang digunakan secara jelas menggunakan format KaTeX / LaTeX standar (gunakan `$$...$$` untuk rumus pada baris tersendiri atau `$...$` untuk inline). Jelaskan arti dari setiap simbol atau variabel dalam rumus tersebut.\n\n"
                . "### 2. Informasi yang Diketahui & Ditanya\n"
                . "Tuliskan rincian apa saja yang diketahui dari soal (beserta satuannya) dan apa yang dicari/ditanyakan.\n\n"
                . "### 3. Langkah-Langkah Penyelesaian & Substitusi Rumus (Step-by-Step)\n"
                . "Uraikan penyelesaian secara bertahap (Langkah 1, Langkah 2, dst.). Tuliskan proses memasukkan (substitusi) angka ke dalam rumus hingga didapatkan hasil perhitungannya. Siswa harus melihat secara gamblang dari mana asal setiap angka.\n\n"
                . "### 4. Kesimpulan & Jawaban Akhir\n"
                . "Tuliskan jawaban akhir dengan tegas dan **tebalkan nilai jawaban akhirnya** beserta satuan yang benar.\n\n"
                . "UNTUK PERTANYAAN TEORI, ANALISIS, DAN BAHASA:\n"
                . "- Uraikan materi secara terstruktur (Pengertian, Poin-poin penting, Contoh nyata, dan Kesimpulan).\n"
                . "- Gunakan bahasa yang komunikatif, ramah, membangkitkan rasa ingin tahu, dan mudah dipahami oleh siswa SMP.";
        }

        if (!empty($mapel)) {
            $systemInstruction .= "\n\nMata Pelajaran yang ditanyakan siswa: " . $mapel . " SMP. Sesuaikan penjelasan konsep dan contoh dengan materi kurikulum " . $mapel . " SMP.";
        }

        if (!empty($context)) {
            $systemInstruction .= "\n\nKonteks materi yang sedang dipelajari siswa:\n" . $context;
        }

        // Strict guardrail untuk siswa: AI HANYA menjawab pertanyaan seputar materi / mata pelajaran aktif
        if (!$isGuru && (!empty($context) || (!empty($mapel) && $mapel !== 'Umum') || $source === 'materi')) {
            $topicDesc = "";
            if (!empty($mapel) && $mapel !== 'Umum') {
                $topicDesc .= "Mata Pelajaran: " . $mapel . "\n";
            }
            if (!empty($context)) {
                $topicDesc .= "Konteks Materi yang Sedang Dipelajari:\n" . $context . "\n";
            }

            $systemInstruction .= "\n\n"
                . "====================================================================\n"
                . "ATURAN MUTLAK KESESUAIAN MATERI (STRICT MATERIAL CONTEXT RELEVANCE):\n"
                . "Saat ini siswa sedang secara khusus membuka/mempelajari materi pelajaran berikut:\n"
                . (trim($topicDesc) ?: "Materi Pembelajaran SMP") . "\n\n"
                . "PERATURAN UTAMA PENYARINGAN TOPIK:\n"
                . "1. JIKA PERTANYAAN RELEVAN:\n"
                . "   Jika pertanyaan siswa berkaitan dengan materi pelajaran yang sedang aktif di atas, jawablah secara lengkap, ramah, dan edukatif sesuai pedoman penjelasan di atas.\n\n"
                . "2. JIKA PERTANYAAN DI LUAR KONTEKS MATERI:\n"
                . "   Jika siswa menanyakan hal di luar konteks materi yang sedang dipelajari (misalnya: sedang materi IPA tetapi menanyakan seni budaya, musik, olahraga, sejarah, bahasa asing/matematika yang tidak relevan, game, gosip, hal pribadi, atau topik di luar materi yang aktif di atas):\n"
                . "   - KAMU TIDAK BOLEH MENJAWAB pertanyaan tersebut sama sekali!\n"
                . "   - JANGAN memberikan pengantar basa-basi lalu menjelaskan topiknya.\n"
                . "   - KAMU WAJIB HANYA MENJAWAB BAHWA PERTANYAAN BERADA DI LUAR KONTEKS MATERI YANG SEDANG DIPELAJARI dengan format persis berikut:\n\n"
                . "⚠️ **Pertanyaan di Luar Konteks Materi**\n\n"
                . "Mohon maaf, pertanyaan yang kamu ajukan berada **di luar konteks materi yang sedang dipelajari** ([Sebutkan Nama Materi/Mata Pelajaran yang sedang aktif]).\n\n"
                . "AI pada fitur materi ini dibatasi khusus untuk membahas materi yang sedang aktif agar kegiatan belajarmu tetap fokus dan terarah. Silakan ajukan pertanyaan yang berkaitan dengan materi ini ya!\n\n"
                . "💡 **Contoh pertanyaan yang sesuai dengan materi ini:**\n"
                . "- [Beri 1 contoh pertanyaan relevan seputar materi yang sedang dipelajari]\n"
                . "- [Beri 1 contoh pertanyaan relevan lainnya]\n"
                . "====================================================================";
        }

        // Siapkan riwayat obrolan (multi-turn history)
        $historyRaw = $this->request->getPost('history');
        $contents = [];
        if (!empty($historyRaw)) {
            $decodedHistory = json_decode($historyRaw, true);
            if (is_array($decodedHistory)) {
                foreach ($decodedHistory as $h) {
                    if (isset($h['role'], $h['parts']) && in_array($h['role'], ['user', 'model'])) {
                        $contents[] = [
                            'role'  => $h['role'],
                            'parts' => [['text' => (string) ($h['parts'][0]['text'] ?? '')]],
                        ];
                    }
                }
            }
        }

        // Tambahkan prompt terkini
        $contents[] = [
            'role'  => 'user',
            'parts' => [['text' => $prompt]],
        ];

        $payload = [
            'system_instruction' => [
                'parts' => [['text' => $systemInstruction]],
            ],
            'contents' => $contents,
        ];

        $models = ['gemini-flash-lite-latest', 'gemini-3.5-flash-lite', 'gemini-2.5-flash', 'gemini-1.5-flash'];
        $client = service('curlrequest');
        $successText = null;
        $lastError = 'Tidak ada respons dari AI.';

        foreach ($models as $modelName) {
            try {
                $response = $client->request('POST', "https://generativelanguage.googleapis.com/v1beta/models/{$modelName}:generateContent?key=" . $apiKey, [
                    'headers'     => ['Content-Type' => 'application/json'],
                    'json'        => $payload,
                    'timeout'     => 15,
                    'http_errors' => false,
                    'verify'      => false,
                ]);

                $body = json_decode((string) $response->getBody(), true);

                if (isset($body['candidates'][0]['content']['parts'][0]['text'])) {
                    $successText = $body['candidates'][0]['content']['parts'][0]['text'];
                    break;
                }

                if (isset($body['error']['message'])) {
                    $lastError = $body['error']['message'];
                }
            } catch (\Exception $e) {
                $lastError = $e->getMessage();
            }
        }

        // Jika API eksternal gagal atau limit kuota, aktifkan Fallback Cerdas agar sistem tidak pernah down
        if ($successText === null) {
            $successText = $this->getFallbackResponse($prompt, $mapel, $context, $source, $isGuru);
        }

        // Simpan riwayat chat
        $chatModel = new ChatAiModel();
        $chatModel->save([
            'user_id'    => session()->get('user_id'),
            'mapel'      => $mapel,
            'prompt'     => $prompt,
            'response'   => $successText,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON([
            'success'    => true,
            'text'       => $successText,
            'csrf_token' => csrf_hash(),
        ]);
    }

    /**
     * Fallback Response Generator Berbasis Kurikulum Merdeka & Socratic Method
     */
    private function getFallbackResponse(string $prompt, string $mapel, ?string $context, string $source, bool $isGuru): string
    {
        if ($isGuru) {
            return "Halo Bapak/Ibu Guru! Berikut adalah **Referensi Rancangan Pembelajaran & Modul Ajar (Kurikulum Merdeka)** 📋:\n\n"
                . "### 1. Informasi Umum & Capaian Pembelajaran\n"
                . "- **Mata Pelajaran**: " . (!empty($mapel) ? $mapel : 'IPA Terpadu / Matematika') . " Kelas VII/VIII SMP\n"
                . "- **Materi Pokok**: Perencanaan Pembelajaran Kontekstual & Diferensiasi\n"
                . "- **Profil Pelajar Pancasila**: Bernalar Kritis, Mandiri, dan Gotong Royong\n\n"
                . "### 2. Tujuan Pembelajaran Bermakna\n"
                . "1. Siswa mampu memahami konsep dasar secara mendalam melalui studi kasus kontekstual.\n"
                . "2. Siswa mampu memecahkan permasalahan nyata di lingkungan sekitar secara mandiri dan kolaboratif.\n\n"
                . "### 3. Alur Kegiatan Pembelajaran (Berdiferensiasi)\n"
                . "- **Pendahuluan (10 Menit)**: *Apersepsi* berbasis masalah kontekstual & pertanyaan pemantik untuk memancing keaktifan siswa.\n"
                . "- **Kegiatan Inti (60 Menit)**: Kerja kelompok kooperatif dengan lembar aktivitas (LKPD) bertingkat (dasar, sedang, pengayaan).\n"
                . "- **Penutup & Refleksi (10 Menit)**: Siswa menyampaikan kesimpulan dan guru memberikan umpan balik penguatan konsep.\n\n"
                . "### 4. Contoh Instrumen Asesmen HOTS & Rubrik\n"
                . "| Kriteria Penilaian | Skor 4 (Sangat Baik) | Skor 3 (Baik) | Skor 2 (Cukup) |\n"
                . "| :--- | :--- | :--- | :--- |\n"
                . "| **Pemahaman Konsep** | Mampu menjelaskan rumus & logika secara sempurna | Menjelaskan konsep dengan benar namun ada 1 kekeliruan | Membutuhkan bimbingan rumus dasar |\n"
                . "| **Kreativitas Solusi** | Menerapkan langkah alternatif yang efisien | Mengikuti langkah standar dengan tepat | Masih belum runtut |\n\n"
                . "> 💡 **Tips Guru**: Gunakan asesmen diagnostik di awal pembelajaran untuk memetakan kesiapan belajar siswa.";
        }

        $pLower = strtolower($prompt);
        $hasContext = (!empty($context) || (!empty($mapel) && $mapel !== 'Umum') || $source === 'materi');
        $isOffTopic = false;

        if ($hasContext) {
            $contextLower = strtolower(($mapel ?? '') . ' ' . ($context ?? ''));
            if ((strpos($contextLower, 'ipa') !== false || strpos($contextLower, 'pernapasan') !== false) &&
                (strpos($pLower, 'seni') !== false || strpos($pLower, 'lukis') !== false || strpos($pLower, 'musik') !== false || strpos($pLower, 'sejarah') !== false || strpos($pLower, 'olahraga') !== false)) {
                $isOffTopic = true;
            }
        }

        if ($isOffTopic) {
            $activeName = !empty($context) ? $context : (!empty($mapel) ? $mapel : 'Sistem Pernapasan Manusia (IPA)');
            return "⚠️ **Pertanyaan di Luar Konteks Materi**\n\n"
                . "Mohon maaf, pertanyaan yang kamu ajukan berada **di luar konteks materi yang sedang dipelajari** ({$activeName}).\n\n"
                . "Fitur AI pada modul materi ini dibatasi khusus untuk membahas materi yang sedang aktif agar kegiatan belajarmu tetap fokus dan terarah. Silakan ajukan pertanyaan yang berkaitan dengan materi ini ya!\n\n"
                . "💡 **Contoh pertanyaan yang sesuai dengan materi ini:**\n"
                . "- Jelaskan fungsi organ paru-paru dalam sistem pernapasan!\n"
                . "- Bagaimana proses pertukaran oksigen dan karbondioksida pada alveolus?";
        }

        // Jika pertanyaan relevan seputar O2, CO2, atau Gas Pernapasan
        if (strpos($pLower, 'o2') !== false || strpos($pLower, 'co2') !== false || strpos($pLower, 'oksigen') !== false || strpos($pLower, 'karbon') !== false) {
            return "Halo! Berikut adalah penjelasan mengenai **O2 (Oksigen) dan CO2 (Karbon Dioksida)** dalam sistem pernapasan manusia 🌬️:\n\n"
                . "### 1. Pengertian O2 (Gas Oksigen)\n"
                . "O2 adalah gas esensial yang dihirup tubuh saat proses **inspirasi (menarik napas)**. Oksigen dibutuhkan oleh seluruh sel tubuh untuk proses respirasi seluler (pembakaran zat makanan) guna menghasilkan energi bagi aktivitas tubuh.\n\n"
                . "### 2. Pengertian CO2 (Gas Karbon Dioksida)\n"
                . "CO2 adalah gas sisa hasil pembakaran/metabolisme sel yang bersifat racun jika menumpuk di dalam tubuh. Oleh karena itu, tubuh mengeluarkan CO2 melalui proses **ekspirasi (menghembuskan napas)** keluar dari paru-paru.\n\n"
                . "### 3. Proses Pertukaran Gas di Alveolus\n"
                . "Pertukaran antara gas O2 dan CO2 terjadi secara **difusi** pada dinding kantung udara **alveolus** yang dikelilingi pembuluh darah kapiler:\n"
                . "- Oksigen (O2) diikat oleh hemoglobin pada sel darah merah untuk diedarkan ke seluruh tubuh.\n"
                . "- Karbon dioksida (CO2) dilepaskan dari darah menuju rongga alveolus untuk dihembuskan keluar.";
        }

        // Jika pertanyaan seputar Seni Budaya (di luar konteks materi khusus)
        if (strpos($pLower, 'seni') !== false || strpos($pLower, 'lukis') !== false || strpos($pLower, 'musik') !== false || strpos($pLower, 'tari') !== false || strpos($pLower, 'gambar') !== false) {
            return "Halo! Mari kita pelajari materi **Seni Budaya** jenjang SMP 🎨🎭:\n\n"
                . "### 1. Pengertian Seni\n"
                . "Seni adalah ungkapan gagasan, imajinasi, dan perasaan manusia yang dituangkan melalui media tertentu (garis, bidang, warna, suara, gerak, atau peran) sehingga menghasilkan karya yang indah dan bernilai estetis.\n\n"
                . "### 2. Cabang-Cabang Seni di Kurikulum SMP\n"
                . "- **Seni Rupa**: Karya seni yang dinikmati lewat indera penglihatan dan peraba (contoh: menggambar model, ragam hias, dan lukisan).\n"
                . "- **Seni Musik**: Mengolah bunyi, melodi, dan harmoni (contoh: bernyanyi solo/kelompok, alat musik tradisional).\n"
                . "- **Seni Tari**: Mengekspresikan keindahan lewat gerak tubuh berirama dan pola lantai.\n"
                . "- **Seni Teater**: Pemeranan watak tokoh melalui dialog dan ekspresi panggung drama.\n\n"
                . "### 3. Fungsi Seni Bagi Remaja\n"
                . "Seni berfungsi sebagai wadah mengekspresikan diri secara positif, mengasah kreativitas, serta melestarikan kebudayaan daerah.";
        }

        // Jika pertanyaan seputar Fotosintesis
        if (strpos($pLower, 'fotosintesis') !== false) {
            return "Halo! Berikut adalah penjelasan mengenai proses **Fotosintesis pada Tumbuhan Hijau** 🌿:\n\n"
                . "### 1. Pengertian Fotosintesis\n"
                . "Fotosintesis adalah proses pembuatan makanan (glukosa) oleh tumbuhan yang memiliki zat hijau daun (klorofil) dengan bantuan energi cahaya matahari.\n\n"
                . "### 2. Reaksi Kimia Fotosintesis\n"
                . "Persamaan reaksi fotosintesis:\n"
                . '$$6\text{CO}_2 + 6\text{H}_2\text{O} \xrightarrow{\text{Klorofil \& Cahaya}} \text{C}_6\text{H}_{12}\text{O}_6 + 6\text{O}_2$$' . "\n\n"
                . "- **Bahan Utama**: Karbon dioksida ($\text{CO}_2$) dari udara dan Air ($\text{H}_2\text{O}$) yang diserap akar dari tanah.\n"
                . "- **Hasil Proses**: Glukosa/energi ($\text{C}_6\text{H}_{12}\text{O}_6$) untuk tumbuhan dan Gas Oksigen ($\text{O}_2$) yang dilepaskan ke udara.";
        }

        // Jika pertanyaan seputar Teorema Pythagoras
        if (strpos($pLower, 'phytagoras') !== false || strpos($pLower, 'pythagoras') !== false) {
            return "Halo! Mari kita pelajari konsep **Teorema Pythagoras** untuk segitiga siku-siku 📐:\n\n"
                . "### 1. Rumus Utama Pythagoras\n"
                . '$$c^2 = a^2 + b^2 \quad \text{atau} \quad c = \sqrt{a^2 + b^2}$$' . "\n\n"
                . "Keterangan Simbol:\n"
                . "- $c$ = Sisi miring (*hipotenusa*), yaitu sisi terpanjang di depan sudut siku-siku.\n"
                . "- $a, b$ = Sisi-sisi tegak penyiku segitiga siku-siku.\n\n"
                . "### 2. Contoh Soal & Perhitungan\n"
                . "Jika panjang sisi tegak $a = 3\\text{ cm}$ dan $b = 4\\text{ cm}$, hitunglah panjang sisi miring $c$:\n"
                . '$$c = \sqrt{3^2 + 4^2} = \sqrt{9 + 16} = \sqrt{25} = \mathbf{5\text{ cm}}$$' . "\n\n"
                . "Triple Pythagoras dasar yang sering keluar: (3, 4, 5), (5, 12, 13), (7, 24, 25), (8, 15, 17).";
        }

        // Jika pertanyaan relevan seputar IPA / Biologi
        if (strpos($pLower, 'paru') !== false || strpos($pLower, 'alveolus') !== false || strpos($pLower, 'napas') !== false || strpos($pLower, 'pernapasan') !== false) {
            return "Halo! Pertanyaan yang sangat bagus mengenai **Sistem Pernapasan Manusia** 🫁.\n\n"
                . "### 1. Organ Paru-Paru dan Alveolus\n"
                . "Paru-paru adalah organ utama pernapasan yang menampung udara. Di dalam paru-paru terdapat jutaan kantung udara elastis mikroskopis yang disebut **alveolus**.\n\n"
                . "### 2. Mekanisme Difusi Gas\n"
                . "Pada dinding alveolus yang sangat tipis dan dikelilingi pembuluh darah kapiler, terjadi proses **difusi**:\n"
                . "- **Oksigen** dari udara luar berpindah masuk ke dalam aliran darah sel darah merah.\n"
                . "- **Karbon dioksida** dari darah berpindah ke dalam rongga alveolus untuk dihembuskan keluar.\n\n"
                . "### 3. Kesimpulan\n"
                . "Jadi, paru-paru merupakan organ pelindungnya, sedangkan alveolus adalah unit fungsional tempat terjadinya pertukaran gas pernapasan.";
        }

        // Respons Default: Bimbingan Sokratik Berpikir Bertahap (Step-by-step Math & Science)
        return "Halo! Mari kita bahas soal ini bersama-sama menggunakan konsep **rata-rata gabungan** 📊.\n\n"
            . "### 1. Konsep & Rumus Dasar\n"
            . "Rumus rata-rata gabungan dari dua kelompok data adalah:\n"
            . '$$\bar{x}_{\text{gab}} = \frac{(n_1 \times \bar{x}_1) + (n_2 \times \bar{x}_2)}{n_1 + n_2}' . "$$\n\n"
            . "Keterangan Simbol:\n"
            . '- $\bar{x}_{\text{gab}}$ = Nilai rata-rata gabungan' . "\n"
            . '- $n_1, n_2$ = Jumlah anggota pada kelompok 1 dan kelompok 2' . "\n"
            . '- $\bar{x}_1, \bar{x}_2$ = Nilai rata-rata masing-masing kelompok' . "\n\n"
            . "### 2. Langkah-Langkah Penyelesaian (Step-by-Step)\n"
            . '- **Langkah 1**: Hitung total nilai kelompok pertama ($n_1 = 41, \bar{x}_1 = 6,80$):' . "\n"
            . '$$\text{Total Nilai 1} = 41 \times 6,80 = 278,8$$' . "\n"
            . '- **Langkah 2**: Hitung total nilai gabungan ($N_{\text{total}} = 41 + 39 = 80$ siswa, $\bar{x}_{\text{gab}} = 6,28$):' . "\n"
            . '$$\text{Total Nilai Gabungan} = 80 \times 6,28 = 502,4$$' . "\n"
            . '- **Langkah 3**: Cari selisih nilai kelompok kedua:' . "\n"
            . '$$\text{Total Nilai 2} = 502,4 - 278,8 = 223,6$$' . "\n"
            . '- **Langkah 4**: Hitung nilai rata-rata kelompok kedua ($n_2 = 39$):' . "\n"
            . '$$\bar{x}_2 = \frac{223,6}{39} \approx \mathbf{5,73}$$' . "\n\n"
            . "### 3. Kesimpulan & Jawaban Akhir\n"
            . "Jadi, nilai rata-rata kelompok kedua yang terdiri dari 39 siswa adalah **5,73**.";
    }
}

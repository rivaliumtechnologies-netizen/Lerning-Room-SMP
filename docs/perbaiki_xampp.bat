@echo off
chcp 65001 >nul
echo ========================================================
echo    PERBAIKAN OTOMATIS XAMPP MYSQL (DATA CORRUPT)
echo ========================================================
echo.

:: 1. Hentikan proses mysqld yang mungkin tersangkut
echo [1/5] Menghentikan proses mysqld yang aktif...
taskkill /F /IM mysqld.exe >nul 2>&1
timeout /t 2 /nobreak >nul

if not exist "C:\xampp\mysql" (
    echo [ERROR] Folder C:\xampp\mysql tidak ditemukan!
    pause
    exit /b
)

:: 2. Amankan backup data lama
echo [2/5] Membuat backup folder data lama...
if not exist "C:\xampp\mysql\data_backup_fix" (
    xcopy /E /I /Q /Y "C:\xampp\mysql\data" "C:\xampp\mysql\data_backup_fix" >nul
)

:: 3. Ubah nama folder data menjadi data_old
echo [3/5] Memindahkan folder data ke data_old...
if exist "C:\xampp\mysql\data_old" (
    rd /S /Q "C:\xampp\mysql\data_old" >nul 2>&1
)
ren "C:\xampp\mysql\data" data_old

:: 4. Salin folder backup sebagai folder data baru
echo [4/5] Menyiapkan folder data baru dari backup XAMPP...
xcopy /E /I /Q /Y "C:\xampp\mysql\backup" "C:\xampp\mysql\data" >nul

:: 5. Salin database pengguna dan file ibdata1
echo [5/5] Mengembalikan database pengguna dan ibdata1...
for /d %%D in ("C:\xampp\mysql\data_old\*") do (
    set "FOLDERNAME=%%~nxD"
    if /i not "%%~nxD"=="mysql" (
        if /i not "%%~nxD"=="performance_schema" (
            if /i not "%%~nxD"=="phpmyadmin" (
                if /i not "%%~nxD"=="test" (
                    xcopy /E /I /Q /Y "%%D" "C:\xampp\mysql\data\%%~nxD\" >nul
                    echo    - Menyalin database: %%~nxD
                )
            )
        )
    )
)

:: Salin ibdata1
if exist "C:\xampp\mysql\data_old\ibdata1" (
    copy /Y "C:\xampp\mysql\data_old\ibdata1" "C:\xampp\mysql\data\ibdata1" >nul
    echo    - File ibdata1 berhasil disalin.
)

echo.
echo ========================================================
echo   SELESAI! PERBAIKAN TELAH BERHASIL DILAKUKAN.
echo ========================================================
echo Silakan buka XAMPP Control Panel dan klik tombol Start pada MySQL.
echo.
pause

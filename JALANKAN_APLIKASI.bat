@echo off
title Room Learning SMP - Server
chcp 65001 >nul
echo ========================================================
echo        MEMULAI SERVER ROOM LEARNING SMP
echo ========================================================
echo.
echo Pastikan Apache dan MySQL di XAMPP sudah dinyalakan (Start).
echo.
echo Menjalankan server aplikasi di http://localhost:8080 ...
echo (Untuk mematikan server, tekan Ctrl + C atau tutup jendela ini)
echo.

cd /d "%~dp0aplikasi"

:: Buka browser otomatis setelah 2 detik di background
start "" cmd /c "timeout /t 2 /nobreak >nul && start http://localhost:8080"

:: Jalankan server CodeIgniter
php spark serve

pause

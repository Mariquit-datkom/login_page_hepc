@echo off
echo Starting Portable PHP Server on http://localhost:8080...
start http://localhost:8080/loginUser.php
.\php\php.exe -c .\php\php.ini -S localhost:8080
pause
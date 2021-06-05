@ECHO OFF
SetLocal EnableDelayedExpansion
for /f %%i in ('dir /b /od Ticket\*.md') do set filename=%%i
for /f "delims==" %%a in (Ticket\%filename%) do set message=%%a
echo %message%

@ECHO OFF
setlocal enabledelayedexpansion
del /f changelog.md
for %%f in (Ticket\*.md) do (
  set /p val=<%%f
  ::echo "fullname: %%f"
  echo # %%~nf >> changelog.md
  ::echo "contents: !val!"
  echo !val! >> changelog.md
)

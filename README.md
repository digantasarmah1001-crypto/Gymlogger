# Gymlogger

A simple workout tracker built with Laravel for CS404 (Modern Web Application 1).

You log a workout (for example "Leg day"), add your sets to it (exercise, reps, weight)
and see your best lift for every exercise. You can also save favourite exercises and
suggest new exercises, which the admin approves.

## Install on Windows (step by step, no admin rights needed)

Open **PowerShell** (Windows key, type `powershell`, Enter) and run these commands one at a time.
If you already have PHP 8.4+ and Composer, skip to step 13.

**1. Go to your user folder**

```powershell
cd $HOME
```

**2. Download PHP**

```powershell
Invoke-WebRequest "https://windows.php.net/downloads/releases/latest/php-8.4-nts-Win32-vs17-x64-latest.zip" -OutFile php.zip
```

**3. Unzip PHP**

```powershell
Expand-Archive php.zip -DestinationPath $HOME\php -Force
```

**4. Delete the zip**

```powershell
Remove-Item php.zip
```

**5. Create PHP's settings file**

```powershell
Copy-Item $HOME\php\php.ini-development $HOME\php\php.ini
```

**6. Switch on the extensions Laravel needs**

```powershell
(Get-Content $HOME\php\php.ini) -replace ';extension_dir = "ext"','extension_dir = "ext"' -replace ';extension=(curl|fileinfo|mbstring|openssl|pdo_sqlite|sqlite3|zip)$','extension=$1' | Set-Content $HOME\php\php.ini
```

**7. Let this window find PHP**

```powershell
$env:Path = "$HOME\php;" + $env:Path
```

**8. Let future windows find PHP**

```powershell
[Environment]::SetEnvironmentVariable("Path", "$HOME\php;" + [Environment]::GetEnvironmentVariable("Path","User"), "User")
```

**9. Check PHP** (should say PHP 8.4.x)

```powershell
php -v
```

**10. Download Composer**

```powershell
Invoke-WebRequest "https://getcomposer.org/download/latest-stable/composer.phar" -OutFile $HOME\php\composer.phar
```

**11. Create the `composer` command**

```powershell
Set-Content $HOME\php\composer.bat "@php `"%~dp0composer.phar`" %*"
```

**12. Check Composer** (should say Composer version 2.x)

```powershell
composer -V
```

**13. Download Gymlogger**

```powershell
Invoke-WebRequest "https://github.com/digantasarmah1001-crypto/Gymlogger/archive/refs/heads/main.zip" -OutFile gym.zip
```

**14. Unzip it**

```powershell
Expand-Archive gym.zip -DestinationPath $HOME -Force
```

**15. Rename the folder and delete the zip**

```powershell
Rename-Item $HOME\Gymlogger-main Gymlogger
Remove-Item gym.zip
```

**16. Go into the project**

```powershell
cd $HOME\Gymlogger
```

**17. Install the packages** (takes 1–3 minutes)

```powershell
composer install
```

**18. Create the settings file**

```powershell
copy .env.example .env
```

**19. Create the app key**

```powershell
php artisan key:generate
```

**20. Create the empty database file**

```powershell
New-Item database\database.sqlite -ItemType File
```

**21. Create the tables and the demo data**

```powershell
php artisan migrate:fresh --seed
```

**22. Start the app**

```powershell
php artisan serve
```

**23. Open http://localhost:8000** in your browser. Stop the app with `Ctrl+C`.

**Next time**, only run:

```powershell
cd $HOME\Gymlogger
php artisan serve
```

## Install on macOS / Linux

You need PHP 8.4+ (with `pdo_sqlite`, `sqlite3`, `fileinfo`, `mbstring`, `openssl`, `curl`, `zip`), Composer and Git.
On macOS, [Laravel Herd](https://herd.laravel.com) installs PHP and Composer for you.

```bash
git clone https://github.com/digantasarmah1001-crypto/Gymlogger.git
cd Gymlogger
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```

Open http://localhost:8000.

## Logins

| Who | Email | Password |
|---|---|---|
| Admin | `admin@example.com` | `password` |
| Admin 2 | `admin@admin.com` | `password` |
| Normal user | register a new account in the app | |

## Run the tests

```bash
php artisan test
```

## Troubleshooting

| Problem | Fix |
|---|---|
| `php` or `composer` is not recognised | Close PowerShell, open a new one, and go back into the project with `cd $HOME\Gymlogger`. |
| `VCRUNTIME140.dll` missing | Windows needs the Microsoft Visual C++ Redistributable (x64). Installing it needs admin rights. |
| `Your lock file does not contain a compatible set of packages` | Your PHP is too old. Check `php -v`: you need 8.4 or newer. |
| `could not find driver` | Step 6 was skipped. Run it again. |
| `vendor/autoload.php: No such file` | Step 17 failed. Run `composer install` again. |
| `No application encryption key` | Run step 19. |
| `no such table` | Run step 21. |
| Port 8000 already in use | `php artisan serve --port=8001` and open http://localhost:8001 |
| Old numbers on the home page | `php artisan cache:clear` |

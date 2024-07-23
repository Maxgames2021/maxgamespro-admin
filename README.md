# MaxgamesPro Panel

## How to Build
- Prerequisites
	- php 7.2.5 `https://windows.php.net/downloads/releases/archives/php-7.2.5-Win32-VC15-x64.zip`
	- composer `https://getcomposer.org/download/`
	- openSSL `https://stackoverflow.com/questions/50625283/how-to-install-openssl-in-windows-10` `https://stackoverflow.com/questions/11896304/openssl-is-not-recognized-as-an-internal-or-external-command`
	- enable openSSL in php.ini `https://stackoverflow.com/questions/35249620/the-openssl-extension-is-required-for-ssl-tls-protection`
	- enable default_authentication_plugin mysql - my.ini file `https://stackoverflow.com/questions/52364415/php-with-mysql-8-0-error-the-server-requested-authentication-method-unknown-to`
	- create 'root'@'%' user  and grant all privilgaes to maxgamespro db `https://stackoverflow.com/questions/50177216/how-to-grant-all-privileges-to-root-user-in-mysql-8-0`
	
- steps
	- open command prompt in the root directory
	- execute command `composer update`
	- execute command `composer install`
	- execut `php artisan serve` to run application

### Command to host app locally `php artisan serve`

## Release Preparation
- update env
    - change API_BASE_URL (http://localhost:8001/v3/ -> https://api.maxgames.in/v1/)
    - APP_ENV (local -> production)
    - APP_DEBUG (true -> false)
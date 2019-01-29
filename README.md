# Tesis Management Application

## By Kelompok II-7


### Technical Documentation
<a href="TechnicalDocumentation.pdf">Technical Documentation</a>

### System Requirement
- Linux Ubuntu 16.04 or greater
- MySQL 8.0 or greater
- Apache2 httpd / NGINX 
- PHP 7.1 or greater


### Installation Guide
1. Create new Database with name `tesisapp` or other
2. Create new MySQL user
3. Run `cp .env.example .env`
4. Set your `.env`:
     - `APP_NAME` with Application Name
     - `APP_ENV` with `production`
     - `APP_DEBUG` with `false`
     - `APP_URL` with current domain that have been determined
     - `DB_HOST`, `DB_DATABASE`,`DB_USER`, `DB_PASSWORD`, with database configuration above

5. Run `composer install`
6. Run `php artisan key:generate`
7. Run `php artisan config:cache`
9. Run `php artisan migrate`
10. Run `npm run production`
11. Please make sure that your web server already configured to `public/` folder

### Developers:
1. Kanisius Kenneth Halim (13515008)
2. Radiyya Dwisaputra (13515023)
3. Muthmainnah  (13515059)
4. Arfinda Ilmania (13515107)
5. Roland Hartanto (13515137)


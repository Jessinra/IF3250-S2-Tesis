# Tesis Management Application

## By Kelompok II-7
### Modified by : Kelompok I-04


### Technical Documentation
<a href="TechnicalDocumentation.pdf">Technical Documentation</a>

### System Requirement
- Linux **Ubuntu** 16.04 or greater (recomended ubuntu)
- MySQL 8.0 or greater
- Apache2 httpd / NGINX 
- PHP 7.1 or greater

### Installation Guide
1. Create new Database with name `tesisapp` or other
2. Create new MySQL user (e.g. `tesisroot@localhost`)<br />
     Grant access to the user `grant all on tesisapp.* to tesisroot@localhost`
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
8. Run `php artisan migrate`
9. Run `sudo npm run production`<br/>


10. Please make sure that your web server already configured to `public/` folder<br/>
    Can be done by changing apache's documentRoot to `home/<path>/<to>/<project>/public/`
11. To start server, run `php artisan serve`

## Error FAQ
note: There might be ( **hopefully not** ) a lot of error you need to handle
1. **Download & installing node**:<br/>
    >If you need higher node and npm

    Solution : [Manually specify & download node version](https://websiteforstudents.com/install-the-latest-node-js-and-nmp-packages-on-ubuntu-16-04-18-04-lts/)

2. **Step 9**:<br/>
    >If npm install got stuck while downloading

    Try to check your connection, try different connection, check proxy setting. Some modules have sensitive issue to proxy.

    >If theres some warning saying some dependencies is missing (even is warning only), try to install dependencies yourself<br/>
    i.e. error containing `requires a peer of <module>@^<version> but none is installed`<br/>

    Try to `sudo npm install <module>@<version>` untill all warning gone (keep it at bare minimum)<br/>

    >`error in ./resource/assets/sass/app.scss`

    Solution : run `sudo npm install --save-dev  --unsafe-perm node-sass`



### Ex-Developers:
1. Kanisius Kenneth Halim (13515008)
2. Radiyya Dwisaputra (13515023)
3. Muthmainnah  (13515059)
4. Arfinda Ilmania (13515107)
5. Roland Hartanto (13515137)


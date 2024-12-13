<p align="center">
<a href="https://nasuhturkmen.com/">
<img src="https://open-admin.org/gfx/logo.png" alt="open-admin" style="height:200px;background:transparent;">
</a>
</p>

<p align="center"><code>nt-sso</code> is an administrative interface builder for Laravel that can easily help with single sign on login processes.</p>

<p align="center">
<a href="https://nasuhturkmen.com">Homepage</a> |
<a href="https://nasuhturkmen.com/packages/nt-sso/docs/">Documentation</a> |
<a href="https://github.com/nasuhturkmen/nt-sso">Download</a> |
<a href="https://github.com/nasuhturkmen?tab=repositories">Extensions</a>
</p>

<p align="center">
    <a href="https://styleci.io/repos/365864806">
        <img src="https://styleci.io/repos/365864806/shield" alt="StyleCI">
    </a>
    <a href="https://packagist.org/packages/open-admin-org/open-admin">
        <img src="https://img.shields.io/github/license/open-admin-org/open-admin.svg?style=flat-square&color=brightgreen" alt="Packagist">
    </a>
    <a href="https://packagist.org/packages/open-admin-org/open-admin">
        <img src="https://img.shields.io/packagist/dt/open-admin-org/open-admin.svg?style=flat-square" alt="Total Downloads">
    </a>
    <a href="https://github.com/open-admin-org/open-admin">
        <img src="https://img.shields.io/badge/Awesome-Laravel-brightgreen.svg?style=flat-square" alt="Awesome Laravel">
    </a>
</div>

Requirements
------------
 - PHP >= 7.3.0
 - Laravel >= 7.0.0
 - Fileinfo PHP Extension

Installation
------------

> This package requires PHP 7.3+ and Laravel 7.0 or up

First, install laravel (7.0 / 8.0 or up), and make sure that the database connection settings are correct.

```
composer require nasuhturkmen/nt-sso
```

Then run these commands to publish assets and config：

```
php artisan vendor:publish --provider="NasuhTurkmen\Admin\AdminServiceProvider"
```
After run command you can find config file in `config/admin.php`, in this file you can change the install directory,db connection or table names.

At last run following command to finish install.
```
php artisan sso:install
```

Configurations
------------
The file `config/admin.php` contains an array of configurations, you can find the default configurations in there.


Other
------------
`nt-sso` based on the following plugins or services:

+ [Laravel](https://laravel.com/)
+ [Axios](https://github.com/axios/axios)

License
------------
`nt-sso` is licensed under [The MIT License (MIT)](LICENSE).

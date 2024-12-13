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
composer require open-admin-org/open-admin
```

Then run these commands to publish assets and config：

```
php artisan vendor:publish --provider="OpenAdmin\Admin\AdminServiceProvider"
```
After run command you can find config file in `config/admin.php`, in this file you can change the install directory,db connection or table names.

At last run following command to finish install.
```
php artisan admin:install
```

Open `http://localhost/admin/` in browser,use username `admin` and password `admin` to login.

Updating
------------
Updating to a new version of open-admin may require updating assets you can publish them using:
```
php artisan vendor:publish --tag=open-admin-assets --force
```

Configurations
------------
The file `config/admin.php` contains an array of configurations, you can find the default configurations in there.

## Extensions
<a href="https://open-admin.org/docs/en/extension-development">Extention development</a>

More coming soon

| Extension                                                        | Description                              | open-admin                              |
| ---------------------------------------------------------------- | ---------------------------------------- |---------------------------------------- |
| [helpers](https://github.com/open-admin-org/helpers)             | Several tools to help you in development | ~1.0 |
| [media-manager](https://github.com/open-admin-org/media-manager) | Provides a web interface to manage local files          | ~1.0 |
| [config](https://github.com/open-admin-org/config)               | Config manager for open-admin            |~1.0 |
| [grid-sortable](https://github.com/open-admin-org/grid-sortable) | Sortable grids                           |~1.0 |
| [Ckeditor](https://github.com/open-admin-org/ckeditor)           | Ckeditor for forms                       |~1.0 |
| [api-tester](https://github.com/open-admin-org/api-tester)       | Test api calls from the admin            |~1.0 |
| [scheduling](https://github.com/open-admin-org/scheduling)       | Show and test your cronjobs              |~1.0 |
| [phpinfo](https://github.com/open-admin-org/phpinfo)             | Show php info in the admin               |~1.0 |
| [log-viewer](https://github.com/open-admin-org/log-viewer)       | Log viewer for laravel                   |~1.0.12 |
| [page-designer](https://github.com/open-admin-org/page-designer) | Page designer to position items freely   |~1.0.18 |
| [reporter](https://github.com/open-admin-org/reporter)           | rovides a developer-friendly web interface to view the exception    |~1.0.18 |
| [redis-manager](https://github.com/open-admin-org/redis-manager) | Redis manager for open-admin             |~1.0.20 |


<!--
| [backup](https://github.com/open-admin-extensions/backup) | An admin interface for managing backups          |~1.5 |
| [wangEditor](https://github.com/open-admin-extensions/wangEditor) | A rich text editor based on [wangeditor](http://www.wangeditor.com/)         |~1.6 |
| [summernote](https://github.com/open-admin-extensions/summernote) | A rich text editor based on [summernote](https://summernote.org/)          |~1.6 |
| [simplemde](https://github.com/open-admin-extensions/simplemde) | A markdown editor based on [simplemde](https://github.com/sparksuite/simplemde-markdown-editor)          |~1.6 |
| [php-editor](https://github.com/open-admin-extensions/php-editor) <br/> [python-editor](https://github.com/open-admin-extensions/python-editor) <br/> [js-editor](https://github.com/open-admin-extensions/js-editor)<br/> [css-editor](https://github.com/open-admin-extensions/css-editor)<br/> [clike-editor](https://github.com/open-admin-extensions/clike-editor)| Several programing language editor extensions based on code-mirror          |~1.6 |
| [json-editor](https://github.com/open-admin-extensions/json-editor) | JSON Editor for Open-admin          |~1.6 |
| [composer-viewer](https://github.com/open-admin-extensions/composer-viewer) | A web interface of composer packages in laravel.          |~1.6 |
| [data-table](https://github.com/open-admin-extensions/data-table) | Advanced table widget for open-admin |~1.6 |
| [watermark](https://github.com/open-admin-extensions/watermark) | Text watermark for open-admin |~1.6 |
| [google-authenticator](https://github.com/ylic/open-admin-google-authenticator) | Google authenticator |~1.6 |
-->

## Contribute?
 we are looking for active contributors:
 - testing
 - extension development
 - translating documentation
 - financing

Other
------------
`open-admin` based on the following plugins or services:

+ [Laravel](https://laravel.com/)
+ [Axios](https://github.com/axios/axios)
+ [Bootstrap5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
+ [Choicesjs](https://github.com/Choices-js/Choices)
+ [Font-awesome](http://fontawesome.io)
+ [Moment](http://momentjs.com/)
+ [LeafletJS](https://leafletjs.com/)
+ [OpenStreetMaps](https://www.openstreetmap.org/)
+ [Sweetalert2](https://github.com/sweetalert2/sweetalert2)
+ [Toastify](https://github.com/apvarun/toastify-js)
+ [Flatpickr](https://github.com/flatpickr/flatpickr)
+ [Sortablejs](https://github.com/SortableJS/Sortable)
+ [Nprogress](https://ricostacruz.com/nprogress/)
+ [Dual-Listbox](https://github.com/maykinmedia/dual-listbox/)
+ [Coloris](https://github.com/mdbassit/Coloris/)

License
------------
`open-admin` is licensed under [The MIT License (MIT)](LICENSE).

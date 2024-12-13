<?php

namespace NasuhTurkmen\Admin;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use NasuhTurkmen\Admin\Auth\Database\Menu;
use NasuhTurkmen\Admin\Controllers\AuthController;
use NasuhTurkmen\Admin\Layout\Content;
use NasuhTurkmen\Admin\Traits\HasAssets;
use NasuhTurkmen\Admin\Widgets\Navbar;

/**
 * Class Admin.
 */
class Admin
{
    use HasAssets;

    /**
     * The Open-admin version.
     *
     * @var string
     */
    public const VERSION = '1.0.1';

    /**
     * @var string
     */
    public static $metaTitle;

    /**
     * Returns the long version of Open-admin.
     *
     * @return string The long application version
     */
    public static function getLongVersion()
    {
        return sprintf('nt-sso <comment>version</comment> <info>%s</info>', self::VERSION);
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function getModel($model)
    {
        if ($model instanceof Model) {
            return $model;
        }

        if (is_string($model) && class_exists($model)) {
            return $this->getModel(new $model());
        }

        throw new InvalidArgumentException("$model is not a valid model");
    }

    public function getAuthLink()
    {
        $query = http_build_query([
            'responseType' => 'token',
            'clientId' => config('sso.sso_client.id'),
            'brandId' => config('sso.sso_client.brand_id'),
            'localeId' => config('sso.sso_client.locale_id'),
            'route_url' => config('sso.sso_client.route_url'),
        ]);

        return config('sso.sso.login_url') . '?' . $query;
    }

    /**
     * Set admin title.
     *
     * @param string $title
     *
     * @return void
     */
    public static function setTitle($title)
    {
        self::$metaTitle = $title;
    }

    /**
     * Get admin title.
     *
     * @return string
     */
    public function title()
    {
        return self::$metaTitle ? self::$metaTitle : config('sso.title');
    }

    public function user()
    {
        return static::guard()->user();
    }

    /**
     * Get the guard name.
     *
     * @return string
     */
    public function guardName()
    {
        return config('sso.auth.guard') ?: 'admin';
    }

    public function guard()
    {
        return Auth::guard(static::guardName());
    }


    /**
     * Register the open-admin builtin routes.
     *
     * @return void
     *
     * @deprecated Use Admin::routes() instead();
     */
    public function registerAuthRoutes()
    {
        $this->routes();
    }

    /**
     * Register the open-admin builtin routes.
     *
     * @return void
     */
    public function routes()
    {
        $attributes = [
            'prefix'     => config('sso.route.prefix'),
            'middleware' => config('sso.route.middleware'),
        ];

        app('router')->group($attributes, function ($router) {
            /* @var \Illuminate\Support\Facades\Route $router */



            

            $authController = config('sso.auth.controller', AuthController::class);

            /* @var \Illuminate\Routing\Router $router */
            $router->get('auth/redirect', $authController.'@redirect')->name('admin.redirect');
            $router->get('auth/callback', $authController.'@callback')->name('admin.callback');
        });
    }

}

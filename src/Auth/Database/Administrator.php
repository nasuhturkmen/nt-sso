<?php

namespace NasuhTurkmen\Admin\Auth\Database;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use NasuhTurkmen\Admin\Traits\DefaultDatetimeFormat;


class Administrator extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use DefaultDatetimeFormat;

    protected $primaryKey = 'ntauth_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ntauth_id',
        'ntauth_access_token',
        'ntauth_refresh_token',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'ntauth_access_token',
        'ntauth_refresh_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ntauth_access_token' => 'string',
        'ntauth_refresh_token' => 'string',
    ];

    /**
     * Override the method to authenticate the user by their "ntauth_id" instead of "email".
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'ntauth_id';
    }

    /**
     * Get the value of the user's unique identifier (ntauth_id).
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->ntauth_id;
    }

    /**
     * Get the password for the user.
     *
     * @return string|null
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('sso.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable(config('sso.database.users_table'));

        parent::__construct($attributes);
    }

}

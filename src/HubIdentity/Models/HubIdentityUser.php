<?php

namespace HubIdentity\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class HubIdentityUser extends Model implements Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'owner_type',
        'owner_uid',
        'uid',
        'deleted_at',
        'inserted_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ ];

    public function getAuthIdentifierName()
    {
        return 'uid';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['uid'];
    }

    public function getAuthPassword()
    {
        return null;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {

    }

    public function getRememberTokenName()
    {
        return null;
    }
}

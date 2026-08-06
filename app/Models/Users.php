<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Users extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'Users';
    protected $primaryKey = 'IdUser';
    public $timestamps = false;

    protected $keyType = 'int';

    // Passport / auth guard needs to know which column holds the password.
    public function getAuthPassword()
    {
        return $this->Password;
    }

    protected $fillable = [
        'Username',
        'FirstName',
        'LastName',
        'BirthDate',
        'Gender',
        'Email',
        'ICN',
        'Telephone',
        'Password',
        'IdRole',
        'FacebookId',
        'GoogleId',
        'RefreshToken',
        'ProfilePicture',
        'CreationDate',
        'IsVerified',
        'IsPremuim',
        'PremiumExpiry',
        'IdentityPicture',
        'IsBusinessAccount',
        'ICNBusiness',
        'BusinessVerificationPicture',
        'IdState',
        'IdCountry',
        'Location',
        'LastConnection',
        'Active',
        'City',
        'LastViewedAt',
        'ViewCount',
        'RecentlyViewed',
        'EmailConfirmed'
    ];

    protected $casts = [
        'RecentlyViewed' => 'array',
        'LastViewedAt' => 'datetime'
    ];
    protected $hidden = [
        'Password',
        'RefreshToken',
    ];

    public function role()
    {
        return $this->belongsTo(\App\Models\Roles::class, 'IdRole', 'IdRole');
    }


    public function state()
    {
        return $this->belongsTo(\App\Models\States::class, 'IdState', 'IdState');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Countries::class, 'IdCountry', 'IdCountry');
    }

    public function invoices()
    {
        return $this->hasMany(
            \App\Models\Invoices::class,
            'IdUser',
            'IdUser'
        );
    }

    public function conversations(): BelongsToMany
    {
        return $this->belongsToMany(
            Conversation::class,
            'conversation_user',
            'user_id',
            'conversation_id',
            'IdUser',
            'id'
        );
    }
}

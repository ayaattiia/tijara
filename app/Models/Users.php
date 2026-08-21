<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'PremiumStartedAt',
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
        'IsVerified',
        'VerifiedAt',
        'VerifiedBy',
        'EmailConfirmed'
    ];

    protected $casts = [
        'RecentlyViewed' => 'array',
        'LastViewedAt' => 'datetime',
        'IsVerified' => 'boolean',
        'VerifiedAt' => 'datetime',
        'IsPremuim' => 'boolean',
        'PremiumStartedAt' => 'datetime',
        'PremiumExpiry' => 'datetime',
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

    /**
     * All Premium subscriptions belonging to this user.
     */
    public function premiumSubscriptions(): HasMany
    {
        return $this->hasMany(
            PremiumSubscriptions::class,
            'IdUser',
            'IdUser'
        );
    }

    /**
     * Current active Premium subscription.
     */
    public function activePremiumSubscription(): HasOne
    {
        return $this->hasOne(
            PremiumSubscriptions::class,
            'IdUser',
            'IdUser'
        )->where('Status', 'active')
            ->where('PaymentStatus', 'paid')
            ->where('EndDate', '>', now());
    }
}

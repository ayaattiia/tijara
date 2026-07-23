<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'Vendors';

    protected $primaryKey = 'IdVendor';

    public $timestamps = false;

    protected $fillable = [
        'CompanyName',
        'TradeName',
        'TaxNumber',
        'VATNumber',
        'Address',
        'City',
        'Country',
        'PostalCode',
        'Telephone',
        'Mobile',
        'Email',
        'Website',
        'Logo',
        'BankName',
        'BankAccount',
        'IBAN',
        'SWIFT',
        'Active',
        'CreatedAt',
        'UpdatedAt'
    ];

    protected $casts = [
        'Active' => 'boolean',
        'CreatedAt' => 'datetime',
        'UpdatedAt' => 'datetime'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoices::class, 'IdVendor', 'IdVendor');
    }
}

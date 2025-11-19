<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandlordProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'bio',
        'business_registration',
        'tax_id',
        'address',
        'city',
        'state',
        'country',
        'preferred_contact_method',
        'documents',
    ];

    protected function casts(): array
    {
        return [
            'documents' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'bio',
        'business_registration',
        'cac_number',
        'address',
        'city',
        'state',
        'country',
        'website',
        'years_in_business',
        'certifications',
        'documents',
    ];

    protected function casts(): array
    {
        return [
            'certifications' => 'array',
            'documents' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'phone_number',
        'address'
    ];

    /**
     * Get all of the visits for the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class,);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visit extends Model
{
    protected $fillable = [
        'patient_id',
        'visit_date',
        'clinic',
        'doctor',
        'payment_type',
        'status'
    ];

    /**
     * Get the patient that owns the Visit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class,);
    }

    /**
     * Get the assessment associated with the Visit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assessment(): HasOne
    {
        return $this->hasOne(Assessment::class,);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    protected $fillable = [
        'visit_id',
        'chief_complaint',
        'blood_pressure',
        'temperature',
        'weight',
        'initial_diagnosis',
        'therapy',
        'doctor_notes'
    ];

    /**
     * Get the visit that owns the Assessment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class,);
    }
}

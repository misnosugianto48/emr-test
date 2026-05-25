<?php

namespace App\Repositories;

use App\Models\Patient;

class PatientRepository
{
    public function getAll()
    {
        return Patient::latest()->paginate(10);
    }
    public function create(array $data)
    {
        return Patient::create($data);
    }
    public function update(Patient $patient, array $data)
    {
        return $patient->update($data);
    }
}

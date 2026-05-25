<?php

namespace App\Services;

use App\Repositories\PatientRepository;

class PatientService
{
    public function __construct(
        protected PatientRepository $patientRepository
    ) {}

    public function createPatient(array $data)
    {
        return $this->patientRepository->create($data);
    }

    public function updatePatient(\App\Models\Patient $patient, array $data)
    {
        return $this->patientRepository->update($patient, $data);
    }
}

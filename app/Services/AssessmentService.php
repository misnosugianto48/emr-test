<?php

namespace App\Services;

use App\Repositories\AssessmentRepository;

class AssessmentService
{
    public function __construct(
        protected AssessmentRepository $assessmentRepository
    ) {}

    public function createAssessment(array $data)
    {
        return $this->assessmentRepository->create($data);
    }

    public function updateAssessment(\App\Models\Assessment $assessment, array $data)
    {
        return $this->assessmentRepository->update($assessment, $data);
    }
}

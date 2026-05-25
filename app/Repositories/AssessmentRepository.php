<?php

namespace App\Repositories;

use App\Models\Assessment;

class AssessmentRepository
{
    public function create(array $data)
    {
        return Assessment::create($data);
    }

    public function update(Assessment $assessment, array $data)
    {
        return $assessment->update($data);
    }
}

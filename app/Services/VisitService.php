<?php

namespace App\Services;

use App\Models\Visit;
use App\Repositories\VisitRepository;

namespace App\Services;

use App\Models\Visit;
use App\Repositories\VisitRepository;

class VisitService
{
    public function __construct(
        protected VisitRepository $visitRepository
    ) {}

    public function createVisit(array $data)
    {
        return $this->visitRepository->create($data);
    }

    public function cancelVisit(Visit $visit)
    {
        return $this->visitRepository->cancel($visit);
    }

    public function markAsAssessed(Visit $visit)
    {
        return $this->visitRepository->update($visit, ['status' => 'assessed']);
    }
}

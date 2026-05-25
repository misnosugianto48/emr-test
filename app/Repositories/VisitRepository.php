<?php

namespace App\Repositories;

use App\Models\Visit;

class VisitRepository
{
    public function create(array $data)
    {
        return Visit::create($data);
    }

    public function update(Visit $visit, array $data)
    {
        return $visit->update($data);
    }

    public function cancel(Visit $visit)
    {
        return $visit->update([
            'status' => 'cancelled'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitRequest;
use App\Models\Patient;
use App\Models\Visit;
use App\Services\VisitService;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __construct(
        protected VisitService $visitService
    ) {}

    public function create(Request $request)
    {
        $patients = Patient::orderBy('name')->get();
        $selectedPatientId = $request->input('patient_id');
        return view('visits.create', compact('patients', 'selectedPatientId'));
    }

    public function store(StoreVisitRequest $request)
    {
        $this->visitService->createVisit($request->validated());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Visit registered successfully.');
    }

    public function cancel(Visit $visit)
    {
        $this->visitService->cancelVisit($visit);
        return redirect()->back()->with('success', 'Visit cancelled.');
    }
}

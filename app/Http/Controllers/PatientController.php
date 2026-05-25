<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(
        protected PatientService $patientService
    ) {}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $patients = Patient::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('phone_number', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('patients.index', compact('patients', 'search'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(StorePatientRequest $request)
    {
        $this->patientService->createPatient($request->validated());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient registered successfully.');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(StorePatientRequest $request, Patient $patient)
    {
        $this->patientService->updatePatient($patient, $request->validated());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }
}

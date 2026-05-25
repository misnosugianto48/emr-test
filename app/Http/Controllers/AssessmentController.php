<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssessmentRequest;
use App\Models\Assessment;
use App\Models\Visit;
use App\Services\AssessmentService;
use App\Services\VisitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function __construct(
        protected AssessmentService $assessmentService,
        protected VisitService $visitService
    ) {}

    public function index(Request $request)
    {
        $search = $request->input('search');
        $visits = Visit::with(['patient', 'assessment'])
            ->when($search, function ($query, $search) {
                $query->whereHas('patient', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('assessments.index', compact('visits', 'search'));
    }

    public function create(Visit $visit)
    {
        if ($visit->status !== 'registered') {
            return redirect()->route('assessments.index')->with('error', 'Kunjungan ini tidak valid untuk diasesmen.');
        }

        return view('assessments.create', compact('visit'));
    }

    public function store(StoreAssessmentRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $this->assessmentService->createAssessment($data);
            
            $visit = Visit::findOrFail($data['visit_id']);
            $this->visitService->markAsAssessed($visit);
        });

        return redirect()->route('assessments.index')->with('success', 'Asesmen berhasil disimpan.');
    }

    public function edit(Assessment $assessment)
    {
        $assessment->load('visit.patient');
        return view('assessments.edit', compact('assessment'));
    }

    public function update(StoreAssessmentRequest $request, Assessment $assessment)
    {
        $this->assessmentService->updateAssessment($assessment, $request->validated());
        
        return redirect()->route('assessments.index')->with('success', 'Asesmen berhasil diupdate.');
    }
}

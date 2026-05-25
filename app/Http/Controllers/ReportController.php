<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Visit::with(['patient', 'assessment']);

        // Filter by Patient Name
        if ($request->filled('patient_name')) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->patient_name . '%');
            });
        }

        // Filter by Visit Date
        if ($request->filled('visit_date')) {
            $query->whereDate('visit_date', $request->visit_date);
        }

        // Filter by Doctor
        if ($request->filled('doctor')) {
            $query->where('doctor', 'like', '%' . $request->doctor . '%');
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Diagnosis (Assessment)
        if ($request->filled('diagnosis')) {
            $query->whereHas('assessment', function ($q) use ($request) {
                $q->where('initial_diagnosis', 'like', '%' . $request->diagnosis . '%');
            });
        }

        // Get Summary Counts
        $totalVisits = clone $query;
        $totalVisitsCount = $totalVisits->count();
        
        $totalRegistered = (clone $query)->where('status', 'registered')->count();
        $totalAssessed = (clone $query)->where('status', 'assessed')->count();
        $totalCancelled = (clone $query)->where('status', 'cancelled')->count();

        // Paginate results
        $visits = $query->latest()->paginate(20)->withQueryString();

        return view('reports.index', compact(
            'visits',
            'totalVisitsCount',
            'totalRegistered',
            'totalAssessed',
            'totalCancelled'
        ));
    }
}

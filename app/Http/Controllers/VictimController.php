<?php

namespace App\Http\Controllers;

use App\Models\gbv_case;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VictimController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        // Get case statistics for the logged-in victim
        $totalCases = gbv_case::where('user_id', $userId)->count();
        $pendingCases = gbv_case::where('user_id', $userId)
            ->whereIn('status', ['Reported', 'In Progress', 'Under Review'])
            ->count();
        $resolvedCases = gbv_case::where('user_id', $userId)
            ->whereIn('status', ['Resolved', 'Closed'])
            ->count();

        return view('victim.dashboard', compact('totalCases', 'pendingCases', 'resolvedCases'));
    }

    public function myCases()
    {
        $userId = Auth::id();
        $cases = gbv_case::where('user_id', $userId)
            ->with('assignedStaff')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('victim.my-cases', compact('cases'));
    }

    public function showCase($id)
    {
        $userId = Auth::id();
        $case = gbv_case::where('id', $id)
            ->where('user_id', $userId)
            ->with(['assignedStaff', 'caseHistories'])
            ->firstOrFail();

        return view('victim.case-detail', compact('case'));
    }
}

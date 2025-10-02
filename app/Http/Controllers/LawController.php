<?php

namespace App\Http\Controllers;

use App\Models\gbv_case;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LawController extends Controller
{
    public function dashboard()
    {
        // Get case statistics for law enforcement
        $totalCases = gbv_case::where('stage', 'Law Enforcement')->count();
        $pendingCases = gbv_case::where('stage', 'Law Enforcement')
            ->where('status', 'Reported')
            ->count();
        $assignedCases = gbv_case::where('stage', 'Law Enforcement')
            ->whereNotNull('assigned_staff_id')
            ->count();

        return view('law.dashboard', compact('totalCases', 'pendingCases', 'assignedCases'));
    }

    public function pendingCases()
    {
        // Get pending cases for Law Enforcement stage
        $cases = gbv_case::where('stage', 'Law Enforcement')
            ->where('status', 'Reported')
            ->with(['user', 'assignedStaff', 'assignedStaff.role'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('law.pending-cases', compact('cases'));
    }

    public function solvedCases()
    {
        // Get solved/closed cases from Law Enforcement stage
        $cases = gbv_case::where('stage', 'Law Enforcement')
            ->where('status', 'Closed')
            ->with(['user', 'assignedStaff', 'assignedStaff.role'])
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        return view('law.solved-cases', compact('cases'));
    }

    public function reports()
    {
        // Comprehensive statistics for Law Enforcement management
        $stats = [
            'total_cases' => gbv_case::where('stage', 'Law Enforcement')->count(),
            'pending_cases' => gbv_case::where('stage', 'Law Enforcement')
                ->where('status', 'Reported')
                ->count(),
            'assigned_cases' => gbv_case::where('stage', 'Law Enforcement')
                ->whereNotNull('assigned_staff_id')
                ->count(),
            'closed_cases' => gbv_case::where('stage', 'Law Enforcement')
                ->where('status', 'Closed')
                ->count(),
            'anonymous_cases' => gbv_case::where('stage', 'Law Enforcement')
                ->where('anonymous', true)
                ->count(),
        ];

        // Cases by type
        $casesByType = gbv_case::where('stage', 'Law Enforcement')
            ->select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        // Cases by status
        $casesByStatus = gbv_case::where('stage', 'Law Enforcement')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Recent cases
        $recentCases = gbv_case::where('stage', 'Law Enforcement')
            ->with(['user', 'assignedStaff'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Cases assigned to staff
        $assignmentStats = gbv_case::where('stage', 'Law Enforcement')
            ->whereNotNull('assigned_staff_id')
            ->with('assignedStaff', 'assignedStaff.role')
            ->get()
            ->groupBy('assigned_staff_id')
            ->map(function($cases) {
                return [
                    'staff' => $cases->first()->assignedStaff,
                    'count' => $cases->count()
                ];
            });

        return view('law.reports', compact('stats', 'casesByType', 'casesByStatus', 'recentCases', 'assignmentStats'));
    }

    public function settings()
    {
        return view('law.settings');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!\Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect!');
        }

        $user = auth()->user();
        $user->password = \Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully!');
    }
}

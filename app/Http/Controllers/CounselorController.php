<?php

namespace App\Http\Controllers;

use App\Models\gbv_case;
use Illuminate\Http\Request;

class CounselorController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Get case statistics for the counselor
        $assignedCases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Counseling')
            ->count();

        $completedCases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Counseling')
            ->whereNotNull('counseling_notes')
            ->count();

        $pendingCases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Counseling')
            ->whereNull('counseling_notes')
            ->count();

        return view('counsellor.dashboard', compact('assignedCases', 'completedCases', 'pendingCases'));
    }

    // Display cases assigned to the counselor
    public function index()
    {
        $user = auth()->user();

        // Retrieve all cases where the counselor is assigned
        $cases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Counseling')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('counsellor.cases.index', compact('cases'));
    }

    // Show the details of a single case
    public function show($id)
    {
        $user = auth()->user();
        $case = gbv_case::where('id', $id)
            ->where('assigned_staff_id', $user->id)
            ->with('user')
            ->firstOrFail();

        return view('counsellor.cases.show', compact('case'));
    }

    public function submitNotes(Request $request, $id)
    {
        $request->validate([
            'counseling_notes' => 'required|string',
            'counseling_sessions' => 'nullable|integer|min:1',
        ]);

        $user = auth()->user();
        $case = gbv_case::where('id', $id)
            ->where('assigned_staff_id', $user->id)
            ->firstOrFail();

        // Update the case with counseling notes and status
        $case->counseling_notes = $request->counseling_notes;
        $case->counseling_sessions = $request->counseling_sessions ?? 1;
        $case->status = 'Counseling Done';
        $case->save();

        // Redirect with success message
        return redirect()->route('counsel-case-show', $id)->with('success', 'Counseling notes submitted successfully.');
    }

    public function pendingCases()
    {
        $user = auth()->user();

        // Get pending counseling cases assigned to this user
        $cases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Counseling')
            ->whereNull('counseling_notes')
            ->with(['user', 'assignedStaff'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('counsellor.pending-cases', compact('cases'));
    }

    public function solvedCases()
    {
        $user = auth()->user();

        // Get closed counseling cases or cases with completed counseling
        $cases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Counseling')
            ->where(function($query) {
                $query->where('status', 'Closed')
                      ->orWhereNotNull('counseling_notes');
            })
            ->with(['user', 'assignedStaff'])
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        return view('counsellor.solved-cases', compact('cases'));
    }

    public function reports()
    {
        $user = auth()->user();

        // Statistics for this counselor
        $stats = [
            'total_cases' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Counseling')
                ->count(),
            'pending_sessions' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Counseling')
                ->whereNull('counseling_notes')
                ->count(),
            'completed_sessions' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Counseling')
                ->whereNotNull('counseling_notes')
                ->count(),
            'closed_cases' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Counseling')
                ->where('status', 'Closed')
                ->count(),
            'total_sessions' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Counseling')
                ->whereNotNull('counseling_sessions')
                ->sum('counseling_sessions'),
        ];

        // Cases by type for this counselor
        $casesByType = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Counseling')
            ->select('type', \DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        // Recent cases
        $recentCases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Counseling')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('counsellor.reports', compact('stats', 'casesByType', 'recentCases'));
    }

    public function settings()
    {
        return view('counsellor.settings');
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

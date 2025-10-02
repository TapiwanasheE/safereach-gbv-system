<?php

namespace App\Http\Controllers;

use App\Models\gbv_case;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // Get case statistics for the medical user
        $assignedCases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Medical')
            ->count();

        $completedCases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Medical')
            ->where('status', 'Medical Review Done')
            ->count();

        $pendingCases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Medical')
            ->whereNotIn('status', ['Medical Review Done', 'Resolved', 'Closed'])
            ->count();

        return view('medical.dashboard', compact('assignedCases', 'completedCases', 'pendingCases'));
    }

    // Display cases assigned to the medical user
    public function index()
    {
        $user = auth()->user();

        // Retrieve all cases where the medical user is assigned
        $cases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Medical')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('medical.cases.index', compact('cases'));
    }

    // Show the details of a single case
    public function show($id)
    {
        $user = auth()->user();
        $case = gbv_case::where('id', $id)
            ->where('assigned_staff_id', $user->id)
            ->with('user')
            ->firstOrFail();

        return view('medical.cases.show', compact('case'));
    }

    public function review(Request $request, $id)
    {
        $request->validate([
            'medical_review' => 'required|string',
            'medical_findings' => 'nullable|string',
        ]);

        $user = auth()->user();
        $case = gbv_case::where('id', $id)
            ->where('assigned_staff_id', $user->id)
            ->firstOrFail();

        // Update the case with medical review and status
        $case->medical_review = $request->medical_review;
        $case->medical_findings = $request->medical_findings;
        $case->status = 'Medical Review Done';
        $case->save();

        // Redirect with success message
        return redirect()->route('med-case-show', $id)->with('success', 'Medical review completed successfully.');
    }

    public function pendingCases()
    {
        $user = auth()->user();

        // Get pending medical cases assigned to this user
        $cases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Medical')
            ->whereNull('medical_review')
            ->with(['user', 'assignedStaff'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('medical.pending-cases', compact('cases'));
    }

    public function solvedCases()
    {
        $user = auth()->user();

        // Get closed medical cases or cases with completed medical review
        $cases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Medical')
            ->where(function($query) {
                $query->where('status', 'Closed')
                      ->orWhereNotNull('medical_review');
            })
            ->with(['user', 'assignedStaff'])
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        return view('medical.solved-cases', compact('cases'));
    }

    public function reports()
    {
        $user = auth()->user();

        // Statistics for this medical staff
        $stats = [
            'total_cases' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Medical')
                ->count(),
            'pending_reviews' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Medical')
                ->whereNull('medical_review')
                ->count(),
            'completed_reviews' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Medical')
                ->whereNotNull('medical_review')
                ->count(),
            'closed_cases' => gbv_case::where('assigned_staff_id', $user->id)
                ->where('stage', 'Medical')
                ->where('status', 'Closed')
                ->count(),
        ];

        // Cases by type for this medical staff
        $casesByType = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Medical')
            ->select('type', \DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        // Recent cases
        $recentCases = gbv_case::where('assigned_staff_id', $user->id)
            ->where('stage', 'Medical')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('medical.reports', compact('stats', 'casesByType', 'recentCases'));
    }

    public function settings()
    {
        return view('medical.settings');
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

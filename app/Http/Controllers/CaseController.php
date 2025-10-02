<?php

namespace App\Http\Controllers;

use App\Models\gbv_case;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
    //
    // Show the case reporting form
    public function create()
    {
        return view('victim.create-case');
    }

    // Store a new case in the database
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'anonymous' => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {
            // Case Number Generation (simplified as "CASE-YYYYMMDD-XXXXXX")
            $caseNumber = 'CASE-' . Carbon::now()->format('Ymd') . '-' . strtoupper(uniqid());

            // Create the case with the "Law Enforcement" stage and other details
            $case = gbv_case::create([
                'type' => $request->type,
                'description' => $request->description,
                'case_number' => $caseNumber,
                'date_reported' => $request->date,
                'location' => $request->location,
                'user_id' => Auth::id(),
                'status' => 'Reported',
                'stage' => 'Law Enforcement',
                'anonymous' => $request->has('anonymous') ? true : false,
            ]);

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('vic-my-cases')->with('success', 'Case reported successfully. Your case number is: ' . $caseNumber);
        } catch (Exception $e) {
            // Rollback the transaction if something fails
            DB::rollback();

            // Return error message
            return redirect()->back()->with('error', 'Failed to create case: ' . $e->getMessage());
        }
    }


    //Super User
    public function index()
    {
        $cases = gbv_case::with('user', 'assignedStaff', 'assignedStaff.role')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('superadmin.cases.index', compact('cases'));
    }

    //Law Enforcement
    public function indexlaw()
    {
        $cases = gbv_case::where('stage', 'Law Enforcement')
            ->with('user', 'assignedStaff')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('law.cases.index', compact('cases'));
    }

    public function showsa($id)
    {
        $case = gbv_case::with('user', 'assignedStaff')->findOrFail($id);
        $assignableUsers = User::whereHas('role', function($query) {
            $query->whereIn('name', ['Medical', 'Counselor']);
        })->get();

        return view('superadmin.cases.show', compact('case', 'assignableUsers'));
    }

    public function showlaw($id)
    {
        $case = gbv_case::with('user', 'assignedStaff')->findOrFail($id);
        $assignableUsers = User::whereHas('role', function($query) {
            $query->whereIn('name', ['Medical', 'Counselor']);
        })->get();

        return view('law.cases.showlaw', compact('case', 'assignableUsers'));
    }

    public function show($id)
    {
        $case = gbv_case::findOrFail($id);
        $assignableUsers = User::whereHas('role', function($query) {
            $query->whereIn('name', ['Medical', 'Counselor']);
        })->get();

        return view('superadmin.cases.show', compact('case', 'assignableUsers'));
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'assigned_user_id' => 'required|exists:users,id',
        ]);

        $case = gbv_case::findOrFail($id);
        $case->assigned_staff_id = $request->assigned_user_id;

        // Retrieve the role of the assigned user
        $assignedUser = User::findOrFail($request->assigned_user_id);

        // Set the case stage based on the assigned user's role
        if ($assignedUser->role->name === 'Medical') {
            $case->stage = 'Medical';
        } elseif ($assignedUser->role->name === 'Counseling') {
            $case->stage = 'Counseling';
        } else {
            $case->stage = 'Law Enforcement'; // Default or fallback stage
        }

        $case->save();

        // Notify the assigned user about the case assignment (to be implemented)
        // Notification functionality will go here.

        // Redirect back to the previous page with success message
        return redirect()->back()->with('success', 'Case assigned successfully to ' . $assignedUser->name . ' (' . $assignedUser->role->name . ')');
    }

    // Push case to Medical stage
    public function pushToMedical(Request $request, $id)
    {
        $request->validate([
            'assigned_staff_id' => 'required|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $case = gbv_case::findOrFail($id);
            $assignedStaff = User::findOrFail($request->assigned_staff_id);

            // Update case
            $case->stage = 'Medical';
            $case->assigned_staff_id = $request->assigned_staff_id;
            $case->save();

            // Record in case history
            \App\Models\CaseHistory::create([
                'case_id' => $case->id,
                'updated_by' => Auth::id(),
                'status' => $case->status,
                'from_stage' => 'Law Enforcement',
                'to_stage' => 'Medical',
                'action_type' => 'pushed',
                'action_description' => $request->notes ?? 'Case pushed to Medical department for medical examination. Assigned to ' . $assignedStaff->name
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Case successfully pushed to Medical department and assigned to ' . $assignedStaff->name);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to push case: ' . $e->getMessage());
        }
    }

    // Push case to Counseling stage
    public function pushToCounseling(Request $request, $id)
    {
        $request->validate([
            'assigned_staff_id' => 'required|exists:users,id',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $case = gbv_case::findOrFail($id);
            $assignedStaff = User::findOrFail($request->assigned_staff_id);
            $fromStage = $case->stage;

            // Update case
            $case->stage = 'Counseling';
            $case->assigned_staff_id = $request->assigned_staff_id;
            $case->save();

            // Record in case history
            \App\Models\CaseHistory::create([
                'case_id' => $case->id,
                'updated_by' => Auth::id(),
                'status' => $case->status,
                'from_stage' => $fromStage,
                'to_stage' => 'Counseling',
                'action_type' => 'pushed',
                'action_description' => $request->notes ?? 'Case pushed to Counseling department. Assigned to ' . $assignedStaff->name
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Case successfully pushed to Counseling department and assigned to ' . $assignedStaff->name);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to push case: ' . $e->getMessage());
        }
    }

    // Close case
    public function closeCase(Request $request, $id)
    {
        $request->validate([
            'closing_notes' => 'required|string|min:10'
        ]);

        DB::beginTransaction();
        try {
            $case = gbv_case::findOrFail($id);
            $fromStage = $case->stage;

            // Update case
            $case->status = 'Closed';
            $case->save();

            // Record in case history
            \App\Models\CaseHistory::create([
                'case_id' => $case->id,
                'updated_by' => Auth::id(),
                'status' => 'Closed',
                'from_stage' => $fromStage,
                'to_stage' => null,
                'action_type' => 'closed',
                'action_description' => 'Case closed. Notes: ' . $request->closing_notes
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Case has been successfully closed.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to close case: ' . $e->getMessage());
        }
    }

}

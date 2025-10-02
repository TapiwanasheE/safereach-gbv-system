<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SuperUserController extends Controller
{
    // Display the Super User dashboard
    public function dashboard()
    {
        // Get system-wide statistics
        $totalCases = \App\Models\gbv_case::count();
        $totalUsers = User::count();
        $totalVictims = User::whereHas('role', function($q) { $q->where('name', 'Victim'); })->count();

        // Count users by role
        $lawEnforcementCount = User::whereHas('role', function($q) { $q->where('name', 'Law Enforcement'); })->count();
        $medicalCount = User::whereHas('role', function($q) { $q->where('name', 'Medical'); })->count();
        $counselorCount = User::whereHas('role', function($q) { $q->where('name', 'Counselor'); })->count();

        // Case statistics
        $reportedCases = \App\Models\gbv_case::where('status', 'Reported')->count();
        $inProgressCases = \App\Models\gbv_case::whereIn('status', ['In Progress', 'Under Review'])->count();
        $resolvedCases = \App\Models\gbv_case::whereIn('status', ['Resolved', 'Closed'])->count();

        return view('superadmin.admin', compact(
            'totalCases', 'totalUsers', 'totalVictims',
            'lawEnforcementCount', 'medicalCount', 'counselorCount',
            'reportedCases', 'inProgressCases', 'resolvedCases'
        ));
    }

    // Display the list of users.blade.php managed by Super User
    public function index()
    {
        $users = User::whereHas('role', function($query) {
            $query->whereIn('name', ['Medical', 'Counselor', 'Law Enforcement']);
        })->get();

        $roles = Role::whereIn('name', ['Medical', 'Counselor', 'Law Enforcement'])->get();

        return view('superadmin.users', compact('users', 'roles'));
    }

    // Show form to create a new user
    public function create()
    {
        $roles = Role::whereIn('name', ['Medical', 'Counselor', 'Law Enforcement'])->get();
        return view('superadmin.users', compact('roles'));
    }

    // Store the new user in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        DB::beginTransaction();

        try {
            // Attempt to create the user
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);

            DB::commit();  // Commit the transaction if no exception occurred
            return redirect()->route('sa-users')->with('success', 'User created successfully');
        } catch (Exception $e) {
            DB::rollback();  // Roll back the transaction if an exception occurred

            // Log the error for debugging purposes
            Log::error('User creation failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
        }
    }

    // Update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
            ]);

            // Update password if provided
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|min:6|confirmed',
                ]);
                $user->password = Hash::make($request->password);
                $user->save();
            }

            DB::commit();
            return redirect()->route('sa-users')->with('success', 'User updated successfully');
        } catch (Exception $e) {
            DB::rollback();
            Log::error('User update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update user. Please try again.');
        }
    }

    // Role Management page
    public function roles()
    {
        $roles = Role::withCount('users')->get();
        return view('superadmin.roles', compact('roles'));
    }

    // System Settings page
    public function settings()
    {
        return view('superadmin.settings');
    }

    // Audit Logs page
    public function auditLogs()
    {
        // Get recent user activities
        $recentUsers = User::with('role')
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        $recentCases = \App\Models\gbv_case::with('user', 'assignedStaff')
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        return view('superadmin.audit-logs', compact('recentUsers', 'recentCases'));
    }

    // Reports page
    public function reports()
    {
        // Get comprehensive statistics
        $totalCases = \App\Models\gbv_case::count();
        $casesByType = \App\Models\gbv_case::select('type', \DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get();

        $casesByStatus = \App\Models\gbv_case::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $casesByStage = \App\Models\gbv_case::select('stage', \DB::raw('count(*) as total'))
            ->groupBy('stage')
            ->get();

        $anonymousCases = \App\Models\gbv_case::where('anonymous', true)->count();
        $identifiedCases = \App\Models\gbv_case::where('anonymous', false)->count();

        // User statistics
        $totalUsers = User::count();
        $usersByRole = User::select('role_id', \DB::raw('count(*) as total'))
            ->with('role')
            ->groupBy('role_id')
            ->get();

        // Recent cases
        $recentCases = \App\Models\gbv_case::with('user', 'assignedStaff')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('superadmin.reports', compact(
            'totalCases', 'casesByType', 'casesByStatus', 'casesByStage',
            'anonymousCases', 'identifiedCases', 'totalUsers', 'usersByRole', 'recentCases'
        ));
    }

    // Delete a user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent deleting yourself
            if ($user->id == auth()->id()) {
                return redirect()->route('sa-users')->with('error', 'You cannot delete your own account');
            }

            $user->delete();
            return redirect()->route('sa-users')->with('success', 'User deleted successfully');
        } catch (Exception $e) {
            Log::error('User deletion failed: ' . $e->getMessage());
            return redirect()->route('sa-users')->with('error', 'Failed to delete user');
        }
    }
}


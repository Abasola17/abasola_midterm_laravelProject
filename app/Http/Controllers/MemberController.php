<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with('plan');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by plan
        if ($request->filled('plan_id')) {
            $query->where('plan_id', $request->plan_id);
        }

        $members = $query->latest()->get();
        $plans = Plan::orderBy('name')->get();

        $stats = [
            'totalMembers' => Member::count(),
            'activeMembers' => Member::where('status', 'Active')->count(),
            'totalPlans' => Plan::count(),
        ];

        $recentMembers = Member::with('plan')->latest()->take(5)->get();

        return view('gym.members', compact('members', 'plans', 'stats', 'recentMembers'));
    }

    public function trash(Request $request)
    {
        $query = Member::onlyTrashed()->with('plan');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by plan
        if ($request->filled('plan_id')) {
            $query->where('plan_id', $request->plan_id);
        }

        $members = $query->latest()->get();
        $plans = Plan::orderBy('name')->get();

        return view('gym.trash', compact('members', 'plans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMember($request);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('members', 'public');
        }

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }

    public function update(Request $request, Member $member)
    {
        $validated = $this->validateMember($request, $member->id);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $validated['photo'] = $request->file('photo')->store('members', 'public');
        }

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member moved to trash successfully.');
    }

    public function restore($id)
    {
        $member = Member::onlyTrashed()->findOrFail($id);
        $member->restore();

        return redirect()->route('members.trash')->with('success', 'Member restored successfully.');
    }

    public function forceDelete($id)
    {
        $member = Member::onlyTrashed()->findOrFail($id);
        
        // Delete photo if exists
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }
        
        $member->forceDelete();

        return redirect()->route('members.trash')->with('success', 'Member permanently deleted.');
    }

    public function exportPdf(Request $request)
    {
        try {
            $query = Member::with('plan');

            // Apply same filters as index
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            }

            if ($request->filled('plan_id')) {
                $query->where('plan_id', $request->plan_id);
            }

            $members = $query->latest()->get();

            // Render the view to HTML
            $html = view('gym.members-pdf', compact('members'))->render();
            
            // Use DomPDF directly with full namespace (bypassing Laravel wrapper)
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            $filename = 'members_' . date('Y-m-d_His') . '.pdf';
            
            return response()->streamDownload(function () use ($dompdf) {
                echo $dompdf->output();
            }, $filename, [
                'Content-Type' => 'application/pdf',
            ]);
        } catch (\Exception $e) {
            Log::error('PDF Export Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('members.index')
                ->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }

    protected function validateMember(Request $request, ?int $memberId = null): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'join_date' => 'required|date',
            'status' => 'required|in:Active,Inactive,Suspended',
            'plan_id' => 'nullable|exists:plans,id',
            'notes' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ];

        return $request->validate($rules);
    }
}




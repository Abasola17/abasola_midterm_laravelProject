<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Plan;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('plan')->latest()->get();
        $plans = Plan::orderBy('name')->get();

        $stats = [
            'totalMembers' => Member::count(),
            'activeMembers' => Member::where('status', 'Active')->count(),
            'totalPlans' => Plan::count(),
        ];

        $recentMembers = Member::with('plan')->latest()->take(5)->get();

        return view('gym.members', compact('members', 'plans', 'stats', 'recentMembers'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMember($request);

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }

    public function update(Request $request, Member $member)
    {
        $validated = $this->validateMember($request);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member removed successfully.');
    }

    protected function validateMember(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'join_date' => 'required|date',
            'status' => 'required|in:Active,Inactive,Suspended',
            'plan_id' => 'nullable|exists:plans,id',
            'notes' => 'nullable|string|max:1000',
        ]);
    }
}




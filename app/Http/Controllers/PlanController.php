<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::withCount('members')->orderBy('name')->get();

        return view('gym.plans', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePlan($request);

        Plan::create($validated);

        return redirect()->route('plans.index')->with('success', 'Plan added successfully.');
    }

    public function update(Request $request, Plan $plan)
    {
        $validated = $this->validatePlan($request, $plan->id);

        $plan->update($validated);

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan moved to trash successfully.');
    }

    protected function validatePlan(Request $request, ?int $planId = null): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'features' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];

        if ($planId) {
            $rules['name'][] = 'unique:plans,name,' . $planId;
        } else {
            $rules['name'][] = 'unique:plans,name';
        }

        return $request->validate($rules);
    }
}




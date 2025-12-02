@extends('layouts.gym')

@section('title', 'Gym Plans')

@section('content')
<div class="space-y-8">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Membership Plans</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage gym membership plans and pricing</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900 lg:col-span-2">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Add New Plan</h2>
            <form action="{{ route('plans.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
                @csrf
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Plan Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Price (₱) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required
                           class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Duration (Days) <span class="text-red-500">*</span></label>
                    <input type="number" name="duration_days" value="{{ old('duration_days') }}" min="1" required
                           class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Features</label>
                    <textarea name="features" rows="3"
                              class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">{{ old('features') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">{{ old('description') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Add Plan
                    </button>
                </div>
            </form>
        </div>

        @php
            $totalMembers = $plans->sum('members_count');
        @endphp
        <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Plans Overview</h2>
            <p class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">{{ $plans->count() }} Plans</p>
            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">{{ $totalMembers }} members enrolled</p>
            <div class="space-y-3">
                @foreach ($plans->take(3) as $plan)
                    <div class="rounded-md border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-800">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $plan->name }}</p>
                        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">₱{{ number_format($plan->price, 2) }} / {{ $plan->duration_days }} days</p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $plan->members_count }} members</p>
                    </div>
                @endforeach
                @if ($plans->isEmpty())
                    <p class="rounded-md border border-dashed border-gray-300 bg-gray-50 p-4 text-center text-sm text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">Add a plan to see stats.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">
        <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Plans Directory</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Manage all gym membership plans</p>
                </div>
                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $plans->count() }} total</span>
            </div>
        </div>

        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Plan Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Price</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Duration</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Members</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                    @forelse ($plans as $plan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-900 dark:text-white">{{ $plan->name }}</p>
                                @if ($plan->description)
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($plan->description, 60) }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">₱{{ number_format($plan->price, 2) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $plan->duration_days }} days</td>
                            <td class="px-4 py-3">
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $plan->members_count }} members</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div x-data="{ open: false }" class="inline-block">
                                        <button type="button" @click="open = true"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">Edit</button>
                                        <div x-cloak x-show="open" x-transition
                                             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
                                            <div class="w-full max-w-lg rounded-lg border border-gray-200 bg-white p-6 shadow-lg dark:border-gray-700 dark:bg-gray-900">
                                                <div class="mb-4 flex items-center justify-between border-b border-gray-200 pb-3 dark:border-gray-700">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit {{ $plan->name }}</h3>
                                                    <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('plans.update', $plan) }}" class="mt-6 space-y-4">
                                                    @csrf
                                                    @method('PUT')
                                                    <div>
                                                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Plan Name</label>
                                                        <input type="text" name="name" value="{{ $plan->name }}" required
                                                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                    </div>
                                                    <div class="grid gap-4 md:grid-cols-2">
                                                        <div>
                                                            <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Price (₱)</label>
                                                            <input type="number" name="price" value="{{ $plan->price }}" step="0.01" min="0" required
                                                                   class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                        </div>
                                                        <div>
                                                            <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Duration (Days)</label>
                                                            <input type="number" name="duration_days" value="{{ $plan->duration_days }}" min="1" required
                                                                   class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Features</label>
                                                        <textarea name="features" rows="3"
                                                                  class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">{{ $plan->features }}</textarea>
                                                    </div>
                                                    <div>
                                                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                                        <textarea name="description" rows="3"
                                                                  class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">{{ $plan->description }}</textarea>
                                                    </div>
                                                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                                        <button type="button" @click="open = false" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800">Cancel</button>
                                                        <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('plans.destroy', $plan) }}" onsubmit="return confirm('Are you sure you want to delete this plan? Members with this plan will have their plan set to N/A.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                No plans added yet. Add your first plan above!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection



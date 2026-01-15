@extends('layouts.gym')

@section('title', 'Gym Members Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gym Management</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your gym members and membership plans</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Members</p>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['totalMembers'] }}</h2>
                </div>
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Active Members</p>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['activeMembers'] }}</h2>
                </div>
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Plans</p>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['totalPlans'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900 lg:col-span-2">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Add New Member</h2>
            <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2">
                @csrf
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Photo</label>
                    <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png"
                           class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JPG/PNG only, max 2MB</p>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Join Date <span class="text-red-500">*</span></label>
                    <input type="date" name="join_date" value="{{ old('join_date', date('Y-m-d')) }}" required
                           class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Status <span class="text-red-500">*</span></label>
                    @php($statuses = ['Active', 'Inactive', 'Suspended'])
                    <select name="status" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected(old('status', 'Active') === $status)>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Plan</label>
                    <select name="plan_id" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                        <option value="">Select plan (optional)</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}" @selected(old('plan_id') == $plan->id)>{{ $plan->name }} - ₱{{ number_format($plan->price, 2) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                    <textarea name="notes" rows="3"
                              class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">{{ old('notes') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Add Member
                    </button>
                </div>
            </form>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Recently Added</h2>
            <ul class="space-y-3">
                @forelse ($recentMembers as $recent)
                    <li class="rounded-md border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-800">
                        <p class="font-medium text-gray-900 dark:text-white">{{ $recent->name }}</p>
                        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                            {{ $recent->plan?->name ?? 'No Plan' }} • {{ $recent->status }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $recent->created_at->diffForHumans() }}</p>
                    </li>
                @empty
                    <li class="rounded-md border border-dashed border-gray-300 bg-gray-50 p-4 text-center text-sm text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                        No members added yet
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-900">
        <form method="GET" action="{{ route('members.index') }}" class="grid gap-4 md:grid-cols-4">
            <div class="md:col-span-2">
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or phone"
                       class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Plan</label>
                <select name="plan_id" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                    <option value="">All Plans</option>
                    @foreach ($plans as $plan)
                        <option value="{{ $plan->id }}" @selected(request('plan_id') == $plan->id)>{{ $plan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Search
                </button>
                <a href="{{ route('members.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900">
        <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Members Directory</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">All gym members</p>
                </div>
                <div class="flex items-center gap-3">
                    <form method="GET" action="{{ route('members.export') }}" class="inline">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="plan_id" value="{{ request('plan_id') }}">
                        <button type="submit" class="rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            Export PDF
                        </button>
                    </form>
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $members->count() }} total</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Photo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Plan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Join Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                    @forelse ($members as $member)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">
                                @if($member->photo)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($member->photo) }}" alt="{{ $member->name }}" class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 text-sm font-medium">
                                        {{ $member->initials() }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-900 dark:text-white">{{ $member->name }}</p>
                                @if($member->notes)
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($member->notes, 60) }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                <p>{{ $member->email ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $member->phone ?? 'N/A' }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $member->plan?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium
                                    @class([
                                        'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' => $member->status === 'Active',
                                        'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300' => $member->status === 'Inactive',
                                        'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' => $member->status === 'Suspended',
                                    ])">
                                    {{ $member->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $member->join_date->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div x-data="{ open: false }" class="inline-block">
                                        <button type="button" @click="open = true"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                            Edit
                                        </button>
                                        <div x-cloak x-show="open"
                                             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
                                             x-transition>
                                            <div class="w-full max-w-xl rounded-lg border border-gray-200 bg-white p-6 shadow-lg dark:border-gray-700 dark:bg-gray-900">
                                                <div class="mb-4 flex items-center justify-between border-b border-gray-200 pb-3 dark:border-gray-700">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit {{ $member->name }}</h3>
                                                    <button type="button" @click="open = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('members.update', $member) }}" enctype="multipart/form-data" class="mt-6 space-y-4">
                                                    @csrf
                                                    @method('PUT')
                                                    <div>
                                                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Photo</label>
                                                        @if($member->photo)
                                                            <div class="mb-2">
                                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($member->photo) }}" alt="{{ $member->name }}" class="h-16 w-16 rounded-full object-cover">
                                                            </div>
                                                        @endif
                                                        <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png"
                                                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JPG/PNG only, max 2MB</p>
                                                    </div>
                                                    <div>
                                                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                                        <input type="text" name="name" value="{{ $member->name }}" required
                                                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                    </div>
                                                    <div class="grid gap-4 md:grid-cols-2">
                                                        <div>
                                                            <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                                            <input type="email" name="email" value="{{ $member->email }}"
                                                                   class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                        </div>
                                                        <div>
                                                            <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                                            <input type="text" name="phone" value="{{ $member->phone }}"
                                                                   class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                        </div>
                                                    </div>
                                                    <div class="grid gap-4 md:grid-cols-2">
                                                        <div>
                                                            <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Join Date</label>
                                                            <input type="date" name="join_date" value="{{ $member->join_date->format('Y-m-d') }}" required
                                                                   class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                        </div>
                                                        <div>
                                                            <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                                            @php($statuses = ['Active', 'Inactive', 'Suspended'])
                                                            <select name="status" required class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                                @foreach ($statuses as $status)
                                                                    <option value="{{ $status }}" @selected($member->status === $status)>{{ $status }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Plan</label>
                                                        <select name="plan_id" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                                                            <option value="">Select plan (optional)</option>
                                                            @foreach ($plans as $plan)
                                                                <option value="{{ $plan->id }}" @selected($member->plan_id === $plan->id)>{{ $plan->name }} - ₱{{ number_format($plan->price, 2) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Notes</label>
                                                        <textarea name="notes" rows="3"
                                                                  class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">{{ $member->notes }}</textarea>
                                                    </div>
                                                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                                        <button type="button" @click="open = false" class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800">Cancel</button>
                                                        <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('members.destroy', $member) }}" onsubmit="return confirm('Are you sure you want to remove this member?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                @if(request('search') || request('plan_id'))
                                    No members found matching your search criteria.
                                @else
                                    No members added yet. Add your first member above!
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


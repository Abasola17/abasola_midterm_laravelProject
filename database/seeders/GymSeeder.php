<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class GymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Plans
        $plans = [
            [
                'name' => 'Basic Plan',
                'price' => 29.99,
                'duration_days' => 30,
                'features' => 'Access to gym equipment, Basic locker room',
                'description' => 'Perfect for beginners or occasional gym-goers.',
            ],
            [
                'name' => 'Premium Plan',
                'price' => 49.99,
                'duration_days' => 30,
                'features' => 'Access to all equipment, Personal trainer sessions (2/month), Premium locker room, Group classes',
                'description' => 'Ideal for regular gym enthusiasts who want extra benefits.',
            ],
            [
                'name' => 'VIP Plan',
                'price' => 79.99,
                'duration_days' => 30,
                'features' => 'Full access, Unlimited personal trainer sessions, VIP lounge access, Nutrition counseling, Priority booking',
                'description' => 'The ultimate membership for serious fitness enthusiasts.',
            ],
            [
                'name' => 'Student Plan',
                'price' => 19.99,
                'duration_days' => 30,
                'features' => 'Access to gym equipment, Student ID required',
                'description' => 'Special discounted rate for students with valid ID.',
            ],
            [
                'name' => 'Annual Plan',
                'price' => 399.99,
                'duration_days' => 365,
                'features' => 'All Premium Plan features, Best value for year commitment, Free cancellation',
                'description' => 'Save money with our annual membership option.',
            ],
        ];

        $createdPlans = [];
        foreach ($plans as $planData) {
            $createdPlans[] = Plan::create($planData);
        }

        // Create Members
        $members = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '555-0101',
                'join_date' => now()->subDays(45),
                'status' => 'Active',
                'plan_id' => $createdPlans[1]->id, // Premium Plan
                'notes' => 'Regular morning visitor, prefers cardio equipment.',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.j@example.com',
                'phone' => '555-0102',
                'join_date' => now()->subDays(120),
                'status' => 'Active',
                'plan_id' => $createdPlans[2]->id, // VIP Plan
                'notes' => 'Participates in group classes, personal trainer sessions booked.',
            ],
            [
                'name' => 'Mike Davis',
                'email' => 'mike.davis@example.com',
                'phone' => '555-0103',
                'join_date' => now()->subDays(15),
                'status' => 'Active',
                'plan_id' => $createdPlans[0]->id, // Basic Plan
                'notes' => 'New member, orientation scheduled.',
            ],
            [
                'name' => 'Emily Wilson',
                'email' => 'emily.w@example.com',
                'phone' => '555-0104',
                'join_date' => now()->subDays(200),
                'status' => 'Active',
                'plan_id' => $createdPlans[4]->id, // Annual Plan
                'notes' => 'Long-term member, very satisfied with services.',
            ],
            [
                'name' => 'David Brown',
                'email' => 'david.brown@example.com',
                'phone' => '555-0105',
                'join_date' => now()->subDays(60),
                'status' => 'Inactive',
                'plan_id' => $createdPlans[0]->id, // Basic Plan
                'notes' => 'Membership expired, contact for renewal.',
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa.a@example.com',
                'phone' => '555-0106',
                'join_date' => now()->subDays(30),
                'status' => 'Active',
                'plan_id' => $createdPlans[3]->id, // Student Plan
                'notes' => 'Student member, verified with student ID.',
            ],
            [
                'name' => 'Robert Taylor',
                'email' => 'robert.t@example.com',
                'phone' => '555-0107',
                'join_date' => now()->subDays(90),
                'status' => 'Suspended',
                'plan_id' => $createdPlans[1]->id, // Premium Plan
                'notes' => 'Account suspended due to payment issue, needs resolution.',
            ],
        ];

        foreach ($members as $memberData) {
            Member::create($memberData);
        }
    }
}




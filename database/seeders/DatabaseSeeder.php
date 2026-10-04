<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ActivityUpdate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'      => 'Ada Admin',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
                'job_title' => 'Team Lead',
                'phone'     => '+233200000001',
                'is_active' => true,
            ]
        );

        $agent = User::updateOrCreate(
            ['email' => 'sam@example.com'],
            [
                'name'      => 'Sam Support',
                'password'  => Hash::make('password'),
                'role'      => 'support',
                'job_title' => 'Support Engineer',
                'phone'     => '+233200000002',
                'is_active' => true,
            ]
        );

        $activities = [
            ['Daily SMS count in comparison to SMS count from logs', 'sms'],
            ['Check server uptime and CPU threshold alerts', 'infra'],
            ['Verify nightly backup completion', 'backup'],
            ['Review unresolved customer tickets > 24h', 'support'],
            ['Confirm payment gateway reconciliation', 'finance'],
        ];

        foreach ($activities as [$title, $cat]) {
            Activity::firstOrCreate(
                ['title' => $title],
                [
                    'category'    => $cat,
                    'description' => 'Auto-seeded activity for demo.',
                    'created_by'  => $admin->id,
                    'is_active'   => true,
                ]
            );
        }

        foreach (Activity::all() as $a) {
            foreach ([today()->subDay(), today()] as $d) {
                ActivityUpdate::create([
                    'activity_id'       => $a->id,
                    'user_id'           => $agent->id,
                    'performed_by_name' => $agent->name,
                    'performed_by_role' => $agent->job_title,
                    'status'            => collect(['done', 'pending'])->random(),
                    'remark'            => 'Checked and recorded.',
                    'activity_date'     => $d,
                    'performed_at'      => $d->copy()->setTime(9, rand(0, 59)),
                ]);
            }
        }
    }
}
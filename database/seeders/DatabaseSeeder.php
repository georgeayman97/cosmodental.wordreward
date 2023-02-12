<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory()->create([
//            'name' => 'korayem',
//            'phone' => '01207099888',
//            'role' => 'admin',
//            'password' => '$2y$10$fzVXkswz4adk3wWRSbns1ur7.ue4tClBf/jam4DDTpXdalQVmdi9a',
//            'user_group_level' => 1,
//        ]);
//        User::factory()->create([
//            'name' => 'myname',
//            'phone' => 1234567,
//            'role' => 'admin',
//        ]);
//
//        User::factory(10)->create();
//
//        UserGroup::create([
//            'name' => 'Normal',
//            'level' => 1,
//            'maximum_points' => 100,
//            'minimum_balance_to_allow_transfer' => 100,
//            'referred_user_group_id' => fake()->numberBetween(1, 6),
//        ]);
//        UserGroup::create([
//            'name' => 'Silver',
//            'level' => 2,
//            'maximum_points' => 250,
//            'minimum_balance_to_allow_transfer' => 500,
//            'referred_user_group_id' => fake()->numberBetween(1, 6),
//        ]);
//        UserGroup::create([
//            'name' => 'Gold',
//            'level' => 3,
//            'maximum_points' => 500,
//            'minimum_balance_to_allow_transfer' => 0,
//            'referred_user_group_id' => fake()->numberBetween(1, 6),
//        ]);
        TransactionType::truncate();

        TransactionType::updateOrCreate(
            ['name' => 'New Registration'],
            ['default_points' => 200]
        );

        TransactionType::updateOrCreate(
            ['name' => 'Payment'],
            ['default_points' => 5]
        );

        TransactionType::updateOrCreate(
            ['name' => 'Refer Points By Payment'],
            ['default_points' => 5]
        );

        TransactionType::updateOrCreate(
            ['name' => 'check-in'],
            ['default_points' => 50]
        );
        TransactionType::updateOrCreate(
            ['name' => 'Redeem'],
            ['default_points' => 0]
        );
        TransactionType::updateOrCreate(
            ['name' => 'Transfer'],
            ['default_points' => 0]
        );
        TransactionType::updateOrCreate(
            ['name' => 'Google Review'],
            ['default_points' => 50]
        );
        TransactionType::updateOrCreate(
            ['name' => 'Facebook Review'],
            ['default_points' => 50]
        );

//         \App\Models\DefaultEarning::factory(10)->create();
//         \App\Models\Notification::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

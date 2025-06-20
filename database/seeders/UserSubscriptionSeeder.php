<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = Plan::find(3);
        $user = User::find(1);

        if($user != null){
            $user->subscription()->updateOrCreate(['user_id' => $user->id],[
                'plan_type_id' => $plan->plan_type_id,
                'plan_id' => $plan->id,
                'is_active' => true,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays(1095),
                'recToken' => md5(time().$user->id),
            ]);
        }
        $user = User::find(2);
        $plan = Plan::find(3);
        if($user != null){
            $user->subscription()->updateOrCreate(['user_id' => $user->id],[
                'plan_type_id' => $plan->plan_type_id,
                'plan_id' => $plan->id,
                'is_active' => true,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays(1095),
                'recToken' => md5(time().$user->id),
            ]);
        }
        $user = User::find(3);
        $plan = Plan::find(3);
        if($user != null){
            $user->subscription()->updateOrCreate(['user_id' => $user->id],[
                'plan_type_id' => $plan->plan_type_id,
                'plan_id' => $plan->id,
                'is_active' => true,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays(1095),
                'recToken' => md5(time().$user->id),
            ]);
        }
        $user = User::find(4);
        $plan = Plan::find(3);
        if($user != null){
            $user->subscription()->updateOrCreate(['user_id' => $user->id],[
                'plan_type_id' => $plan->plan_type_id,
                'plan_id' => $plan->id,
                'is_active' => true,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays(1095),
                'recToken' => md5(time().$user->id),
            ]);
        }
        $user = User::find(5);
        $plan = Plan::find(3);
        if($user != null){
            $user->subscription()->updateOrCreate(['user_id' => $user->id],[
                'plan_type_id' => $plan->plan_type_id,
                'plan_id' => $plan->id,
                'is_active' => true,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays(1095),
                'recToken' => md5(time().$user->id),
            ]);
        }
        $user = User::find(6);
        $plan = Plan::find(3);
        if($user != null){
            $user->subscription()->updateOrCreate(['user_id' => $user->id],[
                'plan_type_id' => $plan->plan_type_id,
                'plan_id' => $plan->id,
                'is_active' => true,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays(1095),
                'recToken' => md5(time().$user->id),
            ]);
        }
        $user = User::find(7);
        $plan = Plan::find(3);
        if($user != null){
            $user->subscription()->updateOrCreate(['user_id' => $user->id],[
                'plan_type_id' => $plan->plan_type_id,
                'plan_id' => $plan->id,
                'is_active' => true,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays(1095),
                'recToken' => md5(time().$user->id),
            ]);
        }
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Plan;

class PlanSelector extends Component
{
    public array $plans = [];

    public function mount()
    {
        $this->plans = Plan::with(['planType', 'planOptions' => function ($q) {
            $q->where('is_included', true)->where('is_active', true);
        }])
        ->where('is_active', true)
        ->orderBy('plan_order')
        ->get()
        ->filter(function ($plan) {
            return $plan->planType !== null;
        })
        ->mapWithKeys(function ($plan) {
            return [
                $plan->planType->type_name => [
                    'id' => $plan->id,
                    'name' => $plan->plan_name,
                    'description' => $plan->plan_description,
                    'price' => $plan->plan_price,
                    'discount' => $plan->plan_discount,
                    'isRecommended' => $plan->plan_recommended,
                    'type' => $plan->planType->type_name,
                    'options' => $plan->planOptions->map(function ($option) {
                        return [
                            'id'          => $option->id,
                            'description' => $option->option_description,
                        ];
                    })->toArray(),
                ]
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.plan-selector');
    }
}
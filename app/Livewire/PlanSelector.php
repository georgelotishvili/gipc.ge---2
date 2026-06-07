<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Plan;

class PlanSelector extends Component
{
    public array $plans = [];
    public bool $showAgreementModal = false;
    public bool $agreementAccepted = false;
    public ?string $selectedPlanId = null;

    public function mount()
    {
        $this->plans = Plan::with(['planType', 'planOptions' => function ($q) {
            $q->where('is_included', true)->where('is_active', true);
        }])
        ->where('is_active', true)
        ->whereHas('planType')
        ->orderBy('plan_order')
        ->orderBy('id')
        ->get()
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

        // Check if we should show the agreement modal (redirected from middleware)
        if (session()->has('show_agreement')) {
            $this->showAgreementModal = true;
            $this->agreementAccepted = false; // Reset checkbox state
            // Set the plan ID if redirected from a specific plan
            if (session()->has('redirected_plan_id')) {
                $this->selectedPlanId = session()->get('redirected_plan_id');
                session()->forget('redirected_plan_id');
            }
            session()->forget('show_agreement');
        }
    }

    public function acceptAgreement()
    {
        $this->agreementAccepted = true;
        // Store in session for middleware check - will be cleared by PaymentController
        session()->put('agreement_accepted', true);
        
        // If there's an intended URL, redirect there
        if (session()->has('intended_url')) {
            $intendedUrl = session()->get('intended_url');
            session()->forget('intended_url');
            return redirect($intendedUrl);
        }
        
        // Otherwise redirect to the selected plan
        if ($this->selectedPlanId) {
            return redirect()->route('subscribe.pay', ['plan' => $this->selectedPlanId]);
        }
        
        // Fallback - redirect to pricing page
        return redirect()->route('pricing');
    }

    public function cancelAgreement()
    {
        $this->showAgreementModal = false;
        $this->agreementAccepted = false;
        $this->selectedPlanId = null;
        session()->forget('agreement_accepted');
        session()->forget('intended_url');
    }

    public function setSelectedPlan($planId)
    {
        $this->selectedPlanId = $planId;
        $this->agreementAccepted = false; // Reset checkbox state
    }

    public function closeModal()
    {
        $this->showAgreementModal = false;
        $this->agreementAccepted = false; // Reset checkbox state
    }

    public function openAgreementModal()
    {
        $this->showAgreementModal = true;
        $this->agreementAccepted = false; // Reset checkbox state
    }

    public function render()
    {
        return view('livewire.plan-selector');
    }
}

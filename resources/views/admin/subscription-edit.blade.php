<x-admin.layout>
    @php
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
        $currentIsActive = (bool) (
            $currentSubscription?->is_active
            && (! $currentSubscription->starts_at || $currentSubscription->starts_at->isPast())
            && (! $currentSubscription->ends_at || $currentSubscription->ends_at->isFuture())
        );

        $subscriptionHistory = $user->subscriptions
            ->sortByDesc(function ($subscription) {
                $isActive = $subscription->is_active
                    && (! $subscription->starts_at || $subscription->starts_at->isPast())
                    && (! $subscription->ends_at || $subscription->ends_at->isFuture());
                $timestamp = $subscription->starts_at?->timestamp ?? $subscription->created_at?->timestamp ?? 0;

                return ($isActive ? 10_000_000_000 : 0) + $timestamp;
            })
            ->values();
    @endphp

    <div class="mx-auto max-w-6xl space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">რეგისტრირებული პირის რედაქტირება</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">{{ $user->name }} - {{ $user->email }}</p>
            </div>
            <a href="{{ route('admin.users') }}" class="inline-flex h-11 min-w-28 items-center justify-center rounded-md bg-blue-600 px-8 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700">
                უკან
            </a>
        </div>

        @if(session('success'))
            <div class="rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-950/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-950/30 dark:text-red-300">
                <p class="font-semibold">შეცდომებია შესასწორებელი</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="admin-user-subscription-form" action="{{ route('admin.subscription.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

        <section class="rounded-md border border-gray-200 bg-white p-5 shadow-[0_10px_30px_rgba(37,99,235,0.08)] dark:border-slate-700 dark:bg-slate-900">
                <div class="mb-5 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">პირადი მონაცემები</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">ადმინს შეუძლია შეცვალოს რეგისტრირებული პირის სახელი და ელ-ფოსტა.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-slate-300">
                            სახელი და გვარი <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $user->name) }}"
                               required
                               class="w-full rounded-md border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-slate-300">
                            ელ-ფოსტა <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email', $user->email) }}"
                               required
                               class="w-full rounded-md border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                    </div>
                </div>
            </section>

            <section class="rounded-md border border-gray-200 bg-white p-5 shadow-[0_10px_30px_rgba(37,99,235,0.08)] dark:border-slate-700 dark:bg-slate-900">
                <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">გამოწერის მართვა</h2>
                        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">გამოწერა შეიძლება ჩაირთოს გადახდის გარეშე ან შეჩერდეს. ისტორიის ჩანაწერის ამოღება შესაძლებელია მხოლოდ ადმინის მხრიდან.</p>
                    </div>

                    <div class="flex items-center gap-2 rounded-md bg-gray-50 px-3 py-2 text-sm dark:bg-slate-800">
                        <span class="rounded-full {{ $currentIsActive ? 'h-3.5 w-3.5 bg-green-500 shadow-[0_0_0_4px_rgba(34,197,94,0.2)]' : 'h-2.5 w-2.5 bg-blue-500 shadow-[0_0_0_3px_rgba(59,130,246,0.14)]' }}"></span>
                        <span class="font-medium text-gray-700 dark:text-slate-200">
                            {{ $currentIsActive ? 'აქტიური გამოწერა' : ($currentSubscription ? 'აქტიური არ არის' : 'გამოწერა არ აქვს') }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="subscription_action" class="mb-2 block text-sm font-medium text-gray-700 dark:text-slate-300">
                            მოქმედება <span class="text-red-500">*</span>
                        </label>
                        <select name="subscription_action" id="subscription_action" class="w-full rounded-md border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                            <option value="none" {{ old('subscription_action', 'none') === 'none' ? 'selected' : '' }}>მხოლოდ მონაცემების შენახვა</option>
                            <option value="grant" {{ old('subscription_action') === 'grant' ? 'selected' : '' }}>გამოწერის ჩართვა გადახდის გარეშე</option>
                            <option value="stop" {{ old('subscription_action') === 'stop' ? 'selected' : '' }}>გამოწერის შეჩერება</option>
                        </select>
                    </div>

                    <div>
                        <label for="plan_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-slate-300">
                            გამოწერის ტიპი
                        </label>
                        <select name="plan_id" id="plan_id" data-subscription-field class="w-full rounded-md border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100 disabled:text-gray-400 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:disabled:bg-slate-800/50">
                            <option value="">აირჩიეთ გამოწერის ტიპი</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}"
                                        data-duration="{{ $plan->planType->type_duration }}"
                                        {{ (int) old('plan_id', $currentSubscription?->plan_id) === (int) $plan->id ? 'selected' : '' }}>
                                    {{ $plan->plan_name }} ({{ $plan->planType->type_duration }} დღე)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="starts_at" class="mb-2 block text-sm font-medium text-gray-700 dark:text-slate-300">
                            დაწყების თარიღი
                        </label>
                        <input type="date"
                               name="starts_at"
                               id="starts_at"
                               data-subscription-field
                               value="{{ old('starts_at', $currentSubscription?->starts_at ? $currentSubscription->starts_at->format('Y-m-d') : now()->format('Y-m-d')) }}"
                               class="w-full rounded-md border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100 disabled:text-gray-400 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:disabled:bg-slate-800/50">
                    </div>

                    <div>
                        <label for="ends_at" class="mb-2 block text-sm font-medium text-gray-700 dark:text-slate-300">
                            დასრულების თარიღი
                        </label>
                        <input type="date"
                               name="ends_at"
                               id="ends_at"
                               data-subscription-field
                               value="{{ old('ends_at', $currentSubscription?->ends_at ? $currentSubscription->ends_at->format('Y-m-d') : '') }}"
                               class="w-full rounded-md border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 disabled:bg-gray-100 disabled:text-gray-400 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:disabled:bg-slate-800/50">
                    </div>
                </div>

            </section>

        </form>

        <section class="rounded-md border border-gray-200 bg-white p-5 shadow-[0_10px_30px_rgba(37,99,235,0.08)] dark:border-slate-700 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">გამოწერის ისტორია</h2>

                @if($subscriptionHistory->isNotEmpty())
                    <div class="mt-4 space-y-2">
                        @foreach($subscriptionHistory as $subscription)
                            @php
                                $subscriptionPlanType = $subscription->planType ?? $subscription->plan?->planType;
                                $subscriptionPlanName = $subscriptionPlanType?->type_name ?? $subscription->plan?->plan_name ?? 'ვადა უცნობია';
                                $subscriptionPayment = $subscription->payments
                                    ->sortByDesc(fn ($payment) => $payment->order_time ?? $payment->created_at)
                                    ->first();
                                $subscriptionIsActive = (bool) (
                                    $subscription->is_active
                                    && (! $subscription->starts_at || $subscription->starts_at->isPast())
                                    && (! $subscription->ends_at || $subscription->ends_at->isFuture())
                                );
                            @endphp

                            <div class="grid grid-cols-1 gap-3 rounded-md border border-gray-200 bg-gray-50 p-3 text-sm text-gray-700 dark:border-slate-700 dark:bg-slate-800/60 dark:text-slate-300 md:grid-cols-6 md:items-center">
                                <div>
                                    <span class="block text-xs text-gray-400 dark:text-slate-500">პაკეტი</span>
                                    <span class="font-medium">{{ $subscriptionPlanName }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 dark:text-slate-500">დაწყება</span>
                                    <span class="font-medium">{{ $subscription->starts_at ? $subscription->starts_at->format('d.m.Y') : 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 dark:text-slate-500">დასრულება</span>
                                    <span class="font-medium">{{ $subscription->ends_at ? $subscription->ends_at->format('d.m.Y') : 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 dark:text-slate-500">წყარო</span>
                                    <span class="font-medium">{{ $subscriptionPayment ? 'გადახდა' : 'ადმინის ჩართვა' }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 dark:text-slate-500">თანხა</span>
                                    <span class="font-medium">{{ $subscriptionPayment ? number_format($subscriptionPayment->actual_amount, 2) . ' ლარი' : 'გადახდის გარეშე' }}</span>
                                </div>
                                <div class="flex items-center justify-start gap-3 md:justify-end">
                                    <span class="rounded-full {{ $subscriptionIsActive ? 'h-3.5 w-3.5 bg-green-500 shadow-[0_0_0_4px_rgba(34,197,94,0.2)]' : 'h-2.5 w-2.5 bg-blue-500 shadow-[0_0_0_3px_rgba(59,130,246,0.14)]' }}"></span>
                                    <form action="{{ route('admin.users.subscriptions.destroy', [$user->id, $subscription->id]) }}"
                                          method="POST"
                                          onsubmit="return confirm('ნამდვილად გსურთ ამ გამოწერის ისტორიის ჩანაწერის ამოღება? მასთან დაკავშირებული გადახდის ჩანაწერებიც სრულად ამოიღება.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                aria-label="გამოწერის ისტორიის ჩანაწერის ამოღება"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-red-200 text-sm font-semibold leading-none text-red-600 transition hover:border-red-300 hover:bg-red-50 dark:border-red-900/60 dark:text-red-300 dark:hover:bg-red-950/40">
                                            X
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-3 text-sm text-gray-600 dark:text-slate-300">გამოწერის ისტორია ცარიელია.</p>
                @endif
        </section>

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('admin.users') }}" class="inline-flex h-11 items-center justify-center rounded-md bg-gray-100 px-6 text-sm font-medium text-gray-700 transition hover:bg-gray-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                გაუქმება
            </a>
            <button type="submit" form="admin-user-subscription-form" class="inline-flex h-11 items-center justify-center rounded-md bg-blue-600 px-6 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700">
                შენახვა
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const actionSelect = document.getElementById('subscription_action');
            const planSelect = document.getElementById('plan_id');
            const startDateInput = document.getElementById('starts_at');
            const endDateInput = document.getElementById('ends_at');
            const subscriptionFields = document.querySelectorAll('[data-subscription-field]');

            function selectedDuration() {
                return Number(planSelect.options[planSelect.selectedIndex]?.dataset.duration || 0);
            }

            function calculateEndDate() {
                const duration = selectedDuration();
                const startDate = startDateInput.value;

                if (!duration || !startDate) {
                    return;
                }

                const endDate = new Date(startDate);
                endDate.setDate(endDate.getDate() + duration);

                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, '0');
                const day = String(endDate.getDate()).padStart(2, '0');

                endDateInput.value = `${year}-${month}-${day}`;
            }

            function syncSubscriptionFields() {
                const grantsSubscription = actionSelect.value === 'grant';

                subscriptionFields.forEach((field) => {
                    field.disabled = !grantsSubscription;
                });

                planSelect.required = grantsSubscription;
                startDateInput.required = grantsSubscription;

                if (grantsSubscription && planSelect.value && startDateInput.value && !endDateInput.value) {
                    calculateEndDate();
                }
            }

            actionSelect.addEventListener('change', syncSubscriptionFields);
            planSelect.addEventListener('change', calculateEndDate);
            startDateInput.addEventListener('change', calculateEndDate);

            syncSubscriptionFields();
        });
    </script>
</x-admin.layout>

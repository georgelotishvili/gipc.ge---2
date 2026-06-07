<x-admin.layout>
    <div class="mx-auto max-w-7xl space-y-6">
        @if(session('success'))
            <div class="rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-950/30 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="rounded-md border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-800 dark:bg-red-950/30 dark:text-red-300">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">რეგისტრირებული მომხმარებლები</h1>
            <p class="max-w-3xl text-sm leading-6 text-gray-500 dark:text-slate-400">
                ბარათზე ჩანს რეგისტრაციისას შეყვანილი ინფორმაცია და გამოწერის ისტორია. პაროლი უსაფრთხოების გამო არ ჩანს.
            </p>
        </div>

        <div class="space-y-4">
            @foreach($users as $user)
                @php
                    $approvedPayments = $user->payments
                        ->where('order_status', 'approved')
                        ->sortByDesc(fn ($payment) => $payment->order_time ?? $payment->created_at)
                        ->values();
                    $subscriptionHistory = $user->subscriptions
                        ->sortByDesc(function ($subscription) {
                            $isActive = $subscription->is_active
                                && (! $subscription->starts_at || $subscription->starts_at->isPast())
                                && (! $subscription->ends_at || $subscription->ends_at->isFuture());
                            $timestamp = $subscription->starts_at?->timestamp ?? $subscription->created_at?->timestamp ?? 0;

                            return ($isActive ? 10_000_000_000 : 0) + $timestamp;
                        })
                        ->values();

                    $currentSubscription = $user->subscriptions
                        ->sortByDesc(function ($subscription) {
                            $isActive = $subscription->is_active
                                && (! $subscription->starts_at || $subscription->starts_at->isPast())
                                && (! $subscription->ends_at || $subscription->ends_at->isFuture());
                            $timestamp = $subscription->ends_at?->timestamp ?? $subscription->created_at?->timestamp ?? 0;

                            return ($isActive ? 10_000_000_000 : 0) + $timestamp;
                        })
                        ->first() ?? $user->subscription;
                    $currentPlanType = $currentSubscription?->planType ?? $currentSubscription?->plan?->planType;
                    $currentPlanName = $currentPlanType?->type_name ?? $currentSubscription?->plan?->plan_name ?? 'ვადა უცნობია';
                    $hasActiveSubscription = (bool) (
                        $currentSubscription?->is_active
                        && (! $currentSubscription->starts_at || $currentSubscription->starts_at->isPast())
                        && (! $currentSubscription->ends_at || $currentSubscription->ends_at->isFuture())
                    );
                    $subscriptionDotCount = max($subscriptionHistory->count(), $approvedPayments->count(), $currentSubscription ? 1 : 0);
                    $visibleSubscriptionDots = min($subscriptionDotCount, 5);
                    $hiddenSubscriptionDots = max($subscriptionDotCount - $visibleSubscriptionDots, 0);
                @endphp

                <section x-data="{ open: false }" class="w-full overflow-hidden rounded-md border border-gray-200 bg-white shadow-[0_10px_30px_rgba(37,99,235,0.08)] transition hover:border-blue-200 hover:shadow-[0_18px_45px_rgba(37,99,235,0.14)] dark:border-slate-700 dark:bg-slate-900 dark:hover:border-blue-500/30">
                    <div class="flex flex-col gap-4 p-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex min-w-0 items-start gap-4">
                            <x-user-avatar :user="$user" class="h-12 w-12 shrink-0" icon-class="h-6 w-6" />

                            <div class="min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h2 class="break-words text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                                    <span class="rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 dark:bg-slate-800 dark:text-slate-300">
                                        #{{ $user->id }}
                                    </span>
                                    <span class="rounded-md px-2 py-1 text-xs font-medium {{ $user->is_admin ? 'bg-blue-100 text-blue-700 dark:bg-blue-950/50 dark:text-blue-300' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300' }}">
                                        {{ $user->is_admin ? 'ადმინისტრატორი' : 'რეგისტრირებული პირი' }}
                                    </span>
                                </div>
                                <a href="mailto:{{ $user->email }}" class="mt-1 block break-all text-sm text-blue-600 hover:text-blue-700 dark:text-blue-300 dark:hover:text-blue-200">
                                    {{ $user->email }}
                                </a>
                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-gray-500 dark:text-slate-400">
                                    <span>რეგისტრაცია: {{ $user->created_at ? $user->created_at->format('d.m.Y') : 'N/A' }}</span>
                                    <span class="hidden text-gray-300 dark:text-slate-600 sm:inline">|</span>
                                    @if($subscriptionDotCount > 0)
                                        <span class="inline-flex items-center gap-1.5" title="{{ $hasActiveSubscription ? 'აქტიური გამოწერა' : 'წარსული გამოწერა' }}">
                                            @for($dotIndex = 1; $dotIndex <= $visibleSubscriptionDots; $dotIndex++)
                                                <span class="rounded-full {{ $hasActiveSubscription && $dotIndex === $visibleSubscriptionDots ? 'h-3.5 w-3.5 bg-green-500 shadow-[0_0_0_4px_rgba(34,197,94,0.2)]' : 'h-2.5 w-2.5 bg-blue-500 shadow-[0_0_0_3px_rgba(59,130,246,0.14)]' }}"></span>
                                            @endfor

                                            @if($hiddenSubscriptionDots > 0)
                                                <span class="text-xs font-medium text-blue-600 dark:text-blue-300">+{{ $hiddenSubscriptionDots }}</span>
                                            @endif
                                        </span>
                                    @else
                                        <span class="rounded-md bg-gray-100 px-2 py-1 font-medium text-gray-600 dark:bg-slate-800 dark:text-slate-300">
                                            გამოწერის გარეშე
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex shrink-0 flex-wrap gap-2 sm:justify-end">
                            <a href="{{ route('admin.subscription.edit', $user->id) }}" class="inline-flex h-10 items-center justify-center rounded-md bg-blue-600 px-4 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700">
                                გამოწერის რედაქტირება
                            </a>

                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('ნამდვილად გსურთ მომხმარებლის წაშლა? ეს ქმედება შეუქცევადია!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-md bg-red-50 px-4 text-sm font-medium text-red-700 transition hover:bg-red-100 dark:bg-red-950/40 dark:text-red-300 dark:hover:bg-red-900/50">
                                    წაშლა
                                </button>
                            </form>

                            <button type="button"
                                    @click="open = !open"
                                    :aria-expanded="open.toString()"
                                    :aria-label="open ? 'აკეცვა' : 'გაშლა'"
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-gray-200 bg-white text-gray-700 transition hover:bg-gray-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                                <svg :class="{ 'rotate-180': open }" class="h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div x-show="open"
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         class="border-t border-gray-100 p-5 dark:border-slate-700">
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                        <div class="rounded-md border border-gray-100 bg-gray-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-slate-500">სახელი</p>
                            <p class="mt-1 break-words text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                        </div>

                        <div class="rounded-md border border-gray-100 bg-gray-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-slate-500">ელ-ფოსტა</p>
                            <p class="mt-1 break-all text-sm font-medium text-gray-900 dark:text-white">{{ $user->email }}</p>
                        </div>

                        <div class="rounded-md border border-gray-100 bg-gray-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-slate-500">რეგისტრაციის თარიღი</p>
                            <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                                {{ $user->created_at ? $user->created_at->format('d.m.Y H:i') : 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 rounded-md border border-gray-100 bg-gray-50 p-4 dark:border-slate-700 dark:bg-slate-800/60">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-slate-500">გამოწერის ისტორია</p>
                        </div>

                        @if($subscriptionHistory->isNotEmpty())
                            <div class="mt-3 space-y-2">
                                @foreach($subscriptionHistory->take(5) as $historySubscription)
                                    @php
                                        $historyPlanType = $historySubscription?->planType ?? $historySubscription?->plan?->planType;
                                        $historyPlanName = $historyPlanType?->type_name ?? $historySubscription?->plan?->plan_name ?? 'ვადა უცნობია';
                                        $historyPayment = $historySubscription->payments
                                            ->where('order_status', 'approved')
                                            ->sortByDesc(fn ($payment) => $payment->order_time ?? $payment->created_at)
                                            ->first();
                                        $historyDate = $historyPayment?->order_time ?? $historySubscription->starts_at ?? $historySubscription->created_at;
                                        $historyIsActive = (bool) (
                                            $historySubscription?->is_active
                                            && (! $historySubscription->starts_at || $historySubscription->starts_at->isPast())
                                            && (! $historySubscription->ends_at || $historySubscription->ends_at->isFuture())
                                        );
                                    @endphp

                                    <div class="grid grid-cols-1 gap-3 rounded-md border border-gray-200 bg-white p-3 text-sm text-gray-700 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 md:grid-cols-6 md:items-center">
                                        <div>
                                            <span class="block text-xs text-gray-400 dark:text-slate-500">ჩანაწერის თარიღი</span>
                                            <span class="font-medium">{{ $historyDate ? $historyDate->format('d.m.Y H:i') : 'N/A' }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-xs text-gray-400 dark:text-slate-500">პაკეტი</span>
                                            <span class="font-medium">{{ $historyPlanName }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-xs text-gray-400 dark:text-slate-500">დაწყება</span>
                                            <span class="font-medium">{{ $historySubscription?->starts_at ? $historySubscription->starts_at->format('d.m.Y') : 'N/A' }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-xs text-gray-400 dark:text-slate-500">დასრულება</span>
                                            <span class="font-medium">{{ $historySubscription?->ends_at ? $historySubscription->ends_at->format('d.m.Y') : 'N/A' }}</span>
                                        </div>
                                        <div>
                                            <span class="block text-xs text-gray-400 dark:text-slate-500">თანხა</span>
                                            <span class="font-medium">{{ $historyPayment ? number_format($historyPayment->actual_amount, 2) . ' ლარი' : 'გადახდის გარეშე' }}</span>
                                        </div>
                                        <div class="flex items-end justify-start md:justify-end">
                                            <span class="rounded-full {{ $historyIsActive ? 'h-3.5 w-3.5 bg-green-500 shadow-[0_0_0_4px_rgba(34,197,94,0.2)]' : 'h-2.5 w-2.5 bg-blue-500 shadow-[0_0_0_3px_rgba(59,130,246,0.14)]' }}"
                                                  title="{{ $historyIsActive ? 'აქტიური გამოწერა' : 'ძველი გამოწერა' }}"></span>
                                        </div>
                                    </div>
                                @endforeach

                                @if($subscriptionHistory->count() > 5)
                                    <p class="text-xs text-gray-500 dark:text-slate-400">
                                        კიდევ {{ $subscriptionHistory->count() - 5 }} ჩანაწერია.
                                    </p>
                                @endif
                            </div>
                        @else
                            <p class="mt-2 text-sm text-gray-600 dark:text-slate-300">ამ მომხმარებელს გამოწერა ჯერ არ ჰქონია.</p>
                        @endif
                    </div>
                    </div>
                </section>
            @endforeach
        </div>

        <div>
            {{ $users->links() }}
        </div>
    </div>
</x-admin.layout>

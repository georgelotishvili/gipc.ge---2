<x-admin.layout>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-dark-2 rounded-md shadow-lg p-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    გამოწერის რედაქტირება - {{ $user->name }}
                </h1>
                <a href="{{ route('admin.users') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    უკან
                </a>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                                Validation Errors
                            </h3>
                            <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.subscription.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Status -->
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            სტატუსი
                        </label>
                        <select name="is_active" id="is_active" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-dark-3 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                            <option value="1" {{ ($user->subscription?->is_active ?? false) ? 'selected' : '' }}>გამოწერილი</option>
                            <option value="0" {{ !($user->subscription?->is_active ?? false) ? 'selected' : '' }}>არ არის გამოწერილი</option>
                        </select>
                    </div>

                    <!-- Plan Type -->
                    <div>
                        <label for="plan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            გამოწერის ტიპი <span class="text-red-500">*</span>
                        </label>
                        <select name="plan_id" id="plan_id" required class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-dark-3 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">აირჩიეთ გამოწერის ტიპი</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ ($user->subscription?->plan_id == $plan->id) ? 'selected' : '' }}>
                                    {{ $plan->plan_name }} ({{ $plan->planType->type_duration }} დღე)
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="starts_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            დაწყების თარიღი <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="starts_at" id="starts_at" required
                               value="{{ $user->subscription?->starts_at ? \Carbon\Carbon::parse($user->subscription->starts_at)->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d') }}"
                               class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-dark-3 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('starts_at')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="ends_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            დასრულების თარიღი
                        </label>
                        <input type="date" name="ends_at" id="ends_at" 
                               value="{{ $user->subscription?->ends_at ? \Carbon\Carbon::parse($user->subscription->ends_at)->format('Y-m-d') : '' }}"
                               class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-dark-3 dark:text-gray-200 focus:ring-blue-500 focus:border-blue-500">
                        @error('ends_at')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current Subscription Info -->
                @if($user->subscription)
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-md">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">მიმდინარე გამოწერა</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="font-medium">სტატუსი:</span>
                                <span class="px-2 py-1 rounded-md text-xs {{ $user->subscription->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->subscription->is_active ? 'გამოწერილი' : 'არ არის გამოწერილი' }}
                                </span>
                            </div>
                            <div>
                                <span class="font-medium">დაწყება:</span> {{ $user->subscription->starts_at ? \Carbon\Carbon::parse($user->subscription->starts_at)->format('d.m.Y') : 'N/A' }}
                            </div>
                            <div>
                                <span class="font-medium">დასრულება:</span> {{ $user->subscription->ends_at ? \Carbon\Carbon::parse($user->subscription->ends_at)->format('d.m.Y') : 'N/A' }}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.users') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        გაუქმება
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        შენახვა
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const planSelect = document.getElementById('plan_id');
            const startDateInput = document.getElementById('starts_at');
            const endDateInput = document.getElementById('ends_at');
            
            // Plan durations mapping
            const planDurations = {
                @foreach($plans as $plan)
                    {{ $plan->id }}: {{ $plan->planType->type_duration }},
                @endforeach
            };
            
            // Plan type names for better UX
            const planTypeNames = {
                @foreach($plans as $plan)
                    {{ $plan->id }}: '{{ $plan->planType->type_name }}',
                @endforeach
            };
            
            function setDefaultDates() {
                const selectedPlanId = planSelect.value;
                const today = new Date();
                
                if (selectedPlanId && planDurations[selectedPlanId]) {
                    // Set start date to today
                    const year = today.getFullYear();
                    const month = String(today.getMonth() + 1).padStart(2, '0');
                    const day = String(today.getDate()).padStart(2, '0');
                    startDateInput.value = `${year}-${month}-${day}`;
                    
                    // Calculate end date
                    const duration = planDurations[selectedPlanId];
                    const endDate = new Date(today);
                    endDate.setDate(today.getDate() + duration);
                    
                    const endYear = endDate.getFullYear();
                    const endMonth = String(endDate.getMonth() + 1).padStart(2, '0');
                    const endDay = String(endDate.getDate()).padStart(2, '0');
                    endDateInput.value = `${endYear}-${endMonth}-${endDay}`;
                    
                    // Show a nice message
                    const planName = planTypeNames[selectedPlanId];
                    console.log(`Selected ${planName}: ${duration} days from today`);
                }
            }
            
            function calculateEndDate() {
                const selectedPlanId = planSelect.value;
                const startDate = startDateInput.value;
                
                if (selectedPlanId && startDate && planDurations[selectedPlanId]) {
                    const start = new Date(startDate);
                    const duration = planDurations[selectedPlanId];
                    const endDate = new Date(start);
                    endDate.setDate(start.getDate() + duration);
                    
                    const year = endDate.getFullYear();
                    const month = String(endDate.getMonth() + 1).padStart(2, '0');
                    const day = String(endDate.getDate()).padStart(2, '0');
                    
                    endDateInput.value = `${year}-${month}-${day}`;
                }
            }
            
            // Auto-set dates when plan is selected
            planSelect.addEventListener('change', function() {
                if (this.value) {
                    setDefaultDates();
                }
            });
            
            // Recalculate end date when start date changes
            startDateInput.addEventListener('change', calculateEndDate);
        });
    </script>
</x-admin.layout>

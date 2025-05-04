<x-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">სერტიფიკატის შექმნა</h1>
            <a href="{{ route('certificated-specialists') }}" wire:navigate class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                უკან სერთიფიკატების ჩამონათვალში
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
            <form action="{{ route('admin.certificates.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- User Selection with Alpine.js Modal -->
                    <div x-data="{ open: false, selectedUser: null, searchQuery: '', users: {{ json_encode($users ?? []) }} }">
                        <x-label for="user_id" value="User" class="text-gray-900 dark:text-white" />
                        <div class="mt-1 relative">
                            <button 
                                type="button" 
                                @click="open = true" 
                                class="w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            >
                                <span x-text="selectedUser ? selectedUser.name : 'Select User'" class="block truncate dark:text-gray-300"></span>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                            <input type="hidden" name="user_id" x-bind:value="selectedUser ? selectedUser.id : ''" />
                        </div>
                        
                        <!-- User Selection Modal -->
                        <div 
                            x-show="open" 
                            @click.away="open = false" 
                            class="fixed inset-0 z-50 overflow-y-auto" 
                            x-transition:enter="transition ease-out duration-200" 
                            x-transition:enter-start="opacity-0" 
                            x-transition:enter-end="opacity-100" 
                            x-transition:leave="transition ease-in duration-150" 
                            x-transition:leave-start="opacity-100" 
                            x-transition:leave-end="opacity-0"
                        >
                            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                                    აირჩიეთ მომხმარებელი
                                                </h3>
                                                <div class="mt-4">
                                                    <input 
                                                        type="text" 
                                                        x-model="searchQuery" 
                                                        placeholder="Search by name or email..." 
                                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                                    >
                                                </div>
                                                <div class="mt-4 max-h-60 overflow-y-auto">
                                                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                                        <template x-for="user in users.filter(user => user.name.toLowerCase().includes(searchQuery.toLowerCase()) || (user.email && user.email.toLowerCase().includes(searchQuery.toLowerCase())))" :key="user.id">
                                                            <li class="py-2 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 px-3 rounded" @click="selectedUser = user; open = false;">
                                                                <div class="flex items-center">
                                                                    <div class="ml-3">
                                                                        <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="user.name"></p>
                                                                        <p class="text-sm text-gray-500 dark:text-gray-400" x-text="user.email || 'No email'"></p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button 
                                            type="button" 
                                            @click="open = false" 
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                        >
                                            უკან
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <x-input-error for="user_id" class="mt-2" />
                    </div>

                    <!-- Speciality Selection -->
                    <div>
                        <x-label for="speciality_id" value="Speciality" class="text-gray-900 dark:text-white" />
                        <select id="speciality_id" name="speciality_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">აირჩიეთ სპეციალობა</option>
                            @foreach($specialities as $speciality)
                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="speciality_id" class="mt-2" />
                    </div>

                    <!-- Certificate Number -->
                    <div>
                        <x-label for="certificate_number" value="სერთიფიკატის ნომერი" class="text-gray-900 dark:text-white" />
                        <x-input id="certificate_number" type="text" name="certificate_number" :value="old('certificate_number')" class="mt-1 block w-full" required />
                        <x-input-error for="certificate_number" class="mt-2" />
                    </div>

                    <!-- Release Date -->
                    <div>
                        <x-label for="release_date" value="გაცემის თარიღი" class="text-gray-900 dark:text-white" />
                        <x-input id="release_date" type="date" name="release_date" :value="old('release_date', date('Y-m-d'))" class="mt-1 block w-full" required />
                        <x-input-error for="release_date" class="mt-2" />
                    </div>

                    <!-- Lifetime Years -->
                    <div>
                        <x-label for="lifetime_years" value="სერთიფიკატის ვადა (წლებში)" class="text-gray-900 dark:text-white" />
                        <x-input id="lifetime_years" type="number" name="lifetime_years" :value="old('lifetime_years', 5)" class="mt-1 block w-full" required />
                        <x-input-error for="lifetime_years" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-label for="status" value="სტატუსი" class="text-gray-900 dark:text-white" />
                        <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            @foreach(App\Enums\CertificateStatus::cases() as $status)
                                <option value="{{ $status->value }}" {{ old('status') == $status->value ? 'selected' : '' }}>{{ $status->label() }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="status" class="mt-2" />
                    </div>

                    <!-- Location -->
                    <div>
                        <x-label for="location" value="მდებარეობა" class="text-gray-900 dark:text-white" />
                        <x-input id="location" type="text" name="location" :value="old('location')" class="mt-1 block w-full" />
                        <x-input-error for="location" class="mt-2" />
                    </div>

                    <!-- Education -->
                    <div>
                        <x-label for="education" value="განათლება" class="text-gray-900 dark:text-white" />
                        <x-input id="education" type="text" name="education" :value="old('education')" class="mt-1 block w-full" />
                        <x-input-error for="education" class="mt-2" />
                    </div>

                    <!-- Experience -->
                    <div>
                        <x-label for="experience" value="გამოცდილება" class="text-gray-900 dark:text-white" />
                        <x-input id="experience" type="text" name="experience" :value="old('experience')" class="mt-1 block w-full" />
                        <x-input-error for="experience" class="mt-2" />
                    </div>

                    <!-- Social Media Links -->
                    <div>
                        <x-label for="social" value="სოციალური მედია დამატებულებები (დამატებულებები გამოყოფილი სურვილის სიმბოლით)" class="text-gray-900 dark:text-white" />
                        <x-input id="social" type="text" name="social" :value="old('social')" class="mt-1 block w-full" />
                        <x-input-error for="social" class="mt-2" />
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <x-label for="phone_number" value="ნომერი" class="text-gray-900 dark:text-white" />
                        <x-input id="phone_number" type="text" name="phone_number" :value="old('phone_number')" class="mt-1 block w-full" />
                        <x-input-error for="phone_number" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="email" value="ელ-ფოსტა" class="text-gray-900 dark:text-white" />
                        <x-input id="email" type="email" name="email" :value="old('email')" class="mt-1 block w-full" />
                        <x-input-error for="email" class="mt-2" />
                    </div>

                    <!-- Score -->
                    <div>
                        <x-label for="score" value="ქულა" class="text-gray-900 dark:text-white" />
                        <x-input id="score" type="number" step="0.01" name="score" :value="old('score')" class="mt-1 block w-full" />
                        <x-input-error for="score" class="mt-2" />
                    </div>

                    <!-- Rate -->
                    <div>
                        <x-label for="rate" value="რეიტინგი" class="text-gray-900 dark:text-white" />
                        <x-input id="rate" type="number" step="0.01" name="rate" :value="old('rate')" class="mt-1 block w-full" />
                        <x-input-error for="rate" class="mt-2" />
                    </div>

                    <!-- Jury Count -->
                    <div>
                        <x-label for="jury_count" value="შემფასებლების რაოდენობა" class="text-gray-900 dark:text-white" />
                        <x-input id="jury_count" type="number" name="jury_count" :value="old('jury_count', 0)" class="mt-1 block w-full" />
                        <x-input-error for="jury_count" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white">
                        სერთიფიკატის შექმნა
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-layout>

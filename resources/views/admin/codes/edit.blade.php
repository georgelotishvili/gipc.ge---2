<x-admin.layout>
    <div class="bg-white dark:bg-dark-2 rounded-2xl shadow-lg p-8">
        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-500/10 border-l-4 border-red-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">დადგენილების რედაქტირება</h2>
        </div>

        <div class="max-w-7xl mx-auto mt-10 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-dark-4 transition">
            <div class="max-w-7xl mx-auto rounded-3xl transition">
                <form action="{{ route('admin.codes.update', $group) }}" method="POST" class="space-y-10">
                    @csrf
                    @method('PATCH')
                    
                    <!-- Name -->
                    <div class="relative">
                        <input type="text" name="name" id="name" value="{{ $group->name }}"
                            class="peer w-full px-5 pt-5 pb-2 rounded-2xl border border-gray-300 bg-transparent text-lg text-gray-900 dark:text-white placeholder-transparent focus:border-primary-500 focus:ring-2 focus:ring-primary-500/40 dark:border-gray-600 dark:focus:border-primary-400 transition"
                            placeholder="დადგენილების კოდი" />
                        <label for="name"
                            class="absolute left-5 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-xs peer-focus:text-primary-500">
                            დადგენილების კოდი
                        </label>
                    </div>

                    <!-- Title -->
                    <div class="relative">
                        <input type="text" name="title" id="title" value="{{ $group->title }}"
                            class="peer w-full px-5 pt-5 pb-2 rounded-2xl border border-gray-300 bg-transparent text-lg text-gray-900 dark:text-white placeholder-transparent focus:border-primary-500 focus:ring-2 focus:ring-primary-500/40 dark:border-gray-600 dark:focus:border-primary-400 transition"
                            placeholder="დადგენილების სახელი" />
                        <label for="title"
                            class="absolute left-5 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-xs peer-focus:text-primary-500">
                            დადგენილების სახელი
                        </label>
                    </div>

                    <!-- Question Count -->
                    <div class="relative">
                        <input type="number" name="question_count_in_exam" id="question_count_in_exam" value="{{ $group->question_count_in_exam }}"
                            class="peer w-full px-5 pt-5 pb-2 rounded-2xl border border-gray-300 bg-transparent text-lg text-gray-900 dark:text-white placeholder-transparent focus:border-primary-500 focus:ring-2 focus:ring-primary-500/40 dark:border-gray-600 dark:focus:border-primary-400 transition"
                            placeholder="კითხვების რაოდენობა გამოცდაში" />
                        <label for="question_count_in_exam"
                            class="absolute left-5 top-2 text-gray-500 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base peer-focus:top-2 peer-focus:text-xs peer-focus:text-primary-500">
                            კითხვების რაოდენობა გამოცდაში
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('admin.codes') }}"
                            class="px-6 py-3 rounded-2xl border border-gray-200 bg-white/80 text-gray-700 hover:bg-gray-50 dark:border-dark-4 dark:bg-dark-3/70 dark:text-gray-200 dark:hover:bg-dark-3 transition shadow-md text-lg font-medium">
                            გაუქმება
                        </a>
                        <button type="submit"
                            class="px-6 py-3 rounded-2xl bg-primary-600 hover:bg-primary-700 text-white font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-primary-400/50 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2 shadow-lg transition">
                            შენახვა
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin.layout>

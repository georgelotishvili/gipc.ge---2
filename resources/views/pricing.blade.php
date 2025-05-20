<x-layout>
    <section class="dark:bg-dark" x-data="{
        selectedPlan: 'month',
        plans: {
            week: {
                name: '1 კვირა',
                price: '150',
                description: 'იდეალური მოკლევადიანი მომზადებისთვის',
                features: [
                    'სრული წვდომა ყველა მასალაზე',
                    'პრაქტიკული დავალებები',
                    'პროგრესის თვალყურის დევნება',
                    'მობილური ვერსია',
                    'ონლაინ კონსულტაცია',
                    'სერტიფიკატი'
                ]
            },
            month: {
                name: '1 თვე',
                price: '350',
                featured: true,
                description: 'საუკეთესო არჩევანი სრული მომზადებისთვის',
                features: [
                    'ყველა კვირის უპირატესობა',
                    'პერსონალური მენტორი',
                    'ჯგუფური მეცადინეობები',
                    'დამატებითი მასალები',
                    'პრიორიტეტული მხარდაჭერა',
                    'დამატებითი პრაქტიკული სავარჯიშოები'
                ]
            },
            year: {
                name: '1 წელი',
                price: '1150',
                description: 'სრული წვდომა მთელი წლის განმავლობაში',
                features: [
                    'ყველა თვის უპირატესობა',
                    'ულიმიტო წვდომა',
                    'VIP მხარდაჭერა',
                    'ექსკლუზიური მასალები',
                    'კარიერული კონსულტაცია',
                    'გარანტირებული დასაქმება'
                ]
            }
        }
    }">
        <div class="py-12 px-4 mx-auto max-w-screen-xl lg:px-6">
            <!-- Pricing Toggle -->
            <div class="flex justify-center items-center mb-12">
                <div class="flex items-center bg-white/50 backdrop-blur-sm dark:bg-gray-800/50 rounded-2xl p-2 shadow-lg border border-blue-100/50 dark:border-blue-900/50">
                    <label class="relative flex items-center p-2 rounded-xl cursor-pointer" :class="{ 'opacity-75': selectedPlan !== 'week' }">
                        <input type="radio" name="pricing-plan" value="week" class="sr-only peer" x-model="selectedPlan">
                        <span class="w-full h-full absolute inset-0 rounded-xl peer-checked:bg-gradient-to-br from-blue-500 to-blue-600 peer-checked:text-white transition-all duration-300 opacity-0 peer-checked:opacity-100 shadow-xl"></span>
                        <span class="relative z-10 px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 peer-checked:text-white transition-colors duration-300">1 კვირა</span>
                    </label>

                    <label class="relative flex items-center p-2 rounded-xl cursor-pointer mx-2" :class="{ 'opacity-75': selectedPlan !== 'month' }">
                        <input type="radio" name="pricing-plan" value="month" class="sr-only peer" x-model="selectedPlan">
                        <span class="w-full h-full absolute inset-0 rounded-xl peer-checked:bg-gradient-to-br from-blue-500 to-blue-600 peer-checked:text-white transition-all duration-300 opacity-0 peer-checked:opacity-100 shadow-xl"></span>
                        <span class="relative z-10 px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 peer-checked:text-white transition-colors duration-300">1 თვე</span>
                    </label>

                    <label class="relative flex items-center p-2 rounded-xl cursor-pointer" :class="{ 'opacity-75': selectedPlan !== 'year' }">
                        <input type="radio" name="pricing-plan" value="year" class="sr-only peer" x-model="selectedPlan">
                        <span class="w-full h-full absolute inset-0 rounded-xl peer-checked:bg-gradient-to-br from-blue-500 to-blue-600 peer-checked:text-white transition-all duration-300 opacity-0 peer-checked:opacity-100 shadow-xl"></span>
                        <span class="relative z-10 px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 peer-checked:text-white transition-colors duration-300">1 წელი</span>
                    </label>
                </div>
            </div>

            <!-- Pricing Card -->
            <div class="max-w-2xl mx-auto">
                <div class="relative p-8 mx-auto text-center bg-white/80 backdrop-blur-sm rounded-3xl border border-blue-100/50 shadow-2xl dark:bg-gray-800/80 dark:border-blue-900/50 transform transition-all duration-500 hover:scale-[1.02]"
                    :class="{ 'ring-4 ring-blue-500/20': plans[selectedPlan].featured }">
                    <!-- Featured Badge -->
                    <div class="absolute -top-5 left-1/2 transform -translate-x-1/2" x-show="plans[selectedPlan].featured">
                        <span class="inline-flex items-center px-6 py-2 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-semibold shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd" />
                            </svg>
                            რეკომენდებული
                        </span>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-600" x-text="plans[selectedPlan].name"></h3>
                        <p class="mt-2 text-lg text-blue-600/80 dark:text-blue-400/80" x-text="plans[selectedPlan].description"></p>
                    </div>

                    <div class="flex justify-center items-baseline my-8">
                        <span class="text-6xl font-extrabold bg-clip-text text-transparent bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-600">₾<span x-text="plans[selectedPlan].price"></span></span>
                        <span class="ml-2 text-xl text-blue-600/80 dark:text-blue-400/80" x-text="'/' + plans[selectedPlan].name.toLowerCase()"></span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <template x-for="feature in plans[selectedPlan].features" :key="feature">
                            <div class="flex items-center space-x-3 text-left p-4 bg-gradient-to-br from-blue-50 to-blue-50/50 dark:from-blue-900/20 dark:to-blue-900/10 rounded-xl backdrop-blur-sm">
                                <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600/10 dark:bg-blue-400/10">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="font-medium text-blue-900 dark:text-white" x-text="feature"></p>
                            </div>
                        </template>
                    </div>

                    <form x-bind:action="'/payment/' + plans[selectedPlan].price" method="GET">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center justify-center w-full md:w-auto px-8 py-4 text-base font-bold text-white bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 shadow-lg hover:shadow-blue-500/30 transform transition duration-300 hover:scale-[1.02] dark:focus:ring-blue-800">
                            დაიწყეთ ახლავე
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </form>

                    <p class="mt-6 text-sm text-blue-600/80 dark:text-blue-400/80 font-medium">30-დღიანი თანხის უკან დაბრუნების გარანტია. კითხვების გარეშე.</p>
                </div>
            </div>
        </div>
    </section>
</x-layout>

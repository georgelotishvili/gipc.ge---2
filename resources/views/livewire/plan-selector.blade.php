<div>
    @if(empty($plans))
        <section class="px-4 py-16 dark:bg-dark">
            <div class="mx-auto max-w-3xl rounded-md border border-blue-100 bg-white p-8 text-center shadow-[0_10px_30px_rgba(37,99,235,0.08)] dark:border-slate-700 dark:bg-slate-900">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">აქტიური პაკეტები ამჟამად არ არის</h2>
                <p class="mt-3 text-sm leading-6 text-gray-600 dark:text-slate-300">
                    გთხოვთ მოგვიანებით სცადოთ ან დაგვიკავშირდეთ ადმინისტრაციასთან.
                </p>
            </div>
        </section>
    @else
    <section class="dark:bg-dark"
        x-data='{
            selectedPlan: "{{ array_key_first($plans) }}",
            plans: @json($plans),
            showAgreementModal: @json($showAgreementModal),
            agreementAccepted: @json($agreementAccepted),
            selectedPlanId: @json($selectedPlanId)
        }'>
    <div class="py-12 px-4 mx-auto max-w-screen-xl lg:px-6">

        <div class="flex justify-center items-center mb-12">
            <div
                class="flex items-center bg-white/50 backdrop-blur-sm dark:bg-gray-800/50 rounded-md p-2 shadow-lg border border-blue-100/50 dark:border-blue-900/50">
                <template x-for="(plan, type) in plans" :key="type">
                    <label class="relative flex items-center p-2 rounded-md cursor-pointer"
                        :class="{ 'opacity-75': selectedPlan !== type }">
                        <input type="radio" name="pricing-plan" :value="type" class="sr-only peer"
                            x-model="selectedPlan">
                        <span
                            class="w-full h-full absolute inset-0 rounded-md peer-checked:bg-gradient-to-br from-blue-500 to-blue-600 peer-checked:text-white transition-all duration-300 opacity-0 peer-checked:opacity-100 shadow-xl"></span>
                        <span
                            class="relative z-10 px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 peer-checked:text-white transition-colors duration-300"
                            x-text="type"></span>
                    </label>
                </template>
            </div>
        </div>
        <div class="max-w-2xl mx-auto">
            <div class="relative p-8 mx-auto text-center bg-white/80 backdrop-blur-sm rounded-md border border-blue-100/50 shadow-2xl dark:bg-gray-800/80 dark:border-blue-900/50 transform transition-all duration-500 hover:scale-[1.02]"
                :class="{ 'ring-4 ring-blue-500/20': plans[selectedPlan].isRecommended }">

                <div class="absolute -top-5 left-1/2 transform -translate-x-1/2"
                    x-show="plans[selectedPlan].isRecommended">
                    <span
                        class="inline-flex items-center px-6 py-2 rounded-md bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-semibold shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z"
                                clip-rule="evenodd" />
                        </svg>
                        რეკომენდებული
                    </span>
                </div>

                <div class="mt-6">
                    <h3 class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-600"
                        x-text="plans[selectedPlan].name"></h3>
                    <p class="mt-2 text-lg text-blue-600/80 dark:text-blue-400/80"
                        x-text="plans[selectedPlan].description"></p>
                </div>

                <div class="flex justify-center items-baseline my-8">
                    <span
                        class="text-6xl font-extrabold bg-clip-text text-transparent bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-600">
                        ₾<span x-text="plans[selectedPlan].price"></span>
                    </span>
                    <span class="ml-2 text-xl text-blue-600/80 dark:text-blue-400/80"
                        x-text="'/' + plans[selectedPlan].type.toLowerCase()"></span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <template x-for="option in plans[selectedPlan].options" :key="option.id">
                        <div
                            class="flex items-center space-x-3 text-left p-4 bg-gradient-to-br from-blue-50 to-blue-50/50 dark:from-blue-900/20 dark:to-blue-900/10 rounded-md backdrop-blur-sm">
                            <div
                                class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-md bg-blue-600/10 dark:bg-blue-400/10">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="font-medium text-blue-900 dark:text-white" x-text="option.description"></p>
                        </div>
                    </template>
                </div>

                <button 
                    @click="selectedPlanId = plans[selectedPlan].id; $wire.setSelectedPlan(plans[selectedPlan].id); $wire.openAgreementModal()"
                    class="inline-flex items-center justify-center w-full md:w-auto px-8 py-4 text-base font-bold text-white bg-gradient-to-br from-blue-500 to-blue-600 rounded-md hover:from-blue-600 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 shadow-lg hover:shadow-blue-500/30 transform transition duration-300 hover:scale-[1.02] dark:focus:ring-blue-800">
                    დაიწყეთ ახლავე
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Agreement Modal -->
    <div x-show="$wire.showAgreementModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
        
        <!-- Modal content -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-md transform overflow-hidden rounded-md bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-2xl transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            გადახდაზე დათანხმება
                        </h3>
                    </div>
                    <button @click="$wire.closeModal()" 
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Content -->
                <div class="mb-6">
                    <div class="flex items-start space-x-3 mb-4">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                            გადახდის განსახორციელებლად თქვენ უნდა დაეთანხმოთ <strong>Flitt</strong>-ის მიერ თქვენი საბარათე ინფორმაციის შენახვას მომავალი გადახდებისთვის.
                        </p>
                    </div>
                </div>
                
                <!-- Checkbox -->
                <div class="mb-6">
                    <label class="flex items-start space-x-3 cursor-pointer p-3 bg-gray-50 dark:bg-gray-700 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                        <input type="checkbox" 
                               wire:model="agreementAccepted"
                               class="mt-1 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-md focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            მე ვეთანხმები, რომ Flitt შეინახოს ჩემი საბარათე ინფორმაცია მომავალი გადახდებისთვის
                        </span>
                    </label>
                </div>
                
                <!-- Buttons -->
                <div class="flex space-x-3">
                    <button @click="$wire.closeModal()"
                            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-transparent rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
                        გაუქმება
                    </button>
                    <button @click="if($wire.agreementAccepted) { $wire.acceptAgreement() }"
                            :disabled="!$wire.agreementAccepted"
                            :class="$wire.agreementAccepted ? 'bg-blue-600 hover:bg-blue-700 cursor-pointer' : 'bg-gray-300 cursor-not-allowed'"
                            class="flex-1 px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 transition-colors">
                        გაგრძელება
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
    @endif

</div>

<!-- Banner Slider -->
<div x-data="{ 
    currentSlide: parseInt(localStorage.getItem('currentSlide')) || 0,
    slides: [
        @foreach($commercials as $commercial)
            { 
                image: '{{ $commercial->getImageLinkAttribute() }}', 
                title: '{{ $commercial->name }}', 
                subtitle: '{{ $commercial->description }}' 
            }@if(!$loop->last),@endif
        @endforeach
    ]
}"
x-init="
    setInterval(() => { 
        currentSlide = (currentSlide + 1) % slides.length;
        localStorage.setItem('currentSlide', currentSlide);
    }, 4000);
    $watch('currentSlide', value => localStorage.setItem('currentSlide', value));"
class="relative left-1/2 w-screen -translate-x-1/2 mb-8">
    
    <!-- Slides Container -->
    <div class="relative h-[250px] overflow-hidden border-y border-slate-400 dark:border-slate-600">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-full"
                class="absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
                <img :src="slide.image" :alt="slide.title" 
                    class="w-full h-full object-cover">
                <div class="absolute bottom-0 left-0 right-0 p-12 text-white">
                    <h2 class="text-4xl font-bold mb-4" x-text="slide.title"></h2>
                    <p class="text-xl" x-text="slide.subtitle"></p>
                </div>
            </div>
        </template>
    </div>
    <div class="h-1 w-full bg-white dark:bg-slate-900"></div>
    <div class="h-1 w-full bg-gradient-to-r from-indigo-500 to-purple-600"></div>

    <!-- Navigation Dots -->
    <!-- <div class="flex justify-center gap-3 mt-6">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="currentSlide = index"
                    :class="{ 'bg-primary-600': currentSlide === index, 'bg-gray-300 dark:bg-gray-700': currentSlide !== index }"
                    class="w-3 h-3 rounded-md transition-colors duration-200">
            </button>
        </template>
    </div> -->
</div>

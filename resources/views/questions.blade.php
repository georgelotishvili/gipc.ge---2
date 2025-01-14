<x-layout>
    <!-- ====== Questions Section Start -->
    <div class="relative z-10 overflow-hidden pb-[60px] pt-[120px] dark:bg-dark md:pt-[130px] lg:pt-[160px]">
        <h1
            class="mb-4 text-2xl text-center font-bold text-dark dark:text-white sm:text-xl md:text-[24px] md:leading-[1.2]">
            რატომ არის ჯავახეთის სოფელ აიაზმიში უკეთესი ასფალტი ვიდრე ნახალოვკაში?
        </h1>
        <p class="timer text-center mb-4 text-lg dark:text-white"></p>
        <div class="container flex justify-center">
            <div class="-mx-4">
                <div class="px-4 flex flex-col gap-4 justify-center">
                    <button
                        class="wrong-answer font-semibold py-2 px-4 border border-gray-300 rounded shadow-lg text-left max-w-md dark:text-white">
                        რატომ არის ჯავახეთის სოფელ აიაზმიში უკეთესი ასფალტი ვიდრე
                        ნახალოვკაში რატომ არის ჯავახეთის სოფელ აიაზმიში უკეთესი ასფალტი
                        ვიდრე ნახალოვკაში
                    </button>
                    <button
                        class="answer font-semibold py-2 px-4 border border-gray-300 rounded shadow-lg text-left max-w-md dark:text-white">
                        რატომ არის ჯავახეთის სოფელ აიაზმიში უკეთესი ასფალტი ვიდრე
                        ნახალოვკაში
                    </button>
                    <button class="font-semibold py-2 px-4 border border-gray-300 rounded shadow-md text-left max-w-md dark:text-white">
                        რატომ არის ჯავახეთის სოფელ აიაზმიში უკეთესი ასფალტი ვიდრე
                        ნახალოვკაში
                    </button>
                    <button class="font-semibold py-2 px-4 border border-gray-300 rounded shadow-md text-left max-w-md dark:text-white">
                        რატომ არის ჯავახეთის სოფელ აიაზმიში უკეთესი ასფალტი ვიდრე
                        ნახალოვკაში
                    </button>
                </div>
                <div class="flex justify-between items-center gap-4 px-2">
                    <button type="button"
                        class="text-white mt-4 ml-1 bg-primary hover:bg-blue-dark focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-chevron-left fa-lg"></i>
                    </button>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-primary z-50 h-2.5 rounded-full dark:bg-primary" style="width: 75%"></div>
                    </div>
                    <button type="button"
                        class="text-white mt-4 bg-primary hover:bg-blue-dark focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-chevron-right fa-lg"></i>
                    </button>
                </div>
                <span class="absolute top-0 dark:text-white">23:14</span>
            </div>
        </div>
    </div>
    <!-- ====== Questions Section End -->
</x-layout>
<script>
    let wrongAnswer = document.querySelector(".wrong-answer");
    let answer = document.querySelector(".answer");
    // let timer = document.querySelector(".timer");
    wrongAnswer.addEventListener("click", function() {
        wrongAnswer.classList.add("bg-red-500", "text-white");
        answer.classList.add("bg-emerald-500", "text-white");
    });

    answer.addEventListener("click", function() {
        answer.classList.add("bg-emerald-500", "text-white");
    });


    let secs = 1800;
    let minutes = Math.floor(secs / 60);
    let countDownSecs = secs % 60;

    const timer = setInterval(() => {
        document.querySelector(".timer").textContent =
            `${minutes}:${countDownSecs.toString().padStart(2, '0')}`;

        secs--;
        minutes = Math.floor(secs / 60);
        countDownSecs = secs % 60;

        if (secs <= 0) {
            clearInterval(timer);
        }
    }, 1000);
</script>

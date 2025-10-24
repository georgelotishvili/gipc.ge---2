<x-admin.layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-dark dark:to-dark-2 relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500/10 dark:bg-primary-400/5 rounded-full blur-3xl animate-float"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500/10 dark:bg-blue-400/5 rounded-full blur-3xl animate-float-delayed"></div>
            <div class="absolute top-1/4 left-1/4 w-40 h-40 bg-purple-500/10 dark:bg-purple-400/5 rounded-full blur-2xl animate-float-slow"></div>
        </div>
        
        <div class="relative z-10 max-w-[1920px] mx-auto px-6 py-8">
            <!-- Header with animated gradient -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    ახალი <span class="bg-gradient-to-r from-primary-400 via-blue-400 to-purple-400 bg-clip-text text-transparent animate-gradient">ვიდეოს</span> დამატება
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    შეავსეთ ფორმა ახალი ვიდეოს დასამატებლად
                </p>
            </div>

            @if ($errors->any())
                <div class="max-w-2xl mx-auto mb-6">
                    <div class="bg-red-50 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-lg p-4 shadow-lg transform transition-all duration-300 hover:scale-[1.01]">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                                    გთხოვთ გაასწოროთ შემდეგი შეცდომები:
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
                </div>
            @endif

            @if (session('success'))
                <div class="max-w-2xl mx-auto mb-6">
                    <div class="bg-green-50 dark:bg-green-900/50 border border-green-200 dark:border-green-800 rounded-lg p-4 shadow-lg transform transition-all duration-300 hover:scale-[1.01]">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Video Creation Form -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('admin.courses.chapters.videos.store', [$course, $chapter]) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="video-upload-form">
                    @csrf
                    @method('POST')
                    <div class="bg-white dark:bg-dark-2 rounded-2xl p-8 shadow-2xl border border-gray-100 dark:border-gray-800 backdrop-blur-sm transform transition-all duration-300 hover:shadow-primary-500/20 dark:hover:shadow-primary-400/10 relative overflow-hidden">
                        <!-- Decorative elements -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary-500/10 to-transparent rounded-bl-full"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-blue-500/10 to-transparent rounded-tr-full"></div>
                        
                        <!-- Video Name -->
                        <div class="mb-8 relative">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                ვიდეოს სახელი
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   required
                                   class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-dark-3 text-gray-900 dark:text-white px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50 transition-all duration-200"
                                   placeholder="შეიყვანეთ ვიდეოს სახელი">
                        </div>

                        <!-- Video Description -->
                        <div class="mb-8 relative">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                ვიდეოს აღწერა
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      required
                                      rows="4" 
                                      class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-dark-3 text-gray-900 dark:text-white px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50 transition-all duration-200"
                                      placeholder="შეიყვანეთ ვიდეოს აღწერა"></textarea>
                        </div>

                        <!-- Video Weight -->
                        <div class="mb-8 relative">
                            <label for="weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                რიგი
                                <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">(მიმდინარე მაქსიმალური რიგი: {{ $nextWeight - 1 }})</span>
                            </label>
                            <input type="number" 
                                   name="weight" 
                                   id="weight" 
                                   step="any"
                                   min="0"
                                   value="{{ $nextWeight }}"
                                   class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-dark-3 text-gray-900 dark:text-white px-4 py-3 focus:border-primary-500 focus:ring-2 focus:ring-primary-500 focus:ring-opacity-50 transition-all duration-200"
                                   placeholder="შეიყვანეთ ვიდეოს რიგითი ნომერი">
                        </div>

                        <!-- Video Upload with Progress Bar -->
                        <div class="mb-8 relative">
                            <label for="video" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                ვიდეო ფაილი
                            </label>
                            <div class="relative">
                                <div class="flex items-center justify-center w-full">
                                    <label for="video" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl cursor-pointer bg-gray-50 dark:bg-dark-3 hover:bg-gray-100 dark:hover:bg-dark-4 transition-all duration-300 group animate-pulse">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-16 h-16 mb-3 text-primary-500 dark:text-primary-400 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">დააჭირეთ ატვირთვისთვის</span> ან გადაიტანეთ ფაილი</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">MP4, MOV, AVI (მაქს. 500MB)</p>
                                        </div>
                                        <input type="file" 
                                               name="video" 
                                               id="video" 
                                               class="hidden" 
                                               required
                                               accept="video/*"
                                               onchange="handleVideoSelection(this)">
                                    </label>
                                </div>
                                <p id="video-filename" class="mt-2 text-sm text-gray-500 dark:text-gray-400"></p>
                                <p id="video-filesize" class="mt-1 text-xs text-gray-400 dark:text-gray-500"></p>
                                
                                <!-- Ultra Modern Upload Progress Bar (Hidden by default) -->
                                <div id="upload-progress-container" class="mt-4 hidden">
                                    <div class="flex justify-between mb-2">
                                        <span class="text-xs font-medium text-primary-500 dark:text-primary-400" id="upload-progress-text">0%</span>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400" id="upload-status">ატვირთვა...</span>
                                    </div>
                                    
                                    <!-- Circular progress indicator -->
                                    <div class="relative w-full h-4 mb-2">
                                        <div class="absolute inset-0 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                            <div id="upload-progress-bar" class="h-full rounded-full transition-all duration-300 relative" style="width: 0%; background: linear-gradient(90deg, #3b82f6 0%, #60a5fa 50%, #93c5fd 100%);">
                                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent animate-shimmer"></div>
                                            </div>
                                        </div>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="w-full h-1 bg-white/50 dark:bg-dark-2/50 rounded-full"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Additional upload information -->
                                    <div class="grid grid-cols-3 gap-2 text-xs text-gray-500 dark:text-gray-400 mt-3">
                                        <div class="flex items-center bg-blue-50 dark:bg-blue-900/20 rounded-lg p-2">
                                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            <span id="upload-speed">0 KB/s</span>
                                        </div>
                                        <div class="flex items-center bg-blue-50 dark:bg-blue-900/20 rounded-lg p-2">
                                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span id="upload-time">დათვლა...</span>
                                        </div>
                                        <div class="flex items-center bg-blue-50 dark:bg-blue-900/20 rounded-lg p-2">
                                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span id="upload-size">0 MB</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Free (Public) Checkbox -->
                        <div class="mb-8">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="free" id="free" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="free" class="text-sm font-medium text-gray-700 dark:text-gray-300">უფასო ვიდეო</label>
                            </div>
                        </div>

                        <!-- Thumbnail Image -->
                        <div class="mb-8 relative">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                სურათი (თამბნეილი)
                            </label>
                            <div class="relative">
                                <div class="flex items-center justify-center w-full">
                                    <label for="thumbnail" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl cursor-pointer bg-gray-50 dark:bg-dark-3 hover:bg-gray-100 dark:hover:bg-dark-4 transition-all duration-300 group">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-16 h-16 mb-3 text-primary-500 dark:text-primary-400 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">დააჭირეთ ატვირთვისთვის</span> ან გადაიტანეთ ფაილი</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">JPG, PNG, GIF (მაქს. 2MB)</p>
                                        </div>
                                        <input type="file" 
                                               name="thumbnail" 
                                               id="thumbnail" 
                                               class="hidden" 
                                               accept="image/*"
                                               onchange="updateFileName(this, 'thumbnail-filename')">
                                    </label>
                                </div>
                                <p id="thumbnail-filename" class="mt-2 text-sm text-gray-500 dark:text-gray-400"></p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    id="submit-btn"
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-medium rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <i class="fas fa-save mr-2"></i>
                                ვიდეოს დამატება
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add animations -->
    <style>
        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }
        .animate-shimmer {
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-float-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }
        
        .animate-float-slow {
            animation: float 8s ease-in-out infinite;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        .animate-gradient {
            background-size: 200% auto;
            animation: gradient 3s ease infinite;
        }
        
        /* Custom progress bar animation */
        #upload-progress-bar {
            position: relative;
            overflow: hidden;
        }
        
        #upload-progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, 
                rgba(255,255,255,0) 0%, 
                rgba(255,255,255,0.3) 50%, 
                rgba(255,255,255,0) 100%);
            animation: progress-shine 1.5s infinite;
        }
        
        @keyframes progress-shine {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }
        
        /* Enhanced card design */
        .bg-white {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .bg-white:hover {
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }
        
        /* Enhanced input fields */
        input:focus, textarea:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        
        /* Enhanced upload area */
        label[for="video"]:hover, label[for="thumbnail"]:hover {
            border-color: #3b82f6;
            background-color: rgba(59, 130, 246, 0.05);
        }
    </style>

    <!-- JavaScript for file upload handling -->
    <script>
        // Function to update the filename display
        function updateFileName(input, elementId) {
            const fileNameElement = document.getElementById(elementId);
            if (input.files && input.files[0]) {
                fileNameElement.textContent = input.files[0].name;
            } else {
                fileNameElement.textContent = '';
            }
        }
        
        // Function to handle video selection
        function handleVideoSelection(input) {
            const fileNameElement = document.getElementById('video-filename');
            const fileSizeElement = document.getElementById('video-filesize');
            
            if (input.files && input.files[0]) {
                const file = input.files[0];
                fileNameElement.textContent = file.name;
                fileSizeElement.textContent = formatFileSize(file.size);
                
                // Show progress container
                document.getElementById('upload-progress-container').classList.remove('hidden');
            } else {
                fileNameElement.textContent = '';
                fileSizeElement.textContent = '';
                document.getElementById('upload-progress-container').classList.add('hidden');
            }
        }
        
        // Function to format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Function to format time
        function formatTime(seconds) {
            if (seconds < 60) return Math.round(seconds) + ' წამი';
            if (seconds < 3600) return Math.round(seconds / 60) + ' წუთი';
            return Math.round(seconds / 3600) + ' საათი';
        }
        
        // Form submission with progress tracking
        document.getElementById('video-upload-form').addEventListener('submit', function(e) {
            const videoInput = document.getElementById('video');
            const progressBar = document.getElementById('upload-progress-bar');
            const progressText = document.getElementById('upload-progress-text');
            const uploadStatus = document.getElementById('upload-status');
            const uploadSpeed = document.getElementById('upload-speed');
            const uploadTime = document.getElementById('upload-time');
            const uploadSize = document.getElementById('upload-size');
            const submitBtn = document.getElementById('submit-btn');
            
            if (videoInput.files && videoInput.files[0]) {
                // Disable submit button during upload
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                
                // Show progress container
                document.getElementById('upload-progress-container').classList.remove('hidden');
                
                // Get file size
                const fileSize = videoInput.files[0].size;
                uploadSize.textContent = formatFileSize(fileSize);
                
                // Create a FormData object
                const formData = new FormData(this);
                
                // Create an XMLHttpRequest object
                const xhr = new XMLHttpRequest();
                
                // Variables for tracking upload speed and time
                let startTime = new Date().getTime();
                let lastLoaded = 0;
                let lastTime = startTime;
                
                // Set up the progress event handler
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = Math.round((e.loaded / e.total) * 100);
                        progressBar.style.width = percentComplete + '%';
                        progressText.textContent = percentComplete + '%';
                        
                        // Calculate upload speed
                        const currentTime = new Date().getTime();
                        const timeDiff = (currentTime - lastTime) / 1000; // in seconds
                        
                        if (timeDiff > 0) {
                            const loadedDiff = e.loaded - lastLoaded;
                            const speed = loadedDiff / timeDiff; // bytes per second
                            uploadSpeed.textContent = formatFileSize(speed) + '/s';
                            
                            // Calculate remaining time
                            const remainingBytes = e.total - e.loaded;
                            const remainingSeconds = remainingBytes / speed;
                            uploadTime.textContent = formatTime(remainingSeconds);
                            
                            // Update last values
                            lastLoaded = e.loaded;
                            lastTime = currentTime;
                        }
                        
                        if (percentComplete === 100) {
                            uploadStatus.textContent = 'ატვირთვა დასრულებულია';
                            uploadTime.textContent = 'დასრულებულია';
                        }
                    }
                });
                
                // Set up the load event handler
                xhr.addEventListener('load', function() {
                    if (xhr.status === 200) {
                        // Upload successful
                        progressBar.style.width = '100%';
                        progressText.textContent = '100%';
                        uploadStatus.textContent = 'ატვირთვა წარმატებით დასრულდა';
                        uploadTime.textContent = 'დასრულებულია';
                        
                        // Redirect to the videos page after a short delay
                        setTimeout(function() {
                            window.location.href = '{{ route('admin.courses.chapters.videos', [$course, $chapter]) }}';
                        }, 1000);
                    } else {
                        // Upload failed
                        uploadStatus.textContent = 'ატვირთვა ვერ მოხერხდა';
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                });
                
                // Set up the error event handler
                xhr.addEventListener('error', function() {
                    uploadStatus.textContent = 'ატვირთვა ვერ მოხერხდა';
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                });
                
                // Open the request
                xhr.open('POST', this.action, true);
                
                // Send the request
                xhr.send(formData);
                
                // Prevent the default form submission
                e.preventDefault();
            }
        });
    </script>
</x-admin.layout>

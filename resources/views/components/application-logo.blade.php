<!-- Option 1: Modern Architectural Logo -->
<div class="flex items-center gap-2">
    <svg class="w-12 h-12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Enhanced 3D Effects -->
        <defs>
            <filter id="fire-glow" x="-50%" y="-50%" width="200%" height="200%">
                <feGaussianBlur stdDeviation="1.5" result="blur"/>
                <feFlood flood-color="#2563eb" flood-opacity="0.5"/>
                <feComposite in2="blur" operator="in"/>
                <feComposite in="SourceGraphic"/>
            </filter>

            <!-- 3D Gradient with More Depth -->
            <linearGradient id="fireGradient" x1="0%" y1="100%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#1e40af">
                    <animate attributeName="stop-color" 
                            values="#1e40af;#2563eb;#1e40af" 
                            dur="2s" 
                            repeatCount="indefinite"/>
                </stop>
                <stop offset="100%" stop-color="#60a5fa">
                    <animate attributeName="stop-color" 
                            values="#60a5fa;#93c5fd;#60a5fa" 
                            dur="2s" 
                            repeatCount="indefinite"/>
                </stop>
            </linearGradient>

            <!-- Enhanced Pattern for Depth -->
            <pattern id="flame" x="0" y="0" width="4" height="4" patternUnits="userSpaceOnUse">
                <path d="M2 2L4 4M0 0L2 2M0 4L4 0" stroke="rgba(37,99,235,0.2)" stroke-width="0.5">
                    <animate attributeName="stroke-width" 
                             values="0.5;1;0.5" 
                             dur="1s" 
                             repeatCount="indefinite"/>
                </path>
            </pattern>
        </defs>

        <!-- Background Pulse with More Depth -->
        <circle cx="24" cy="24" r="20" fill="url(#flame)" opacity="0.1">
            <animate attributeName="r" 
                     values="20;22;20" 
                     dur="1.5s" 
                     repeatCount="indefinite"/>
        </circle>

        <!-- Enhanced 3D Building Shape -->
        <path d="M10 38V10L24 4L38 10V38L24 44L10 38Z" 
              fill="url(#fireGradient)"
              filter="url(#fire-glow)"
              style="transform-origin: center; transform: perspective(800px) rotateY(-15deg) rotateX(5deg)">
            <animate attributeName="d" 
                     values="M10 38V10L24 4L38 10V38L24 44L10 38Z;
                             M10 39V11L24 3L38 11V39L24 45L10 39Z;
                             M10 38V10L24 4L38 10V38L24 44L10 38Z" 
                     dur="2s" 
                     repeatCount="indefinite"/>
        </path>

        <!-- Enhanced Inner Structure -->
        <path d="M16 34V14L24 11L32 14V34L24 37L16 34Z" 
              class="fill-white dark:fill-gray-800 opacity-90"
              style="transform-origin: center; transform: perspective(800px) rotateY(-15deg) rotateX(5deg)">
            <animate attributeName="opacity" 
                     values="0.9;0.7;0.9" 
                     dur="1.5s" 
                     repeatCount="indefinite"/>
        </path>

        <!-- Dynamic Energy Lines with 3D Effect -->
        <g class="stroke-primary-300 dark:stroke-primary-600" 
           stroke-width="1" 
           stroke-dasharray="3,3"
           style="transform-origin: center; transform: perspective(800px) rotateY(-15deg) rotateX(5deg)">
            <path d="M24 4L24 11M10 10L16 14M38 10L32 14">
                <animate attributeName="stroke-dashoffset" 
                         values="0;6;0" 
                         dur="1s" 
                         repeatCount="indefinite"/>
            </path>
        </g>
    </svg>

    <!-- Text with Enhanced 3D Effect -->
    <span class="text-3xl font-extrabold tracking-tight relative group">
        <span class="bg-gradient-to-r from-blue-700 via-blue-500 to-blue-400 bg-clip-text text-transparent 
                     group-hover:from-blue-400 group-hover:via-blue-500 group-hover:to-blue-700 
                     transition-all duration-500 animate-gradient"
              style="text-shadow: 2px 2px 4px rgba(37,99,235,0.2)">
            GIPC
        </span>
        <span class="absolute -inset-1 bg-gradient-to-r from-blue-500/20 to-blue-400/20 blur-lg 
                     group-hover:opacity-75 transition-opacity opacity-0"></span>
    </span>
</div>

<style>
@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}
</style>
<!-- Option 1: Modern Architectural Logo -->
<a href="/" wire:navigate>
    <div class="flex items-center gap-2">
        <x-admin.sidebar-logo/>

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
</a>

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
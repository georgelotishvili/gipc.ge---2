@props([
    'user',
    'class' => 'h-10 w-10',
    'iconClass' => 'h-5 w-5',
])

@php
    $photoUrl = null;

    if ($user?->image?->path) {
        $photoUrl = asset('storage/' . $user->image->path);
    } elseif ($user?->profile_photo_path) {
        $photoUrl = Storage::url($user->profile_photo_path);
    }
@endphp

@if($photoUrl)
    <img src="{{ $photoUrl }}"
         alt="{{ $user?->name ?? 'User' }}"
         {{ $attributes->merge(['class' => $class . ' rounded-md object-cover object-center']) }}>
@else
    <div {{ $attributes->merge(['class' => $class . ' rounded-md bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300 flex items-center justify-center']) }}>
        <svg class="{{ $iconClass }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1116.5 0"/>
        </svg>
    </div>
@endif

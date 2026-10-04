@props(['status' => 'pending'])

@php
    $map = [
        'done'    => ['bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300', 'M5 13l4 4L19 7'],
        'pending' => ['bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-300',         'M12 8v4l3 3'],
    ];
    [$classes, $icon] = $map[$status] ?? $map['pending'];
@endphp

<span class="badge {{ $classes }}">
    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $icon }}" />
    </svg>
    {{ ucfirst($status) }}
</span>
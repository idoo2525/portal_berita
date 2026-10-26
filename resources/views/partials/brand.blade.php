@php
    $variant = $variant ?? 'dark';
    $size = $size ?? 'medium';
    $wordmarkColor = $variant === 'light' ? 'text-white' : 'text-[#17211e]';
    $accentColor = $variant === 'light' ? 'text-[#d9f279]' : 'text-[#176b52]';
    $markSize = match ($size) {
        'small' => 'h-8 w-8',
        'large' => 'h-12 w-12',
        default => 'h-10 w-10',
    };
    $wordSize = match ($size) {
        'small' => 'text-lg',
        'large' => 'text-3xl',
        default => 'text-2xl',
    };
@endphp

<a href="{{ route('home') }}" class="inline-flex items-center gap-2.5" aria-label="KabarKita, halaman utama">
    <img src="{{ asset('images/kabarkita-mark.svg') }}" alt="" width="48" height="48" class="{{ $markSize }} shrink-0">
    <span class="font-[Manrope] font-extrabold tracking-normal {{ $wordSize }} {{ $wordmarkColor }}">
        kabar<span class="{{ $accentColor }}">kita</span><span class="{{ $accentColor }}">.</span>
    </span>
</a>
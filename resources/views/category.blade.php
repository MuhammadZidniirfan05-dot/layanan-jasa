@extends('layouts.app')

@section('content')

@php
    $categoryIcons = [
        'website' => 'M12 21a9 9 0 100-18 9 9 0 000 18zM3.6 9h16.8M3.6 15h16.8M12 3c2.5 2.8 3.8 6 3.8 9s-1.3 6.2-3.8 9c-2.5-2.8-3.8-6-3.8-9s1.3-6.2 3.8-9z',
        'tugas-kuliah' => 'M22 9L12 4 2 9l10 5 10-5zM6 11.5V17c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5M22 9v6',
        'presentasi-ppt' => 'M3 5h18v12H3zM3 19h18M9 9l3 2-3 2V9z',
        'desain-grafis' => 'M12 19l7-7 3 3-7 7-3-3zM18 13l-1.5-7.5L11 4l1 6.5L18 13zM3 21c1-1.5 2-2 4-2s3 .5 4 2',
    ];
    $defaultIcon = 'M9 12l2 2 4-4m5.5 2a9.5 9.5 0 11-19 0 9.5 9.5 0 0119 0z';
    $iconPath = $categoryIcons[$category->slug] ?? $defaultIcon;
    $minPrice = $services->pluck('starting_price')->filter()->min();
@endphp

<style>
    .svc-row {
        position: relative; overflow: hidden;
        background: #fff;
        border-left: 5px solid var(--brand-primary);
        box-shadow: 0 10px 26px -14px color-mix(in srgb, var(--brand-secondary) 45%, transparent);
        transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    }
    .svc-row:hover {
        transform: translateY(-3px);
        border-left-color: var(--brand-accent);
        box-shadow: 0 18px 34px -14px color-mix(in srgb, var(--brand-primary) 55%, transparent);
    }

    .svc-btn { display: inline-flex; align-items: center; justify-content: center; gap: .5rem; font-weight: 700; font-size: .85rem;
        padding: .65rem 1.4rem; border-radius: 9999px; background: var(--brand-secondary); color: #fff;
        white-space: nowrap; transition: all .3s ease; }
    .svc-btn:hover, .svc-btn:active, .svc-btn:focus-visible { background: var(--brand-accent); color: var(--brand-secondary); transform: scale(1.05); }
</style>

@include('partials.navbar')

{{-- ============ HEADER KATEGORI ============ --}}
<section class="relative overflow-hidden rounded-b-[1.5rem]" style="background: var(--brand-secondary)">
    <div class="absolute -right-12 -top-16 w-40 h-40 rounded-full anim-float" style="background: color-mix(in srgb, var(--brand-accent) 16%, transparent)"></div>
    <div class="absolute -left-14 -bottom-20 w-40 h-40 rounded-full" style="background: color-mix(in srgb, var(--brand-primary) 35%, transparent)"></div>

    <div class="relative max-w-6xl mx-auto px-5 pt-2 pb-4 md:pb-5">
        {{-- baris atas: tombol kembali + label, sejajar --}}
        <div class="anim-fade-up relative flex items-center justify-center min-h-[28px]">
            <a href="{{ route('landing') }}" class="absolute left-0 top-1/2 -translate-y-1/2 inline-flex items-center gap-1.5 text-white/70 text-sm hover:text-white transition-colors">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7" /></svg>
                <span class="hidden sm:inline">Kembali ke Beranda</span>
                <span class="sm:hidden">Kembali</span>
            </a>

            <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-accent)">Kategori Layanan</span>
        </div>

        <div class="text-center max-w-2xl mx-auto">
            <h1 class="anim-fade-up text-3xl md:text-5xl font-extrabold text-white leading-tight" style="animation-delay: 0.08s">{{ $category->name }}</h1>

            @if(!empty($category->description))
                <p class="anim-fade-up text-white/75 mt-1.5 leading-relaxed" style="animation-delay: 0.16s">{{ $category->description }}</p>
            @endif

            <div class="anim-fade-up mt-3 flex flex-wrap items-center justify-center gap-3" style="animation-delay: 0.24s">
                <span class="text-xs font-semibold px-4 py-2 rounded-full bg-white/10 text-white backdrop-blur border border-white/15">
                    {{ $services->count() }} sub-layanan
                </span>
                @if($minPrice)
                    <span class="text-xs font-bold px-4 py-2 rounded-full" style="background: var(--brand-accent); color: var(--brand-secondary)">
                        Mulai Rp{{ number_format($minPrice, 0, ',', '.') }}
                    </span>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ============ LIST SUB-LAYANAN ============ --}}
<section class="max-w-5xl mx-auto px-5 pt-12 pb-16">
    <div class="space-y-4">
        @forelse($services as $i => $service)
            <div class="reveal svc-row rounded-2xl"
                 style="transition-delay: {{ $i * 90 }}ms"
                 x-data="{ expanded: false }">

                <div class="p-5 md:p-6 flex flex-col md:flex-row md:items-center gap-5">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-12 h-12 rounded-xl shrink-0 flex items-center justify-center font-extrabold text-sm"
                             style="background: var(--brand-secondary); color: var(--brand-accent)">
                            {{ sprintf('%02d', $i + 1) }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-extrabold text-lg" style="color: var(--brand-secondary)">{{ $service->title }}</h3>
                            <p class="text-sm text-slate-500 mt-1 leading-relaxed">{{ $service->description }}</p>
                            <div class="flex flex-wrap items-center gap-2.5 mt-3">
                                @if($service->starting_price)
                                    <span class="text-xs font-bold px-3 py-1.5 rounded-full" style="background: var(--brand-accent); color: var(--brand-secondary)">
                                        Mulai Rp{{ number_format($service->starting_price, 0, ',', '.') }}
                                    </span>
                                @endif
                                @if($service->packages->count())
                                    <button @click="expanded = !expanded" class="text-xs font-semibold inline-flex items-center gap-1 hover:underline" style="color: var(--brand-primary)">
                                        <span x-text="expanded ? 'Sembunyikan Paket' : 'Lihat {{ $service->packages->count() }} Paket Harga'"></span>
                                        <svg class="w-3.5 h-3.5 transition-transform" :class="expanded ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6" /></svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <a href="{{ $settings->waLink($service->title, $service->whatsapp_message_template) }}" target="_blank"
                       class="svc-btn btn-press shrink-0 self-start md:self-center">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" /></svg>
                        Chat Sekarang
                    </a>
                </div>

                @if($service->packages->count())
                    <div x-show="expanded"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-cloak
                         class="border-t border-slate-100 p-5 md:p-6" style="background: color-mix(in srgb, var(--brand-primary) 5%, white)">
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($service->packages as $package)
                                <div class="relative rounded-xl p-5 bg-white border border-slate-200"
                                     @if($package->is_popular) style="outline: 3px solid var(--brand-accent)" @endif>
                                    @if($package->is_popular)
                                        <span class="absolute -top-3 left-5 text-xs font-bold px-2.5 py-1 rounded-full" style="background: var(--brand-accent); color: var(--brand-secondary)">Populer</span>
                                    @endif
                                    <h4 class="font-bold" style="color: var(--brand-secondary)">{{ $package->name }}</h4>
                                    <p class="text-xl font-extrabold mt-2" style="color: var(--brand-primary)">Rp{{ number_format($package->price, 0, ',', '.') }}</p>
                                    @if($package->delivery_days)
                                        <p class="text-xs text-slate-400 mt-1">Estimasi {{ $package->delivery_days }} hari</p>
                                    @endif
                                    @if($package->features)
                                        <ul class="mt-4 space-y-2">
                                            @foreach($package->features as $feature)
                                                <li class="flex items-start gap-2 text-sm text-slate-600">
                                                    <svg class="w-4 h-4 mt-0.5 shrink-0" style="color: var(--brand-primary)" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5" /></svg>
                                                    {{ is_array($feature) ? ($feature['feature'] ?? '') : $feature }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <a href="{{ $settings->waLink($service->title . ' - ' . $package->name, $service->whatsapp_message_template) }}" target="_blank"
                                       class="btn-press mt-5 block text-center text-sm font-bold py-2.5 rounded-full border-2 transition-colors hover:bg-slate-50"
                                       style="border-color: var(--brand-primary); color: var(--brand-primary)">
                                        Pilih Paket Ini
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-slate-400 text-center py-10">Belum ada sub-layanan di kategori ini.</p>
        @endforelse
    </div>
</section>

@include('partials.footer')

@endsection
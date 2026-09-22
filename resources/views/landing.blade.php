@extends('layouts.app')

@section('content')

@php
    $headlineHtml = preg_replace(
        '/\*\*(.*?)\*\*/',
        '<span style="color: var(--brand-accent)">$1</span>',
        e($settings->hero_headline)
    );

    $avgRating = $testimonials->count() ? round($testimonials->avg('rating'), 1) : 5.0;

    $categoryIcons = [
        'website' => 'M12 21a9 9 0 100-18 9 9 0 000 18zM3.6 9h16.8M3.6 15h16.8M12 3c2.5 2.8 3.8 6 3.8 9s-1.3 6.2-3.8 9c-2.5-2.8-3.8-6-3.8-9s1.3-6.2 3.8-9z',
        'tugas-kuliah' => 'M22 9L12 4 2 9l10 5 10-5zM6 11.5V17c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5M22 9v6',
        'presentasi-ppt' => 'M3 5h18v12H3zM3 19h18M9 9l3 2-3 2V9z',
        'desain-grafis' => 'M12 19l7-7 3 3-7 7-3-3zM18 13l-1.5-7.5L11 4l1 6.5L18 13zM3 21c1-1.5 2-2 4-2s3 .5 4 2',
    ];
    $defaultIcon = 'M9 12l2 2 4-4m5.5 2a9.5 9.5 0 11-19 0 9.5 9.5 0 0119 0z';

    $whyUsPoints = [
        ['icon' => 'M12 22a10 10 0 100-20 10 10 0 000 20zM12 6v6l4 2', 'title' => 'Cepat & Tepat Waktu', 'desc' => 'Sesuai deadline yang disepakati.'],
        ['icon' => 'M12 22a10 10 0 100-20 10 10 0 000 20zM12 16a4 4 0 100-8 4 4 0 000 8zM12 12h.01', 'title' => 'Sesuai Kebutuhan', 'desc' => 'Konsultasi dulu sebelum dikerjakan.'],
        ['icon' => 'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75', 'title' => 'Support Responsif', 'desc' => 'Chat cepat dibalas via WhatsApp.'],
    ];
@endphp

@include('partials.navbar')

{{-- ============ HERO (berwarna: zona utama) ============ --}}
<div class="relative overflow-hidden" style="background: var(--brand-secondary)">
    <div class="absolute right-10 top-10 w-48 h-48 rounded-full anim-float" style="background: color-mix(in srgb, var(--brand-accent) 16%, transparent)"></div>
    <div class="absolute left-0 bottom-0 w-64 h-64 rounded-full translate-y-1/3 -translate-x-1/4" style="background: color-mix(in srgb, var(--brand-primary) 35%, transparent)"></div>

    {{-- ============ HERO ============ --}}
    <section class="relative">
        <div class="max-w-6xl mx-auto px-5 pt-14 pb-10 md:pt-20 md:pb-14 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <span class="anim-fade-up inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full mb-6 bg-white/10 backdrop-blur"
                      style="color: var(--brand-accent)">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1L12 2z"/></svg>
                    <span data-counter-target="{{ $settings->about_total_clients }}" data-counter-suffix="+ Klien Puas">0+ Klien Puas</span>
                </span>

                <h1 class="anim-fade-up text-4xl md:text-5xl font-extrabold leading-tight tracking-tight text-white" style="animation-delay: 0.12s">
                    {!! $headlineHtml !!}
                </h1>

                <p class="anim-fade-up mt-5 text-white/75 text-lg leading-relaxed max-w-md" style="animation-delay: 0.24s">
                    {{ $settings->hero_subheadline }}
                </p>

                <div class="anim-fade-up mt-8 flex flex-wrap gap-3" style="animation-delay: 0.36s">
                    <a href="{{ $settings->waLink() }}" target="_blank"
                       class="anim-pulse btn-press inline-flex items-center gap-2 font-bold px-7 py-3.5 rounded-full transition-transform hover:scale-105"
                       style="background: var(--brand-accent); color: var(--brand-secondary)">
                        {{ $settings->hero_cta_text }}
                    </a>
                    <a href="#layanan" class="btn-press inline-flex items-center gap-2 border-2 border-white/40 text-white font-bold px-7 py-3.5 rounded-full hover:bg-white/10 backdrop-blur transition-all hover:scale-105">
                        Lihat Layanan
                    </a>
                </div>

                @if($categories->count())
                    <div class="anim-fade-up mt-6 flex items-center gap-2 text-sm font-semibold text-white/60" style="animation-delay: 0.45s"
                         x-data='{
                            words: @json($categories->pluck("name")),
                            wordIndex: 0, display: "", deleting: false,
                            tick() {
                                const current = this.words[this.wordIndex] ?? "";
                                if (!this.deleting) {
                                    this.display = current.slice(0, this.display.length + 1);
                                    if (this.display === current) { setTimeout(() => { this.deleting = true; this.tick(); }, 1400); return; }
                                } else {
                                    this.display = current.slice(0, this.display.length - 1);
                                    if (this.display === "") {
                                        this.deleting = false;
                                        this.wordIndex = (this.wordIndex + 1) % this.words.length;
                                        setTimeout(() => this.tick(), 300);
                                        return;
                                    }
                                }
                                setTimeout(() => this.tick(), this.deleting ? 45 : 85);
                            }
                         }'
                         x-init="$nextTick(() => tick())">
                        <span>Spesialis:</span>
                        <span class="font-bold" style="color: var(--brand-accent)" x-text="display"></span><span class="opacity-50 animate-pulse" style="color: var(--brand-accent)">|</span>
                    </div>
                @endif
            </div>

            {{-- Ilustrasi kartu (SVG custom, bukan foto stok) --}}
            <div class="reveal-right relative">
                <div class="card-shadow rounded-3xl bg-white p-6 md:p-8 relative overflow-hidden">
                    <svg viewBox="0 0 480 380" class="w-full h-auto">
                        <rect x="0" y="0" width="480" height="380" rx="20" fill="color-mix(in srgb, var(--brand-primary) 6%, white)"/>
                        <circle cx="405" cy="55" r="50" fill="color-mix(in srgb, var(--brand-accent) 20%, white)"/>
                        <circle cx="40" cy="330" r="32" fill="color-mix(in srgb, var(--brand-primary) 12%, white)"/>

                        {{-- Jendela browser: mewakili layanan Website --}}
                        <defs>
                            <clipPath id="browserClip">
                                <rect x="65" y="55" width="270" height="190" rx="14"/>
                            </clipPath>
                        </defs>
                        <g clip-path="url(#browserClip)">
                            <rect x="65" y="55" width="270" height="190" fill="white" stroke="#E2E8F0" stroke-width="2"/>
                            <rect x="65" y="55" width="270" height="26" fill="#F1F5F9"/>
                            <circle cx="80" cy="68" r="3.5" fill="#F87171"/>
                            <circle cx="92" cy="68" r="3.5" fill="#FBBF24"/>
                            <circle cx="104" cy="68" r="3.5" fill="#34D399"/>
                            <rect x="120" y="61" width="160" height="14" rx="7" fill="white" stroke="#E2E8F0"/>

                            <rect x="82" y="98" width="130" height="13" rx="6.5" fill="var(--brand-secondary)"/>
                            <rect x="82" y="120" width="200" height="7" rx="3.5" fill="#E2E8F0"/>
                            <rect x="82" y="134" width="170" height="7" rx="3.5" fill="#E2E8F0"/>
                            <rect x="82" y="158" width="72" height="26" rx="8" fill="var(--brand-primary)"/>
                            <rect x="164" y="158" width="72" height="26" rx="8" fill="color-mix(in srgb, var(--brand-accent) 30%, white)"/>

                            <rect x="65" y="205" width="270" height="40" fill="color-mix(in srgb, var(--brand-primary) 5%, white)"/>
                            <circle cx="90" cy="225" r="11" fill="var(--brand-primary)"/>
                            <rect x="110" y="218" width="130" height="7" rx="3.5" fill="#CBD5E1"/>
                            <rect x="110" y="230" width="90" height="7" rx="3.5" fill="#E2E8F0"/>
                        </g>

                        {{-- Kartu slide navy: mewakili layanan Presentasi/PPT --}}
                        <g transform="translate(260,205)">
                            <rect width="155" height="125" rx="14" fill="var(--brand-secondary)"/>
                            <rect x="16" y="16" width="110" height="9" rx="4.5" fill="white" opacity="0.9"/>
                            <rect x="16" y="34" width="75" height="6" rx="3" fill="white" opacity="0.5"/>
                            <rect x="16" y="58" width="14" height="48" rx="2" fill="var(--brand-accent)"/>
                            <rect x="36" y="74" width="14" height="32" rx="2" fill="white" opacity="0.55"/>
                            <rect x="56" y="48" width="14" height="58" rx="2" fill="var(--brand-accent)"/>
                            <rect x="76" y="66" width="14" height="40" rx="2" fill="white" opacity="0.55"/>
                            <circle cx="121" cy="108" r="3" fill="white" opacity="0.4"/>
                            <circle cx="132" cy="108" r="3" fill="white" opacity="0.9"/>
                            <circle cx="143" cy="108" r="3" fill="white" opacity="0.4"/>
                        </g>

                        {{-- Badge dokumen: mewakili layanan Tugas Kuliah --}}
                        <g transform="translate(40,225)">
                            <rect width="130" height="112" rx="14" fill="white" stroke="#E2E8F0" stroke-width="2"/>
                            <path d="M22 20 H80 L96 36 V92 H22 Z" fill="color-mix(in srgb, var(--brand-primary) 10%, white)"/>
                            <path d="M80 20 V36 H96 Z" fill="color-mix(in srgb, var(--brand-primary) 22%, white)"/>
                            <rect x="32" y="46" width="50" height="5" rx="2.5" fill="var(--brand-primary)"/>
                            <rect x="32" y="58" width="50" height="5" rx="2.5" fill="#CBD5E1"/>
                            <rect x="32" y="70" width="34" height="5" rx="2.5" fill="#CBD5E1"/>
                            <circle cx="105" cy="90" r="17" fill="var(--brand-accent)"/>
                            <path d="M97 90l5 5 9-10" stroke="var(--brand-secondary)" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>

                        {{-- Bubble chat kecil: aksen konsultasi --}}
                        <g transform="translate(30,12)">
                            <rect width="72" height="40" rx="12" fill="var(--brand-primary)"/>
                            <path d="M18 40 L18 50 L30 40 Z" fill="var(--brand-primary)"/>
                            <circle cx="22" cy="20" r="4" fill="white" opacity="0.9"/>
                            <circle cx="36" cy="20" r="4" fill="white" opacity="0.6"/>
                            <circle cx="50" cy="20" r="4" fill="white" opacity="0.35"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ STATS (masih di zona berwarna, nyambung sama Hero) ============ --}}
    <section class="relative">
        <div class="max-w-6xl mx-auto px-5 pb-14 md:pb-20">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="reveal text-center py-6 px-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur">
                    <p class="text-3xl font-extrabold" style="color: var(--brand-accent)"><span data-counter-target="{{ $settings->about_total_projects }}" data-counter-suffix="+">0+</span></p>
                    <p class="text-sm text-white/60 mt-1">Project Selesai</p>
                </div>
                <div class="reveal text-center py-6 px-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur" style="transition-delay: 80ms">
                    <p class="text-3xl font-extrabold" style="color: var(--brand-accent)"><span data-counter-target="{{ $settings->about_total_clients }}" data-counter-suffix="+">0+</span></p>
                    <p class="text-sm text-white/60 mt-1">Klien Puas</p>
                </div>
                <div class="reveal text-center py-6 px-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur" style="transition-delay: 160ms">
                    <p class="text-3xl font-extrabold" style="color: var(--brand-accent)">{{ $avgRating }}/5</p>
                    <p class="text-sm text-white/60 mt-1">Rating Rata-rata</p>
                </div>
                <div class="reveal text-center py-6 px-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur" style="transition-delay: 240ms">
                    <p class="text-3xl font-extrabold" style="color: var(--brand-accent)">{{ $settings->about_years_experience }} Thn</p>
                    <p class="text-sm text-white/60 mt-1">Pengalaman</p>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- ============ LAYANAN (putih) ============ --}}
<section id="layanan" class="max-w-6xl mx-auto px-5 py-16">
    <div class="reveal text-center max-w-xl mx-auto mb-10">
        <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">Layanan Kami</span>
        <h2 class="text-3xl md:text-4xl font-extrabold mt-3" style="color: var(--brand-secondary)">Pilih kategori layanan</h2>
        <p class="text-slate-500 mt-2">Klik salah satu kategori untuk lihat detail sub-layanannya.</p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse($categories as $i => $cat)
            @php $iconPath = $categoryIcons[$cat->slug] ?? $defaultIcon; @endphp
            <a href="{{ route('category.show', $cat->slug) }}"
               class="reveal-scale group card-shadow hover-lift rounded-2xl p-6 bg-white transition-all block"
               style="transition-delay: {{ $i * 90 }}ms">
                <div class="icon-pop w-12 h-12 rounded-xl flex items-center justify-center mb-5" style="background: var(--brand-secondary)">
                    <svg class="w-6 h-6" style="color: var(--brand-accent)" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $iconPath }}" /></svg>
                </div>
                <h3 class="font-bold text-base" style="color: var(--brand-secondary)">{{ $cat->name }}</h3>
                <p class="text-sm text-slate-400 mt-2">{{ $cat->activeServices->count() }} sub-layanan tersedia</p>
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-sm font-bold group-hover:underline" style="color: var(--brand-primary)">Lihat Detail</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" style="color: var(--brand-primary)" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                </div>
            </a>
        @empty
            <p class="text-slate-400 col-span-full">Belum ada kategori layanan. Tambahkan lewat admin panel.</p>
        @endforelse
    </div>
</section>

{{-- Feature chip row (dipindah ke sini, putih, nemenin section Layanan) --}}
<section class="max-w-6xl mx-auto px-5 pb-4">
    <div class="grid sm:grid-cols-3 gap-4">
        @foreach($whyUsPoints as $i => $p)
            <div class="reveal card-shadow bg-white rounded-2xl p-5 flex items-center gap-4" style="transition-delay: {{ $i * 90 }}ms">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0" style="background: color-mix(in srgb, var(--brand-primary) 10%, white)">
                    <svg class="w-5 h-5" style="color: var(--brand-primary)" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $p['icon'] }}" /></svg>
                </div>
                <div>
                    <p class="font-bold text-sm" style="color: var(--brand-secondary)">{{ $p['title'] }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $p['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ ABOUT / WHY US (putih) ============ --}}
<section class="max-w-6xl mx-auto px-5 py-16">
    <div class="card-shadow bg-white rounded-3xl overflow-hidden grid md:grid-cols-2 gap-0 items-stretch">
        <div class="reveal-left relative min-h-[260px]" style="background: color-mix(in srgb, var(--brand-primary) 6%, white)">
            @if($settings->about_photo)
                <img src="{{ asset('storage/' . $settings->about_photo) }}" class="absolute inset-0 w-full h-full object-cover" alt="">
            @else
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-28 h-28 rounded-2xl flex items-center justify-center" style="background: var(--brand-secondary)">
                        <span class="text-3xl font-extrabold" style="color: var(--brand-accent)">{{ $settings->about_years_experience }}+</span>
                    </div>
                </div>
            @endif
        </div>
        <div class="reveal-right p-8 md:p-10 flex flex-col justify-center">
            <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">Kenapa Pilih Kami</span>
            <h2 class="text-3xl md:text-4xl font-extrabold mt-3 mb-6" style="color: var(--brand-secondary)">{{ $settings->about_title }}</h2>
            <p class="text-slate-500 leading-relaxed">{{ $settings->about_description }}</p>
        </div>
    </div>
</section>

{{-- ============ PORTFOLIO (putih) ============ --}}
<section id="portfolio" class="max-w-6xl mx-auto px-5 py-16">
    <div class="reveal text-center max-w-xl mx-auto mb-10">
        <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">Portfolio</span>
        <h2 class="text-3xl md:text-4xl font-extrabold mt-3" style="color: var(--brand-secondary)">Hasil kerja terbaru kami</h2>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($portfolios as $i => $portfolio)
            <div class="reveal-scale hover-lift card-shadow rounded-2xl overflow-hidden bg-white group" style="transition-delay: {{ $i * 80 }}ms">
                <div class="aspect-[4/3] relative overflow-hidden" style="background: color-mix(in srgb, var(--brand-primary) 8%, white)">
                    @if($portfolio->thumbnail)
                        <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $portfolio->title }}">
                    @endif
                </div>
                <div class="p-4">
                    <span class="text-xs font-bold" style="color: var(--brand-primary)">{{ $portfolio->service->title ?? 'Umum' }}</span>
                    <h4 class="font-bold mt-1" style="color: var(--brand-secondary)">{{ $portfolio->title }}</h4>
                </div>
            </div>
        @empty
            <p class="text-slate-400 col-span-full">Belum ada portfolio ditambahkan.</p>
        @endforelse
    </div>
</section>

{{-- ============ TESTIMONIALS (putih) ============ --}}
<section id="testimoni" class="max-w-6xl mx-auto px-5 py-16">
    <div class="reveal text-center max-w-xl mx-auto mb-10">
        <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">Testimoni</span>
        <h2 class="text-3xl md:text-4xl font-extrabold mt-3" style="color: var(--brand-secondary)">Apa kata mereka</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-5">
        @forelse($testimonials as $i => $t)
            <div class="{{ $i % 2 === 0 ? 'reveal-left' : 'reveal-right' }} hover-lift card-shadow bg-white rounded-2xl p-6">
                <div class="flex gap-1 mb-4">
                    @for($s = 0; $s < 5; $s++)
                        <svg class="w-4 h-4" style="color: var(--brand-accent)" fill="{{ $s < $t->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1L12 2z"/></svg>
                    @endfor
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">"{{ $t->message }}"</p>
                <div class="mt-5 pt-5 border-t border-slate-100 flex items-center gap-3">
                    @if($t->photo)
                        <img src="{{ asset('storage/' . $t->photo) }}" class="w-9 h-9 rounded-full object-cover" alt="{{ $t->name }}">
                    @else
                        <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-xs text-white" style="background: var(--brand-primary)">{{ substr($t->name, 0, 1) }}</div>
                    @endif
                    <div>
                        <p class="font-bold text-sm" style="color: var(--brand-secondary)">{{ $t->name }}</p>
                        <p class="text-xs text-slate-400">{{ $t->role }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-slate-400 col-span-full">Belum ada testimoni.</p>
        @endforelse
    </div>
</section>

{{-- ============ FAQ (putih) ============ --}}
<section id="faq" class="max-w-4xl mx-auto px-5 py-16">
    <div class="reveal text-center max-w-xl mx-auto mb-10">
        <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">FAQ</span>
        <h2 class="text-3xl md:text-4xl font-extrabold mt-3" style="color: var(--brand-secondary)">Pertanyaan Umum</h2>
    </div>
    <div class="space-y-3" x-data="{ open: 0 }">
        @foreach($faqs as $i => $faq)
            <div class="reveal card-shadow bg-white rounded-2xl overflow-hidden" style="transition-delay: {{ $i * 70 }}ms">
                <button @click="open = (open === {{ $i }} ? -1 : {{ $i }})" class="w-full flex items-center justify-between gap-4 px-5 py-4 text-left">
                    <span class="font-semibold" style="color: var(--brand-secondary)">{{ $faq->question }}</span>
                    <svg class="w-4 h-4 shrink-0 transition-transform duration-300" style="color: var(--brand-primary)" :class="open === {{ $i }} ? 'rotate-45' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14" /></svg>
                </button>
                <div x-show="open === {{ $i }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                    <div class="px-5 pb-4 text-sm text-slate-500 leading-relaxed">{{ $faq->answer }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ CTA (berwarna: zona penutup) ============ --}}
<section class="max-w-6xl mx-auto px-5 pb-16">
    <div class="reveal-scale card-shadow rounded-3xl overflow-hidden px-8 py-14 md:py-16 text-center relative"
         style="background: var(--brand-secondary)">
        <div class="absolute right-0 top-0 w-56 h-56 rounded-full -translate-y-1/3 translate-x-1/4 anim-float" style="background: color-mix(in srgb, var(--brand-accent) 15%, transparent)"></div>
        <div class="relative">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Siap mulai project kamu?</h2>
            <p class="text-white/75 mt-3 max-w-md mx-auto">Chat sekarang, konsultasikan kebutuhan kamu gratis sebelum deal.</p>
            <a href="{{ $settings->waLink() }}" target="_blank"
               class="anim-pulse btn-press mt-7 inline-flex items-center gap-2 font-bold px-8 py-3.5 rounded-full transition-transform hover:scale-105"
               style="background: var(--brand-accent); color: var(--brand-secondary)">
                Chat via WhatsApp
            </a>
        </div>
    </div>
</section>

@include('partials.footer')

@endsection
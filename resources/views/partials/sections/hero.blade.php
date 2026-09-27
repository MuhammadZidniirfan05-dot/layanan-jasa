{{-- ============ HERO (background slideshow) ============ --}}
@php
    $heroImages = collect($settings->hero_background_images ?? [])
        ->filter()
        ->map(fn ($path) => asset('storage/' . $path))
        ->values()
        ->all();
@endphp

<div class="relative overflow-hidden flex flex-col justify-center min-h-[480px] md:min-h-[600px] lg:min-h-[calc(100svh-80px)]"
     style="background: var(--brand-secondary)">

    {{-- Layer gambar background --}}
    @forelse($heroImages as $i => $img)
        <div class="hero-slide {{ $i === 0 ? 'active' : '' }}"
             style="background-image: url('{{ $img }}');"></div>
    @empty
    @endforelse

    {{-- Overlay --}}
    <div class="absolute inset-0 z-[1] pointer-events-none"
         style="background: linear-gradient(135deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.35) 50%, rgba(0,0,0,0.25) 100%);"></div>

    {{-- ============ HERO CONTENT ============ --}}
    <section class="relative z-10 w-full">
        {{-- Padding vertikal: mobile kecil (py-8), tablet sedang (md:py-12), desktop besar (lg:py-16) --}}
        <div class="max-w-6xl mx-auto px-5 py-8 md:py-12 lg:py-16">
            
            {{-- KONTEN TENGAH: Mobile & Tablet center, Desktop kiri --}}
            {{-- Menggunakan lg: untuk breakpoint desktop agar tablet tetap center --}}
            <div class="max-w-2xl mx-auto text-center lg:mx-0 lg:text-left">
                
                {{-- Badge --}}
                <span class="anim-fade-up inline-flex items-center gap-1.5 text-[10px] md:text-xs font-bold uppercase tracking-wider px-2.5 py-1 md:px-3 md:py-1.5 rounded-full mb-4 md:mb-5 backdrop-blur mx-auto lg:mx-0"
                      style="background: color-mix(in srgb, var(--brand-primary) 20%, transparent); color: var(--brand-accent)">
                    <svg class="w-3 h-3 md:w-3.5 md:h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1L12 2z"/></svg>
                    <span data-counter-target="{{ $settings->about_total_clients }}" data-counter-suffix="+ Klien Puas">0+ Klien Puas</span>
                </span>

                {{-- Judul --}}
                {{-- Mobile: text-2xl (24px), Tablet: md:text-3xl (30px), Desktop: lg:text-5xl (48px) --}}
                <h1 class="anim-fade-up text-2xl md:text-3xl lg:text-5xl font-extrabold leading-tight tracking-tight text-white" style="animation-delay: 0.12s">
                    {!! $headlineHtml !!}
                </h1>

                {{-- Subjudul --}}
                {{-- Mobile: text-sm, Tablet: md:text-base, Desktop: lg:text-lg --}}
                <p class="anim-fade-up mt-3 md:mt-4 lg:mt-5 text-sm md:text-base lg:text-lg text-white/75 leading-relaxed max-w-md mx-auto lg:mx-0" style="animation-delay: 0.24s">
                    {{ $settings->hero_subheadline }}
                </p>
{{-- Tombol Aksi --}}
<div class="anim-fade-up mt-5 md:mt-6 lg:mt-8 flex flex-row flex-wrap justify-center lg:justify-start gap-2 md:gap-3" style="animation-delay: 0.36s">
    
    {{-- Tombol Utama (WhatsApp) --}}
    {{-- PERUBAHAN: Hapus flex-1, kurangi px jadi px-3 di HP agar tidak terlalu lebar --}}
    <a href="{{ $settings->waLink() }}" target="_blank"
       class="anim-pulse btn-press inline-flex items-center justify-center gap-1.5 font-bold text-[11px] md:text-sm lg:text-base px-3 py-1.5 md:px-5 md:py-2.5 lg:px-7 lg:py-3.5 rounded-full transition-transform hover:scale-105 whitespace-nowrap leading-none"
       style="background: var(--brand-accent); color: var(--brand-secondary)">
        {{ $settings->hero_cta_text }}
    </a>
    
    {{-- Tombol Sekunder (Lihat Layanan) --}}
    <a href="#layanan" class="btn-press inline-flex items-center justify-center gap-1.5 border-2 border-white/60 text-white font-bold text-[11px] md:text-sm lg:text-base px-3 py-1.5 md:px-5 md:py-2.5 lg:px-7 lg:py-3.5 rounded-full bg-white/10 backdrop-blur transition-all hover:bg-white/20 hover:scale-105 whitespace-nowrap leading-none">
        Lihat Layanan
    </a>
</div>
                @if($categories->count())
                    {{-- Teks Spesialis --}}
                    {{-- Mobile: text-xs, Tablet: md:text-sm --}}
                    <div class="anim-fade-up mt-4 md:mt-5 lg:mt-6 flex items-center justify-center lg:justify-start gap-1.5 text-xs md:text-sm font-semibold text-white/60" style="animation-delay: 0.45s"
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
        </div>
    </section>

    {{-- Indikator Dots Slideshow --}}
    @if(count($heroImages) > 1)
        <div class="relative z-10 flex justify-center gap-1.5 pb-4 md:pb-6 -mt-2 md:-mt-4" id="hero-dots" data-total="{{ count($heroImages) }}">
            @foreach($heroImages as $i => $img)
                <button type="button"
                        data-dot-index="{{ $i }}"
                        class="hero-dot h-1 md:h-1.5 rounded-full transition-all duration-300 {{ $i === 0 ? 'w-6 md:w-8' : 'w-1.5 md:w-2' }}"
                        style="background: {{ $i === 0 ? 'var(--brand-accent)' : 'rgba(255,255,255,0.4)' }}"
                        aria-label="Gambar {{ $i + 1 }}"></button>
            @endforeach
        </div>
    @endif

</div>
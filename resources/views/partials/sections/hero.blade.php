{{-- ============ HERO (background slideshow) ============ --}}
@php
    $heroImages = collect($settings->hero_background_images ?? [])
        ->filter()
        ->map(fn ($path) => asset('storage/' . $path))
        ->values()
        ->all();
@endphp

<div class="relative overflow-hidden flex flex-col justify-center min-h-[calc(100svh-80px)]"
     style="background: var(--brand-secondary)">

    {{-- Layer gambar background: satu div per gambar --}}
    @forelse($heroImages as $i => $img)
        <div class="hero-slide {{ $i === 0 ? 'active' : '' }}"
             style="background-image: url('{{ $img }}');"></div>
    @empty
        {{-- Fallback: kalau admin belum upload gambar, tetap warna solid --}}
    @endforelse

    {{-- Overlay netral gelap biar teks tetap kebaca (tanpa warna brand) --}}
    <div class="absolute inset-0 z-[1] pointer-events-none"
         style="background: linear-gradient(135deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.35) 50%, rgba(0,0,0,0.25) 100%);"></div>

    {{-- ============ HERO CONTENT ============ --}}
    <section class="relative z-10">
        <div class="max-w-6xl mx-auto px-5 py-10 md:py-14">
            <div class="max-w-2xl">
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
        </div>
    </section>

    {{-- Indikator Dots Slideshow --}}
    @if(count($heroImages) > 1)
        <div class="relative z-10 flex justify-center gap-2 pb-6 -mt-4" id="hero-dots" data-total="{{ count($heroImages) }}">
            @foreach($heroImages as $i => $img)
                <button type="button"
                        data-dot-index="{{ $i }}"
                        class="hero-dot h-1.5 rounded-full transition-all duration-300 {{ $i === 0 ? 'w-8 bg-white' : 'w-2 bg-white/40' }}"
                        aria-label="Gambar {{ $i + 1 }}"></button>
            @endforeach
        </div>
    @endif

</div>
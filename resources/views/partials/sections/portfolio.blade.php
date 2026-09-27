<section id="portfolio" class="max-w-6xl mx-auto px-4 md:px-5 py-16">
    <!-- Heading: text-center -->
    <div class="reveal text-center max-w-xl mx-auto mb-8 md:mb-10">
        <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">Portfolio</span>
        <h2 class="text-2xl md:text-4xl font-extrabold mt-2 md:mt-3" style="color: var(--brand-secondary)">Hasil kerja terbaru kami</h2>
    </div>
    
    {{-- PERUBAHAN: Langsung grid-cols-2 di HP, lg:grid-cols-3 di Desktop --}}
    {{-- Gap diperkecil di HP (gap-3), membesar di Desktop (lg:gap-5) --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4 lg:gap-5">
        @forelse($portfolios as $i => $portfolio)
            <div class="reveal-scale hover-lift card-shadow rounded-xl md:rounded-2xl overflow-hidden bg-white group" style="transition-delay: {{ $i * 80 }}ms">
                
                {{-- Gambar: aspect ratio tetap 4/3 --}}
                <div class="aspect-[4/3] relative overflow-hidden" style="background: color-mix(in srgb, var(--brand-primary) 8%, white)">
                    @if($portfolio->thumbnail)
                        <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $portfolio->title }}">
                    @endif
                </div>
                
                {{-- Teks kartu: padding & font diperkecil di HP --}}
                <div class="p-2.5 md:p-4 text-center">
                    <span class="text-[9px] md:text-xs font-bold leading-tight block" style="color: var(--brand-primary)">{{ $portfolio->service->title ?? 'Umum' }}</span>
                    <h4 class="font-bold text-[11px] md:text-base mt-0.5 md:mt-1 leading-tight" style="color: var(--brand-secondary)">{{ $portfolio->title }}</h4>
                </div>
            </div>
        @empty
            <p class="text-slate-400 col-span-2 lg:col-span-3 text-center">Belum ada portfolio ditambahkan.</p>
        @endforelse
    </div>
</section>
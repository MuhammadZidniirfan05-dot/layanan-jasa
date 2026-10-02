<section id="portfolio" class="max-w-6xl mx-auto px-4 md:px-5 pt-16 pb-8 md:pb-10">
    <!-- Heading: text-center -->
    <div class="reveal text-center max-w-xl mx-auto mb-8 md:mb-10">
        <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">Portfolio</span>
        <h2 class="text-2xl md:text-4xl font-extrabold mt-2 md:mt-3" style="color: var(--brand-secondary)">Hasil kerja terbaru kami</h2>
    </div>
    
    {{-- Grid: 2 kolom di HP, 3 kolom di Desktop --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4 lg:gap-5">
        @forelse($portfolios as $i => $portfolio)
            <div class="reveal-scale hover-lift card-shadow rounded-xl md:rounded-2xl overflow-hidden bg-white group" style="transition-delay: {{ $i * 80 }}ms">
                
                {{-- Gambar: aspect-video (16:9), object-cover, object-top --}}
                <div class="aspect-video relative overflow-hidden" style="background: #f1f5f9">
                    @if($portfolio->thumbnail)
                        <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" 
                             class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105" 
                             alt="{{ $portfolio->title }}">
                    @endif
                </div>
                
                {{-- Teks kartu --}}
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
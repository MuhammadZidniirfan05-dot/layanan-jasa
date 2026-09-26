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
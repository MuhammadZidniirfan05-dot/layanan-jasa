<section class="max-w-6xl mx-auto px-4 md:px-5 pb-4">
    {{-- PERUBAHAN: Langsung grid-cols-3 di semua ukuran, gap kecil di HP --}}
    <div class="grid grid-cols-3 sm:grid-cols-3 gap-2 md:gap-4">
        @foreach($whyUsPoints as $i => $p)
            <div class="reveal card-shadow rounded-xl md:rounded-2xl px-2 py-4 md:px-5 md:py-7 flex flex-col items-center text-center gap-2 md:gap-4 relative overflow-hidden"
                 style="background: var(--brand-secondary); transition-delay: {{ $i * 90 }}ms">

                {{-- Ikon: mengecil di HP --}}
                <div class="relative w-8 h-8 md:w-12 md:h-12 rounded-lg md:rounded-xl flex items-center justify-center shrink-0"
                     style="background: var(--brand-accent)">
                    <svg class="w-4 h-4 md:w-6 md:h-6" style="color: var(--brand-secondary)" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $p['icon'] }}" /></svg>
                </div>
                
                <div class="relative">
                    {{-- Judul: mengecil di HP --}}
                    <p class="font-bold text-[10px] md:text-base text-white leading-tight">{{ $p['title'] }}</p>
                    
                    {{-- Deskripsi: HILANG di HP, MUNCUL di Desktop (md:block) --}}
                    <p class="hidden md:block text-sm text-white/75 mt-1">{{ $p['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
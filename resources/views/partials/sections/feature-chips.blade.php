<section class="max-w-6xl mx-auto px-5 pb-4">
    <div class="grid sm:grid-cols-3 gap-4">
        @foreach($whyUsPoints as $i => $p)
            <div class="reveal card-shadow rounded-2xl px-5 py-7 flex flex-col items-center text-center gap-4 relative overflow-hidden"
                 style="background: var(--brand-secondary); transition-delay: {{ $i * 90 }}ms">
                <div class="absolute right-0 top-0 w-24 h-24 rounded-full -translate-y-1/3 translate-x-1/4"
                     style="background: color-mix(in srgb, var(--brand-accent) 15%, transparent)"></div>

                <div class="relative w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                     style="background: var(--brand-accent)">
                    <svg class="w-6 h-6" style="color: var(--brand-secondary)" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $p['icon'] }}" /></svg>
                </div>
                <div class="relative">
                    <p class="font-bold text-base text-white">{{ $p['title'] }}</p>
                    <p class="text-sm text-white/75 mt-1">{{ $p['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
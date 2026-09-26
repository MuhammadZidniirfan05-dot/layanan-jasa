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
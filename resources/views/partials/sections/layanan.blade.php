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
    .svc-btn svg { transition: transform .3s ease; }
    .svc-row:hover .svc-btn,
    .svc-row:active .svc-btn,
    .svc-row:focus-visible .svc-btn { background: var(--brand-accent); color: var(--brand-secondary); }
    .svc-row:hover .svc-btn svg { transform: translateX(3px); }
</style>

<section id="layanan" class="max-w-6xl mx-auto px-5 py-16">
    <div class="grid lg:grid-cols-12 gap-10 items-start">

        {{-- ===== KIRI: foto rasio tetap, sticky ===== --}}
        <div class="lg:col-span-5 flex flex-col gap-4 lg:sticky lg:top-24">
            <div class="reveal-left card-shadow rounded-2xl bg-white p-2 relative overflow-hidden aspect-[4/3]">
                <img src="{{ asset('images/layanan-photo.jpg') }}" alt="Tim mengerjakan project" class="absolute inset-2 w-[calc(100%-1rem)] h-[calc(100%-1rem)] object-cover rounded-xl">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="reveal-left rounded-2xl overflow-hidden relative aspect-[4/3]" style="transition-delay: 100ms">
                    <img src="{{ asset('images/layanan-photo-2.jpg') }}" alt="Programmer at work" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-4">
                        <p class="text-xs font-bold text-white">Pengembangan Website</p>
                    </div>
                </div>

                <div class="reveal-left rounded-2xl overflow-hidden relative aspect-[4/3]" style="transition-delay: 180ms">
                    <img src="{{ asset('images/layanan-photo-3.jpg') }}" alt="Designer at work" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-4">
                        <p class="text-xs font-bold text-white">Desain & Presentasi</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== KANAN: heading + kartu kategori ===== --}}
        <div class="lg:col-span-7">
            <div class="reveal">
                <span class="text-xs font-bold uppercase tracking-widest inline-block px-3 py-1 rounded-full mb-4" style="background: color-mix(in srgb, var(--brand-accent) 20%, white); color: var(--brand-secondary)">Layanan Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold" style="color: var(--brand-secondary)">
                    Solusi Lengkap untuk <span style="color: var(--brand-primary)">Kebutuhan Digitalmu</span>
                </h2>
                <p class="text-slate-500 mt-4 leading-relaxed">Dari website sampai tugas kuliah, kami bantu kerjakan dengan rapi dan tepat waktu. Klik salah satu kategori di bawah untuk lihat detail lengkapnya.</p>
            </div>
            <div class="mt-8 space-y-4">
                @forelse($categories as $i => $cat)
                    @php
                        $count = $cat->activeServices->count();
                        $desc = $cat->description ?? ($categoryDescs[$cat->slug] ?? 'Lihat detail layanan dan pilih yang sesuai kebutuhanmu.');
                    @endphp
                    <a href="{{ route('category.show', $cat->slug) }}"
                       class="reveal svc-row group rounded-2xl p-5 md:p-6 flex flex-col sm:flex-row sm:items-center gap-4"
                       style="transition-delay: {{ $i * 90 }}ms">

                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 font-extrabold text-sm"
                             style="background: var(--brand-secondary); color: var(--brand-accent)">
                            {{ sprintf('%02d', $i + 1) }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="font-extrabold text-lg" style="color: var(--brand-secondary)">{{ $cat->name }}</h3>
                            <p class="text-sm text-slate-500 mt-1 leading-relaxed">{{ \Illuminate\Support\Str::limit($desc, 90) }}</p>

                            @if($count)
                                <span class="inline-block mt-2.5 text-xs font-bold px-3 py-1.5 rounded-full" style="background: var(--brand-accent); color: var(--brand-secondary)">
                                    {{ $count }} sub-layanan
                                </span>
                            @else
                                <span class="inline-block mt-2.5 text-xs font-semibold px-3 py-1.5 rounded-full bg-slate-100 text-slate-400">Segera hadir</span>
                            @endif
                        </div>

                        <span class="svc-btn shrink-0 self-start sm:self-center">
                            Selengkapnya
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                        </span>
                    </a>
                @empty
                    <p class="text-slate-400 py-6">Belum ada kategori layanan. Tambahkan lewat admin panel.</p>
                @endforelse
            </div>

            <div class="reveal flex items-center gap-3 mt-6">
                @if($settings->about_photo)
                    <img src="{{ asset('storage/' . $settings->about_photo) }}" class="w-9 h-9 rounded-full object-cover border-2 border-white card-shadow" alt="">
                @else
                    <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-xs text-white" style="background: var(--brand-primary)">{{ substr($settings->site_name, 0, 1) }}</div>
                @endif
            </div>
        </div>
    </div>
</section>
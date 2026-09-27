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

    /* ====== TAMBAHAN UNTUK MOBILE & TABLET (di bawah lg) ====== */
    @media (max-width: 1023px) {
        .svc-btn {
            font-size: 0.6rem;
            padding: 0.35rem 0.6rem;
            gap: 0.2rem;
        }
        .svc-btn svg {
            width: 0.65rem;
            height: 0.65rem;
        }
    }
</style>

<section id="layanan" class="max-w-6xl mx-auto px-4 md:px-5 py-10 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- ===== KIRI: foto rasio tetap, sticky (HANYA MUNCUL DI DESKTOP) ===== --}}
        <div class="hidden lg:flex lg:col-span-5 flex-col gap-3 lg:gap-4 lg:sticky lg:top-24">
            <div class="reveal-left card-shadow rounded-2xl bg-white p-2 relative overflow-hidden aspect-[4/3]">
                <img src="{{ asset('images/layanan-photo.jpg') }}" alt="Tim mengerjakan project" class="absolute inset-2 w-[calc(100%-1rem)] h-[calc(100%-1rem)] object-cover rounded-xl">
            </div>
            <div class="grid grid-cols-2 gap-3 lg:gap-4">
                <div class="reveal-left rounded-2xl overflow-hidden relative aspect-[4/3]" style="transition-delay: 100ms">
                    <img src="{{ asset('images/layanan-photo-2.jpg') }}" alt="Programmer at work" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-2 lg:p-4">
                        <p class="text-[10px] lg:text-xs font-bold text-white">Pengembangan Website</p>
                    </div>
                </div>
                <div class="reveal-left rounded-2xl overflow-hidden relative aspect-[4/3]" style="transition-delay: 180ms">
                    <img src="{{ asset('images/layanan-photo-3.jpg') }}" alt="Designer at work" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-2 lg:p-4">
                        <p class="text-[10px] lg:text-xs font-bold text-white">Desain & Presentasi</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== KANAN: heading + kartu kategori ===== --}}
        <div class="w-full lg:col-span-7">
            
            {{-- PERUBAHAN: Tambahkan text-center untuk HP, lg:text-left untuk Desktop --}}
            <div class="reveal text-center lg:text-left">
                <span class="text-xs font-bold uppercase tracking-widest inline-block px-3 py-1 rounded-full mb-4" style="background: color-mix(in srgb, var(--brand-accent) 20%, white); color: var(--brand-secondary)">Layanan Kami</span>
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold" style="color: var(--brand-secondary)">
                    Solusi Lengkap untuk <span style="color: var(--brand-primary)">Kebutuhan Digitalmu</span>
                </h2>
                <p class="text-slate-500 mt-4 leading-relaxed text-sm md:text-base mx-auto lg:mx-0 max-w-md lg:max-w-none">Dari website sampai tugas kuliah, kami bantu kerjakan dengan rapi dan tepat waktu. Klik salah satu kategori di bawah untuk lihat detail lengkapnya.</p>
            </div>
            
            {{-- Grid Kartu --}}
            <div class="mt-6 lg:mt-8 grid grid-cols-2 lg:grid-cols-1 gap-3 lg:gap-0 lg:space-y-4">
                @forelse($categories as $i => $cat)
                    @php
                        $count = $cat->activeServices->count();
                        $desc = $cat->description ?? ($categoryDescs[$cat->slug] ?? 'Lihat detail layanan dan pilih yang sesuai kebutuhanmu.');
                    @endphp
                    
                    {{-- PERUBAHAN UTAMA PADA KARTU: --}}
                    {{-- Mobile: items-center & text-center (semua konten center) --}}
                    {{-- Desktop: lg:items-center & lg:text-left (kembali seperti asli) --}}
                    <a href="{{ route('category.show', $cat->slug) }}"
                       class="reveal svc-row group rounded-xl lg:rounded-2xl p-3 lg:p-5 xl:p-6 flex flex-col items-center text-center lg:flex-row lg:items-center lg:text-left gap-2 lg:gap-4"
                       style="transition-delay: {{ $i * 90 }}ms">

                        {{-- Baris atas: Nomor + Judul --}}
                        {{-- Mobile: flex-col items-center agar nomor di atas judul --}}
                        {{-- Desktop: lg:contents agar kembali sejajar seperti asli --}}
                        <div class="flex flex-col items-center gap-2 lg:contents">
                            {{-- Nomor --}}
                            <div class="w-7 h-7 lg:w-12 lg:h-12 rounded-lg lg:rounded-xl flex items-center justify-center shrink-0 font-extrabold text-[10px] lg:text-sm"
                                 style="background: var(--brand-secondary); color: var(--brand-accent)">
                                {{ sprintf('%02d', $i + 1) }}
                            </div>

                            {{-- Judul (Mobile: tampil di bawah nomor, center) --}}
                            <h3 class="font-extrabold text-xs lg:text-lg leading-tight lg:hidden" style="color: var(--brand-secondary)">{{ $cat->name }}</h3>
                        </div>

                        {{-- Deskripsi & Badge --}}
                        <div class="flex-1 min-w-0 flex flex-col items-center lg:items-start">
                            {{-- Judul untuk Desktop --}}
                            <h3 class="hidden lg:block font-extrabold text-lg" style="color: var(--brand-secondary)">{{ $cat->name }}</h3>
                            
                            <p class="text-[10px] lg:text-sm text-slate-500 mt-1 leading-relaxed line-clamp-2 lg:line-clamp-none">{{ \Illuminate\Support\Str::limit($desc, 90) }}</p>

                            @if($count)
                                <span class="inline-block mt-1.5 lg:mt-2.5 text-[9px] lg:text-xs font-bold px-2 lg:px-3 py-0.5 lg:py-1.5 rounded-full" style="background: var(--brand-accent); color: var(--brand-secondary)">
                                    {{ $count }} sub-layanan
                                </span>
                            @else
                                <span class="inline-block mt-1.5 lg:mt-2.5 text-[9px] lg:text-xs font-semibold px-2 lg:px-3 py-0.5 lg:py-1.5 rounded-full bg-slate-100 text-slate-400">Segera hadir</span>
                            @endif
                        </div>

                        {{-- Tombol --}}
                        {{-- Mobile: self-center (tengah) --}}
                        {{-- Desktop: lg:self-center (tetap tengah kanan seperti asli) --}}
                        <span class="svc-btn shrink-0 self-center mt-1 lg:mt-0">
                            Selengkapnya
                            <svg class="w-3 h-3 lg:w-4 lg:h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                        </span>
                    </a>
                @empty
                    <p class="text-slate-400 py-6 col-span-2 lg:col-span-1 text-center lg:text-left">Belum ada kategori layanan. Tambahkan lewat admin panel.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
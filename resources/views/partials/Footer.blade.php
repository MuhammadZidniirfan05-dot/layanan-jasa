@php
    $footerCategories = \App\Models\ServiceCategory::orderBy('order')->get();
@endphp

<footer class="border-t border-white/10 pt-14 pb-8" style="background: var(--brand-secondary)">
    <div class="max-w-6xl mx-auto px-5">
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-10">
            <div>
                <span class="font-extrabold text-white text-lg">{{ $settings->site_name }}</span>
                <p class="text-sm text-white/50 leading-relaxed mt-3">{{ $settings->tagline }}</p>
            </div>
            <div>
                <h5 class="text-white font-bold text-sm mb-4">Layanan</h5>
                <ul class="space-y-2.5 text-sm text-white/50">
                    @foreach($footerCategories as $cat)
                        <li><a href="{{ route('category.show', $cat->slug) }}" class="hover:text-white transition-colors">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h5 class="text-white font-bold text-sm mb-4">Navigasi</h5>
                <ul class="space-y-2.5 text-sm text-white/50">
                    <li><a href="{{ route('landing') }}#portfolio" class="hover:text-white transition-colors">Portfolio</a></li>
                    <li><a href="{{ route('landing') }}#testimoni" class="hover:text-white transition-colors">Testimoni</a></li>
                    <li><a href="{{ route('landing') }}#faq" class="hover:text-white transition-colors">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-white font-bold text-sm mb-4">Kontak</h5>
                <ul class="space-y-2.5 text-sm text-white/50">
                    <li>{{ $settings->whatsapp_number }}</li>
                    @if($settings->email)<li>{{ $settings->email }}</li>@endif
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 mt-12 pt-6 text-center text-xs text-white/40">
            © {{ date('Y') }} {{ $settings->site_name }}. Semua hak dilindungi.
        </div>
    </div>
</footer>
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-100" x-data="{ mobileOpen: false }">
    <div class="max-w-6xl mx-auto px-5 py-3 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-2">
            @if($settings->logo)
                <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->site_name }}" class="h-11 md:h-14 w-auto">
            @else
                <span class="font-extrabold text-xl tracking-tight" style="color: var(--brand-secondary)">{{ $settings->site_name }}</span>
            @endif
        </a>

        <nav class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-wider text-slate-500">
            <a href="{{ route('landing') }}#layanan" data-nav-link="layanan" class="nav-link transition-opacity" style="color: var(--brand-secondary)">Layanan</a>
            <a href="{{ route('landing') }}#portfolio" data-nav-link="portfolio" class="nav-link transition-opacity" style="color: var(--brand-secondary)">Portfolio</a>
            <a href="{{ route('landing') }}#testimoni" data-nav-link="testimoni" class="nav-link transition-opacity" style="color: var(--brand-secondary)">Testimoni</a>
            <a href="{{ route('landing') }}#faq" data-nav-link="faq" class="nav-link transition-opacity" style="color: var(--brand-secondary)">FAQ</a>
        </nav>

        <a href="{{ $settings->waLink() }}" target="_blank"
           class="hidden md:inline-flex items-center gap-1.5 text-white text-sm font-bold px-5 py-2.5 rounded-full transition-all hover:scale-105 btn-press"
           style="background: var(--brand-secondary)">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" />
            </svg>
            Chat Sekarang
        </a>

        <button class="md:hidden" style="color: var(--brand-secondary)" @click="mobileOpen = !mobileOpen">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition class="md:hidden border-t border-slate-100 px-5 py-4 space-y-3 bg-white">
        <a href="{{ route('landing') }}#layanan" data-nav-link="layanan" class="nav-link block text-slate-600 font-bold uppercase text-xs tracking-wider" @click="mobileOpen = false">Layanan</a>
        <a href="{{ route('landing') }}#portfolio" data-nav-link="portfolio" class="nav-link block text-slate-600 font-bold uppercase text-xs tracking-wider" @click="mobileOpen = false">Portfolio</a>
        <a href="{{ route('landing') }}#testimoni" data-nav-link="testimoni" class="nav-link block text-slate-600 font-bold uppercase text-xs tracking-wider" @click="mobileOpen = false">Testimoni</a>
        <a href="{{ route('landing') }}#faq" data-nav-link="faq" class="nav-link block text-slate-600 font-bold uppercase text-xs tracking-wider" @click="mobileOpen = false">FAQ</a>
        <a href="{{ $settings->waLink() }}" target="_blank" class="block text-center text-white font-bold px-4 py-2.5 rounded-full" style="background: var(--brand-secondary)">Chat Sekarang</a>
    </div>
</header>
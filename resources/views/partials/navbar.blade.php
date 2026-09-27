<header class="sticky top-0 z-50 border-b border-white/10" style="background: var(--brand-secondary)" x-data="{ mobileOpen: false }">
    <div class="max-w-6xl mx-auto px-5 py-3 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-2">
            @if($settings->logo)
                <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->site_name }}" class="h-11 md:h-14 w-auto brightness-0 invert">
            @else
                <span class="font-extrabold text-xl tracking-tight text-white">{{ $settings->site_name }}</span>
            @endif
        </a>

        <nav class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-wider text-white/85">
            <a href="{{ route('landing') }}#layanan" data-nav-link="layanan" class="nav-link hover:text-white transition-opacity">Layanan</a>
            <a href="{{ route('landing') }}#portfolio" data-nav-link="portfolio" class="nav-link hover:text-white transition-opacity">Portfolio</a>
            <a href="{{ route('landing') }}#testimoni" data-nav-link="testimoni" class="nav-link hover:text-white transition-opacity">Testimoni</a>
            <a href="{{ route('landing') }}#faq" data-nav-link="faq" class="nav-link hover:text-white transition-opacity">FAQ</a>
        </nav>

        <a href="{{ $settings->waLink() }}" target="_blank"
           class="hidden md:inline-flex items-center gap-1.5 text-sm font-bold px-5 py-2.5 rounded-full transition-all hover:scale-105 btn-press"
           style="background: var(--brand-accent); color: var(--brand-secondary)">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z" />
            </svg>
            Chat Sekarang
        </a>

        <button class="md:hidden text-white" @click="mobileOpen = !mobileOpen">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition class="md:hidden border-t border-white/10 px-5 py-4 space-y-3" style="background: var(--brand-secondary)">
        <a href="{{ route('landing') }}#layanan" data-nav-link="layanan" class="nav-link block text-white/85 font-bold uppercase text-xs tracking-wider" @click="mobileOpen = false">Layanan</a>
        <a href="{{ route('landing') }}#portfolio" data-nav-link="portfolio" class="nav-link block text-white/85 font-bold uppercase text-xs tracking-wider" @click="mobileOpen = false">Portfolio</a>
        <a href="{{ route('landing') }}#testimoni" data-nav-link="testimoni" class="nav-link block text-white/85 font-bold uppercase text-xs tracking-wider" @click="mobileOpen = false">Testimoni</a>
        <a href="{{ route('landing') }}#faq" data-nav-link="faq" class="nav-link block text-white/85 font-bold uppercase text-xs tracking-wider" @click="mobileOpen = false">FAQ</a>
        <a href="{{ $settings->waLink() }}" target="_blank"
           class="block text-center font-bold px-4 py-2.5 rounded-full"
           style="background: var(--brand-accent); color: var(--brand-secondary)">
            Chat Sekarang
        </a>
    </div>
</header>
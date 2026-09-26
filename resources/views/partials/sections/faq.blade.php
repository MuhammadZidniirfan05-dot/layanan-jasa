<section id="faq" class="max-w-4xl mx-auto px-5 py-16">
    <div class="reveal text-center max-w-xl mx-auto mb-10">
        <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">FAQ</span>
        <h2 class="text-3xl md:text-4xl font-extrabold mt-3" style="color: var(--brand-secondary)">Pertanyaan Umum</h2>
    </div>
    <div class="space-y-3" x-data="{ open: 0 }">
        @foreach($faqs as $i => $faq)
            <div class="reveal card-shadow bg-white rounded-2xl overflow-hidden" style="transition-delay: {{ $i * 70 }}ms">
                <button @click="open = (open === {{ $i }} ? -1 : {{ $i }})" class="w-full flex items-center justify-between gap-4 px-5 py-4 text-left">
                    <span class="font-semibold" style="color: var(--brand-secondary)">{{ $faq->question }}</span>
                    <svg class="w-4 h-4 shrink-0 transition-transform duration-300" style="color: var(--brand-primary)" :class="open === {{ $i }} ? 'rotate-45' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14" /></svg>
                </button>
                <div x-show="open === {{ $i }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                    <div class="px-5 pb-4 text-sm text-slate-500 leading-relaxed">{{ $faq->answer }}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>
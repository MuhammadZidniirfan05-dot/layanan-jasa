<section id="testimoni" class="max-w-6xl mx-auto px-4 md:px-5 py-16 overflow-hidden">
    <div class="reveal text-center max-w-xl mx-auto mb-8 md:mb-10">
        <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">Testimoni</span>
        <h2 class="text-2xl md:text-4xl font-extrabold mt-2 md:mt-3" style="color: var(--brand-secondary)">Apa kata mereka</h2>
    </div>

    @if($testimonials->count())
    <div class="reveal"
         x-data="{
            n: {{ $testimonials->count() }},
            v: 3, gap: 20, W: 0, P: 0, slotW: 0, shiftMax: 0,
            pos: 0, target: 0, vel: 0,
            dragging: false, moved: false, lastX: 0,
            paused: false, raf: null, timer: null,
            measure() {
                this.W = this.$refs.stage.offsetWidth;
                // PERUBAHAN: Selalu 3 kartu, tidak peduli ukuran layar
                this.v = 3;
                // PERUBAHAN: Gap lebih kecil di HP
                this.gap = window.innerWidth < 768 ? 8 : 20;
                // PERUBAHAN: Padding samping lebih kecil di HP
                this.P = this.W * (window.innerWidth < 768 ? 0.04 : 0.09);
                this.slotW = (this.W - this.P * 2 - this.gap * (this.v - 1)) / this.v;
                this.shiftMax = this.slotW * 0.075 + this.P * 0.85;
            },
            init() {
                this.measure();
                window.addEventListener('resize', () => this.measure());
                const loop = () => {
                    if (!this.dragging) {
                        const d = this.target - this.pos;
                        this.pos = Math.abs(d) < 0.001 ? this.target : this.pos + d * 0.12;
                    }
                    this.raf = requestAnimationFrame(loop);
                };
                loop();
                this.timer = setInterval(() => {
                    if (!this.paused && !this.dragging) this.target += 1;
                }, 5000);
            },
            get lo() { return this.n > this.v ? -Math.floor((this.n - this.v) / 2) : 0; },
            get c() { return (this.v - 1) / 2; },
            rel(i) {
                const lo = this.lo;
                return ((((i - this.pos - lo) % this.n) + this.n) % this.n) + lo;
            },
            cardStyle(i) {
                const rel = this.rel(i);
                const d = rel - this.c;
                const s = d < 0 ? -1 : 1;
                const e = Math.max(0, Math.abs(d) - this.c);
                const step = this.slotW + this.gap;
                let x, o = 1, sc = 1;
                if (e <= 0) {
                    x = this.P + rel * step;
                } else {
                    const edge = s > 0 ? this.P + (this.v - 1) * step : this.P;
                    const sh = this.shiftMax * (e <= 1 ? e : 1 + (e - 1) * 0.6);
                    x = edge + s * sh;
                    o = e <= 1 ? 1 - 0.6 * e : Math.max(0, 0.4 * (2 - e));
                    sc = 1 - 0.15 * Math.min(e, 1);
                }
                const rot = Math.max(-32, Math.min(32, d * 10 + s * Math.min(e, 1) * 10));
                const blur = Math.min(e, 1) * 2;
                const z = Math.max(0, Math.round(10 - Math.abs(d) * 3));
                return `width:${this.slotW}px; transform: translateX(${x}px) rotateY(${rot}deg) scale(${sc}); opacity:${o.toFixed(3)}; filter: blur(${blur.toFixed(2)}px); z-index:${z}; pointer-events:${o > 0.3 ? 'auto' : 'none'}`;
            },
            get active() { return ((Math.round(this.pos + this.c) % this.n) + this.n) % this.n; },
            go(dir) { this.target = Math.round(this.target) + dir; },
            goTo(i) {
                this.target = Math.round(this.pos + this.rel(i) - this.c);
            },
            down(e) {
                this.dragging = true; this.moved = false; this.lastX = e.clientX; this.vel = 0;
                e.currentTarget.setPointerCapture(e.pointerId);
            },
            move(e) {
                if (!this.dragging) return;
                const dx = e.clientX - this.lastX;
                this.lastX = e.clientX;
                if (Math.abs(dx) > 1) this.moved = true;
                const delta = -dx / (this.slotW + this.gap);
                this.pos += delta;
                this.target = this.pos;
                this.vel = delta;
            },
            up() {
                if (!this.dragging) return;
                this.dragging = false;
                this.target = Math.round(this.pos + this.vel * 6);
                this.vel = 0;
            },
            wheel(e) {
                if (Math.abs(e.deltaX) > Math.abs(e.deltaY)) {
                    e.preventDefault();
                    this.target += e.deltaX * 0.004;
                    clearTimeout(this._w);
                    this._w = setTimeout(() => { this.target = Math.round(this.target); }, 120);
                }
            },
            destroy() { cancelAnimationFrame(this.raf); clearInterval(this.timer); }
         }"
         @mouseenter="paused = true" @mouseleave="paused = false">

        {{-- PERUBAHAN: Tinggi stage disesuaikan untuk HP --}}
        {{-- HP: h-[220px], Tablet: md:h-[280px], Desktop: lg:h-[350px] --}}
        <div x-ref="stage" class="relative h-[220px] md:h-[280px] lg:h-[350px] select-none cursor-grab active:cursor-grabbing"
             style="touch-action: pan-y; perspective: 1400px;"
             @pointerdown="down($event)" @pointermove="move($event)"
             @pointerup="up()" @pointercancel="up()"
             @wheel="wheel($event)">

            @foreach($testimonials as $i => $t)
                {{-- PERUBAHAN: Tinggi kartu & padding disesuaikan untuk HP --}}
                {{-- HP: h-[190px] px-2.5 py-3, Desktop: lg:h-[310px] lg:px-6 lg:py-7 --}}
                <div class="absolute top-3 left-0 h-[190px] md:h-[250px] lg:h-[310px] bg-white rounded-xl lg:rounded-3xl card-shadow px-2.5 py-3 md:px-4 md:py-5 lg:px-6 lg:py-7 flex flex-col items-center text-center"
                     :style="cardStyle({{ $i }})"
                     @click="if (!moved) goTo({{ $i }})">

                    {{-- PERUBAHAN: Bintang lebih kecil di HP --}}
                    <div class="flex gap-0.5 md:gap-1 justify-center">
                        @for($s = 0; $s < 5; $s++)
                            <svg class="w-3 h-3 md:w-4 md:h-4 lg:w-5 lg:h-5" style="color: var(--brand-accent)" fill="{{ $s < $t->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1L12 2z"/></svg>
                        @endfor
                    </div>

                    {{-- PERUBAHAN: Font pesan lebih kecil di HP --}}
                    {{-- HP: text-[9px], Desktop: lg:text-base --}}
                    <p class="text-slate-500 leading-snug md:leading-relaxed mt-2 md:mt-4 flex-1 flex items-center text-[9px] md:text-xs lg:text-base line-clamp-4 md:line-clamp-none">"{{ $t->message }}"</p>

                    {{-- PERUBAHAN: Padding & gap footer lebih kecil di HP --}}
                    <div class="w-full pt-2 md:pt-4 border-t border-slate-100 flex flex-col items-center gap-1 md:gap-2">
                        {{-- PERUBAHAN: Avatar lebih kecil di HP --}}
                        @if($t->photo)
                            <img src="{{ asset('storage/' . $t->photo) }}" class="w-6 h-6 md:w-9 md:h-9 lg:w-11 lg:h-11 rounded-full object-cover" alt="{{ $t->name }}" draggable="false">
                        @else
                            <div class="w-6 h-6 md:w-9 md:h-9 lg:w-11 lg:h-11 rounded-full flex items-center justify-center font-bold text-[8px] md:text-xs lg:text-sm text-white" style="background: var(--brand-primary)">{{ substr($t->name, 0, 1) }}</div>
                        @endif
                        <div>
                            {{-- PERUBAHAN: Font nama & role lebih kecil di HP --}}
                            <p class="font-bold text-[9px] md:text-xs lg:text-sm leading-tight" style="color: var(--brand-secondary)">{{ $t->name }}</p>
                            <p class="text-[8px] md:text-[10px] lg:text-xs text-slate-400 leading-tight">{{ $t->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($testimonials->count() > 1)
        {{-- PERUBAHAN: Gap & margin kontrol lebih kecil di HP --}}
        <div class="flex items-center justify-center gap-2 md:gap-4 mt-2">
            {{-- PERUBAHAN: Tombol navigasi lebih kecil di HP --}}
            <button @click="go(-1)" aria-label="Sebelumnya"
                    class="w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center transition-transform hover:scale-110"
                    style="background: color-mix(in srgb, var(--brand-primary) 12%, white); color: var(--brand-primary)">
                <svg class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
            </button>

            {{-- PERUBAHAN: Dots lebih kecil di HP --}}
            <div class="flex items-center gap-1.5 md:gap-2">
                @foreach($testimonials as $i => $t)
                    <button @click="goTo({{ $i }})" aria-label="Testimoni {{ $i + 1 }}"
                            class="h-1.5 md:h-2 rounded-full transition-all duration-300"
                            :class="active === {{ $i }} ? 'w-5 md:w-6' : 'w-1.5 md:w-2'"
                            :style="active === {{ $i }} ? 'background: var(--brand-primary)' : 'background: color-mix(in srgb, var(--brand-primary) 25%, white)'"></button>
                @endforeach
            </div>

            <button @click="go(1)" aria-label="Berikutnya"
                    class="w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center transition-transform hover:scale-110"
                    style="background: var(--brand-accent); color: var(--brand-secondary)">
                <svg class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </button>
        </div>
        @endif
    </div>
    @else
        <p class="text-slate-400 text-center">Belum ada testimoni.</p>
    @endif
</section>
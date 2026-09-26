<section id="testimoni" class="max-w-6xl mx-auto px-5 py-16 overflow-hidden">
    <div class="reveal text-center max-w-xl mx-auto mb-10">
        <span class="text-xs font-bold uppercase tracking-widest" style="color: var(--brand-primary)">Testimoni</span>
        <h2 class="text-3xl md:text-4xl font-extrabold mt-3" style="color: var(--brand-secondary)">Apa kata mereka</h2>
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
                this.v = window.innerWidth < 768 ? 1 : 3;
                this.gap = this.v === 1 ? 16 : 20;
                this.P = this.W * (this.v === 1 ? 0.12 : 0.09);
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

        <div x-ref="stage" class="relative h-[350px] select-none cursor-grab active:cursor-grabbing"
             style="touch-action: pan-y; perspective: 1400px;"
             @pointerdown="down($event)" @pointermove="move($event)"
             @pointerup="up()" @pointercancel="up()"
             @wheel="wheel($event)">

            @foreach($testimonials as $i => $t)
                <div class="absolute top-3 left-0 h-[310px] bg-white rounded-3xl card-shadow px-6 py-7 flex flex-col items-center text-center"
                     :style="cardStyle({{ $i }})"
                     @click="if (!moved) goTo({{ $i }})">

                    <div class="flex gap-1 justify-center">
                        @for($s = 0; $s < 5; $s++)
                            <svg class="w-5 h-5" style="color: var(--brand-accent)" fill="{{ $s < $t->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1L12 2z"/></svg>
                        @endfor
                    </div>

                    <p class="text-slate-500 leading-relaxed mt-4 flex-1 flex items-center text-sm md:text-base">"{{ $t->message }}"</p>

                    <div class="w-full pt-4 border-t border-slate-100 flex flex-col items-center gap-2">
                        @if($t->photo)
                            <img src="{{ asset('storage/' . $t->photo) }}" class="w-11 h-11 rounded-full object-cover" alt="{{ $t->name }}" draggable="false">
                        @else
                            <div class="w-11 h-11 rounded-full flex items-center justify-center font-bold text-sm text-white" style="background: var(--brand-primary)">{{ substr($t->name, 0, 1) }}</div>
                        @endif
                        <div>
                            <p class="font-bold text-sm" style="color: var(--brand-secondary)">{{ $t->name }}</p>
                            <p class="text-xs text-slate-400">{{ $t->role }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($testimonials->count() > 1)
        <div class="flex items-center justify-center gap-4 mt-2">
            <button @click="go(-1)" aria-label="Sebelumnya"
                    class="w-10 h-10 rounded-full flex items-center justify-center transition-transform hover:scale-110"
                    style="background: color-mix(in srgb, var(--brand-primary) 12%, white); color: var(--brand-primary)">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 6l-6 6 6 6"/></svg>
            </button>

            <div class="flex items-center gap-2">
                @foreach($testimonials as $i => $t)
                    <button @click="goTo({{ $i }})" aria-label="Testimoni {{ $i + 1 }}"
                            class="h-2 rounded-full transition-all duration-300"
                            :class="active === {{ $i }} ? 'w-6' : 'w-2'"
                            :style="active === {{ $i }} ? 'background: var(--brand-primary)' : 'background: color-mix(in srgb, var(--brand-primary) 25%, white)'"></button>
                @endforeach
            </div>

            <button @click="go(1)" aria-label="Berikutnya"
                    class="w-10 h-10 rounded-full flex items-center justify-center transition-transform hover:scale-110"
                    style="background: var(--brand-accent); color: var(--brand-secondary)">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </button>
        </div>
        @endif
    </div>
    @else
        <p class="text-slate-400 text-center">Belum ada testimoni.</p>
    @endif
</section>
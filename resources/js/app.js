import LocomotiveScroll from 'locomotive-scroll';
import 'locomotive-scroll/dist/locomotive-scroll.css';

// ── Disable browser automatic scroll restoration ──────────
if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}
window.scrollTo(0, 0);

// ── Wait for DOM ready ────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    window.scrollTo(0, 0);

    // ── Locomotive Scroll Init ────────────────────────────
    const scrollContainer = document.querySelector('[data-scroll-container]');

    let locoScroll = null;

    if (scrollContainer) {
        locoScroll = new LocomotiveScroll({
            el: scrollContainer,
            smooth: true,
            lerp: 0.08,
            multiplier: 1,
            class: 'is-inview',
            tablet: { smooth: true, breakpoint: 1024 },
            smartphone: { smooth: false },
            autoStart: false,
        });

        locoScroll.scrollTo(0, { immediate: true });

        // Update on resize
        window.addEventListener('resize', () => locoScroll.update());
    }

    // ── Cover Overlay "Buka Undangan" ─────────────────────
    const coverOverlay  = document.getElementById('cover-overlay');
    const bukaBtns      = document.querySelectorAll('[data-buka-undangan]');
    const mainContent   = document.getElementById('main-content');

    if (coverOverlay) {
        const preventGhostScroll = (e) => {
            e.preventDefault();
            e.stopPropagation();
        };
        coverOverlay.addEventListener('wheel', preventGhostScroll, { passive: false });
        coverOverlay.addEventListener('touchmove', preventGhostScroll, { passive: false });
    }

    bukaBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const guestId = document.body.dataset.guestId;
            if (guestId) {
                fetch(`/guest/${guestId}/open`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json',
                    },
                }).catch(() => {});
            }

            if (coverOverlay) {
                coverOverlay.classList.add('hidden-overlay');
                document.body.classList.remove('overflow-hidden');

                window.scrollTo(0, 0);

                if (locoScroll) {
                    locoScroll.start();
                    locoScroll.scrollTo(0, { immediate: true });
                    locoScroll.scrollTo('#section-ayat', { immediate: true });
                    locoScroll.update();
                }

                setTimeout(() => {
                    coverOverlay.style.display = 'none';
                    if (locoScroll) {
                        locoScroll.scrollTo('#section-ayat', { immediate: true });
                        locoScroll.update();
                    }
                }, 800);
            }
        });
    });

    // ── Countdown Timer ───────────────────────────────────
    const cdContainer = document.querySelector('[data-countdown-container]');
    const rawTargetDate = cdContainer?.dataset?.targetDate;
    let targetDate;
    if (rawTargetDate) {
        targetDate = new Date(rawTargetDate);
        if (isNaN(targetDate.getTime())) {
            targetDate = new Date('2026-10-23T08:00:00+07:00');
        }
    } else {
        targetDate = new Date('2026-10-23T08:00:00+07:00');
    }

    const daysEl    = document.getElementById('cd-days');
    const hoursEl   = document.getElementById('cd-hours');
    const minsEl    = document.getElementById('cd-mins');
    const secsEl    = document.getElementById('cd-secs');

    function updateCountdown() {
        const now  = new Date();
        const diff = targetDate - now;

        if (diff <= 0) {
            if (daysEl) daysEl.textContent  = '00';
            if (hoursEl) hoursEl.textContent = '00';
            if (minsEl) minsEl.textContent   = '00';
            if (secsEl) secsEl.textContent   = '00';
            return;
        }

        const days  = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const mins  = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const secs  = Math.floor((diff % (1000 * 60)) / 1000);

        if (daysEl)  daysEl.textContent  = String(days).padStart(2, '0');
        if (hoursEl) hoursEl.textContent = String(hours).padStart(2, '0');
        if (minsEl)  minsEl.textContent  = String(mins).padStart(2, '0');
        if (secsEl)  secsEl.textContent  = String(secs).padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

    // ── Copy to Clipboard ─────────────────────────────────
    const toast = document.getElementById('copy-toast');

    function showToast(msg) {
        if (!toast) return;
        toast.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2000);
    }

    document.querySelectorAll('[data-copy]').forEach(btn => {
        btn.addEventListener('click', () => {
            const text = btn.dataset.copy;
            navigator.clipboard.writeText(text).then(() => {
                const original = btn.textContent;
                btn.textContent = 'Tersalin! ✓';
                showToast('Nomor rekening tersalin!');
                setTimeout(() => { btn.textContent = original; }, 2000);
            }).catch(() => {
                // Fallback for older browsers
                const el = document.createElement('textarea');
                el.value = text;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
                showToast('Nomor rekening tersalin!');
            });
        });
    });

    // ── RSVP Form Submit ──────────────────────────────────
    const rsvpForm = document.getElementById('rsvp-form');
    const rsvpMsg  = document.getElementById('rsvp-message');
    const rombonganField = document.getElementById('field-rombongan');
    const statusInputs   = document.querySelectorAll('input[name="status_hadir"]');

    // Toggle jumlah rombongan visibility
    statusInputs.forEach(input => {
        input.addEventListener('change', () => {
            if (rombonganField) {
                rombonganField.style.display = input.value === 'Hadir' ? 'block' : 'none';
            }
        });
    });

    if (rsvpForm) {
        rsvpForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn  = rsvpForm.querySelector('[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Mengirim...';
            submitBtn.disabled = true;

            const formData = new FormData(rsvpForm);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await fetch('/rsvp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                const json = await res.json();

                if (res.ok) {
                    rsvpMsg.textContent = json.message;
                    rsvpMsg.className = 'mt-4 p-3 rounded-lg text-center text-sm font-medium bg-green-50 text-green-800 border border-green-200';
                    rsvpMsg.style.display = 'block';
                    rsvpForm.reset();
                    if (rombonganField) rombonganField.style.display = 'block';
                    // Reload guestbook
                    loadWishes();
                } else {
                    const errors = json.errors ? Object.values(json.errors).flat().join(' ') : json.message;
                    rsvpMsg.textContent = errors;
                    rsvpMsg.className = 'mt-4 p-3 rounded-lg text-center text-sm font-medium bg-red-50 text-red-800 border border-red-200';
                    rsvpMsg.style.display = 'block';
                }
            } catch (err) {
                rsvpMsg.textContent = 'Terjadi kesalahan. Coba lagi.';
                rsvpMsg.className = 'mt-4 p-3 rounded-lg text-center text-sm font-medium bg-red-50 text-red-800 border border-red-200';
                rsvpMsg.style.display = 'block';
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                if (locoScroll) setTimeout(() => locoScroll.update(), 300);
            }
        });
    }

    // ── Guestbook Feed ────────────────────────────────────
    const wishesFeed = document.getElementById('wishes-feed');

    async function loadWishes() {
        if (!wishesFeed) return;

        try {
            const res  = await fetch('/rsvp/wishes');
            const json = await res.json();

            if (json.success && json.data.length > 0) {
                wishesFeed.innerHTML = json.data.map(item => {
                    const date = new Date(item.created_at);
                    const dateStr = date.toLocaleDateString('id-ID', {
                        day: 'numeric', month: 'long', year: 'numeric'
                    });
                    const badge = item.status_hadir === 'Hadir'
                        ? `<span class="inline-block text-[9px] px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-medium tracking-wide">✓ Hadir</span>`
                        : `<span class="inline-block text-[9px] px-2 py-0.5 rounded-full bg-stone-100 text-stone-600 font-medium tracking-wide">Tidak Hadir</span>`;

                    return `
                        <div class="wish-card mb-3">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <p class="font-semibold text-sm text-brown-950" style="font-family:'Cinzel',serif;color:#362B24;">${escapeHtml(item.guest_name)}</p>
                                ${badge}
                            </div>
                            <p class="text-sm leading-relaxed" style="font-family:'Playfair Display',serif;font-style:italic;color:#6B4D38;">"${escapeHtml(item.wishes)}"</p>
                            <p class="text-[10px] mt-2" style="color:rgba(107,77,56,0.5);">${dateStr}</p>
                        </div>
                    `;
                }).join('');
                if (locoScroll) setTimeout(() => locoScroll.update(), 100);
            } else {
                wishesFeed.innerHTML = `<p class="text-center text-sm py-6" style="color:rgba(107,77,56,0.5);font-style:italic;">Belum ada ucapan. Jadilah yang pertama!</p>`;
            }
        } catch (err) {
            wishesFeed.innerHTML = `<p class="text-center text-sm py-4" style="color:rgba(107,77,56,0.5);">Gagal memuat ucapan.</p>`;
        }
    }

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    loadWishes();

    // ── Bottom Nav Scroll To Section ─────────────────────
    document.querySelectorAll('[data-scroll-to-target]').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = link.dataset.scrollToTarget || link.getAttribute('href');
            if (target && target.startsWith('#')) {
                if (locoScroll) {
                    locoScroll.scrollTo(target, { offset: -20, duration: 1.2 });
                } else {
                    document.querySelector(target)?.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

});

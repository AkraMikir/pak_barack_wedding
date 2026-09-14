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
            const copyType = btn.dataset.copyType || 'rekening';
            const toastMsg = copyType === 'alamat' ? 'Alamat kirim tersalin!' : 'Nomor rekening tersalin!';

            navigator.clipboard.writeText(text).then(() => {
                const span = btn.querySelector('span') || btn;
                const original = span.textContent;
                span.textContent = 'Tersalin! ✓';
                showToast(toastMsg);
                setTimeout(() => { span.textContent = original; }, 2000);
            }).catch(() => {
                // Fallback for older browsers
                const el = document.createElement('textarea');
                el.value = text;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
                showToast(toastMsg);
            });
        });
    });

    // ── RSVP Form Submit ──────────────────────────────────
    const rsvpForm = document.getElementById('rsvp-form');
    const rsvpMsg  = document.getElementById('rsvp-message');
    const rombonganField = document.getElementById('field-rombongan');
    const labelHadir = document.getElementById('label-hadir');
    const labelTidak = document.getElementById('label-tidak');
    const statusInputs   = document.querySelectorAll('input[name="status_hadir"]');

    function syncRsvpSelection(val) {
        if (val === 'Hadir') {
            labelHadir?.classList.add('is-selected-hadir');
            labelTidak?.classList.remove('is-selected-tidak');
            if (rombonganField) rombonganField.style.display = 'block';
        } else {
            labelTidak?.classList.add('is-selected-tidak');
            labelHadir?.classList.remove('is-selected-hadir');
            if (rombonganField) rombonganField.style.display = 'none';
        }
    }

    // Toggle jumlah rombongan visibility and button styling
    statusInputs.forEach(input => {
        input.addEventListener('change', () => {
            syncRsvpSelection(input.value);
        });
    });

    if (rsvpForm) {
        rsvpForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn  = rsvpForm.querySelector('[type="submit"]');
            const originalHtml = submitBtn.innerHTML;
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
                    rsvpMsg.className = 'mt-5 p-3.5 rounded-xl text-center text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200';
                    rsvpMsg.style.display = 'block';

                    // Reset textarea wishes & reload feed
                    const wishesEl = rsvpForm.querySelector('textarea[name="wishes"]');
                    if (wishesEl) wishesEl.value = '';
                    loadWishes();
                } else {
                    const errors = json.errors ? Object.values(json.errors).flat().join(' ') : json.message;
                    rsvpMsg.textContent = errors;
                    rsvpMsg.className = 'mt-5 p-3.5 rounded-xl text-center text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200';
                    rsvpMsg.style.display = 'block';
                }
            } catch (err) {
                rsvpMsg.textContent = 'Terjadi kesalahan. Coba lagi.';
                rsvpMsg.className = 'mt-5 p-3.5 rounded-xl text-center text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200';
                rsvpMsg.style.display = 'block';
            } finally {
                submitBtn.innerHTML = originalHtml;
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
                    const badgeText = item.status_hadir === 'Hadir' ? 'HADIR' : 'BERHALANGAN';
                    const badge = `<span class="badge-kehadiran">${badgeText}</span>`;

                    return `
                        <div class="wish-card">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <p class="font-bold text-xs uppercase tracking-wide" style="font-family:'Cinzel',serif;color:#362B24;letter-spacing:0.06em;">${escapeHtml(item.guest_name)}</p>
                                ${badge}
                            </div>
                            <p class="text-xs sm:text-sm leading-relaxed" style="font-family:'Playfair Display',serif;font-style:italic;color:#5C4B3E;line-height:1.65;">${escapeHtml(item.wishes)}</p>
                        </div>
                    `;
                }).join('');
                if (locoScroll) setTimeout(() => locoScroll.update(), 100);
            } else {
                wishesFeed.innerHTML = `<p class="text-center text-sm py-6" style="color:rgba(107,77,56,0.5);font-style:italic;">Belum ada doa &amp; ucapan.</p>`;
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

    // ── Galeri Slider (Dokumentasi Cinta) ────────────────
    const galleryCard = document.getElementById('gallery-card');
    if (galleryCard) {
        let galleryData = [];
        try {
            galleryData = JSON.parse(galleryCard.dataset.galleryItems || '[]');
        } catch (e) {
            galleryData = [];
        }

        if (galleryData.length > 0) {
            let currentIndex = 0;
            const mainImg = document.getElementById('gallery-main-img');
            const mainTitle = document.getElementById('gallery-main-title');
            const prevBtn = document.getElementById('gallery-prev');
            const nextBtn = document.getElementById('gallery-next');
            const dots = document.querySelectorAll('.gallery-dot');
            const thumbs = document.querySelectorAll('.gallery-thumb-btn');

            function goToSlide(index) {
                if (index < 0) index = galleryData.length - 1;
                if (index >= galleryData.length) index = 0;
                currentIndex = index;

                const item = galleryData[currentIndex];

                if (mainImg) {
                    mainImg.style.opacity = '0';
                    setTimeout(() => {
                        mainImg.src = item.url;
                        mainImg.alt = item.title;
                        mainImg.style.opacity = '1';
                    }, 150);
                }

                if (mainTitle) {
                    mainTitle.textContent = item.title;
                }

                dots.forEach((dot, idx) => {
                    if (idx === currentIndex) {
                        dot.className = 'gallery-dot transition-all duration-300 w-6 h-2 rounded-full bg-[#8B6C3F]';
                    } else {
                        dot.className = 'gallery-dot transition-all duration-300 w-2 h-2 rounded-full bg-[#D8C7B0] hover:bg-[#BCA990]';
                    }
                });

                thumbs.forEach((thumb, idx) => {
                    if (idx === currentIndex) {
                        thumb.className = 'gallery-thumb-btn relative flex-shrink-0 w-12 h-14 sm:w-14 sm:h-16 rounded-lg overflow-hidden border-2 transition-all duration-200 border-[#8B6C3F] scale-105 shadow-sm';
                        thumb.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                    } else {
                        thumb.className = 'gallery-thumb-btn relative flex-shrink-0 w-12 h-14 sm:w-14 sm:h-16 rounded-lg overflow-hidden border-2 transition-all duration-200 border-transparent opacity-60 hover:opacity-100';
                    }
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', () => goToSlide(currentIndex - 1));
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => goToSlide(currentIndex + 1));
            }

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const idx = parseInt(dot.dataset.galleryIndex, 10);
                    if (!isNaN(idx)) goToSlide(idx);
                });
            });

            thumbs.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    const idx = parseInt(thumb.dataset.galleryThumb, 10);
                    if (!isNaN(idx)) goToSlide(idx);
                });
            });

            // Touch swipe gesture on main image
            let touchStartX = 0;
            let touchEndX = 0;
            galleryCard.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            galleryCard.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchEndX - touchStartX;
                if (Math.abs(diff) > 40) {
                    if (diff < 0) {
                        goToSlide(currentIndex + 1);
                    } else {
                        goToSlide(currentIndex - 1);
                    }
                }
            }, { passive: true });
        }
    }

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

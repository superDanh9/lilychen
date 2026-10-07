/**
 * LILY CHEN MAKEUP ACADEMY - HOMEPAGE PROTOTYPE V2
 * Antigravity Motion Engine & Interactive Logic
 * Reference: Screen Recording 2026-10-02 213506.mp4 (Google Antigravity)
 * & BRIEF-TRANG-CHU-MOI-2026-10-02.md
 */

(function () {
  'use strict';

  // Check prefers-reduced-motion
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Shared Color Palette for Particles
  const PALETTE = [
    '#C5705D', // Terracotta rose (primary)
    '#C99738', // Warm champagne gold
    '#2D2B29', // Deep charcoal slate
    '#E8927C', // Soft peach blush
    '#8C847E', // Warm neutral grey
    '#F0A595'  // Rose petal
  ];

  /* ========================================================
     OFFSCREEN SPRITE GENERATOR (HIGH 60/120 FPS PERFORMANCE)
     ======================================================== */
  const spriteCache = {};

  function getSprite(color, shapeType) {
    const key = `${color}_${shapeType}`;
    if (spriteCache[key]) return spriteCache[key];

    const size = 48;
    const center = size / 2;
    const canvas = document.createElement('canvas');
    canvas.width = size;
    canvas.height = size;
    const ctx = canvas.getContext('2d');

    ctx.fillStyle = color;
    ctx.translate(center, center);

    if (shapeType === 'capsule') {
      // Rounded dash / capsule (distinct Antigravity look)
      const w = 18;
      const h = 5;
      const r = h / 2;
      ctx.beginPath();
      ctx.moveTo(-w / 2 + r, -h / 2);
      ctx.lineTo(w / 2 - r, -h / 2);
      ctx.arc(w / 2 - r, 0, r, -Math.PI / 2, Math.PI / 2);
      ctx.lineTo(-w / 2 + r, h / 2);
      ctx.arc(-w / 2 + r, 0, r, Math.PI / 2, -Math.PI / 2);
      ctx.closePath();
      ctx.fill();
    } else if (shapeType === 'circle') {
      // Soft round dot
      const radius = 4;
      ctx.beginPath();
      ctx.arc(0, 0, radius, 0, Math.PI * 2);
      ctx.fill();
    } else if (shapeType === 'diamond') {
      // Delicate cosmetic sparkle / diamond
      const d = 5;
      ctx.beginPath();
      ctx.moveTo(0, -d);
      ctx.lineTo(d, 0);
      ctx.lineTo(0, d);
      ctx.lineTo(-d, 0);
      ctx.closePath();
      ctx.fill();
    }

    spriteCache[key] = canvas;
    return canvas;
  }

  /* ========================================================
     1. HERO PARTICLES FIELD (0 - 20s IN REFERENCE VIDEO)
     ======================================================== */
  class HeroParticleSystem {
    constructor() {
      this.canvas = document.getElementById('heroParticleCanvas');
      if (!this.canvas) return;

      this.ctx = this.canvas.getContext('2d');
      this.container = document.getElementById('hero');
      this.particles = [];
      this.particleCount = window.innerWidth < 768 ? 45 : 95;
      this.mouseX = -9999;
      this.mouseY = -9999;
      this.targetMouseX = -9999;
      this.targetMouseY = -9999;
      this.isRunning = !prefersReducedMotion;
      this.isInView = true;
      this.animationFrameId = null;

      this.init();
    }

    init() {
      this.resize();
      window.addEventListener('resize', () => this.resize(), { passive: true });

      // Mouse tracking
      window.addEventListener('mousemove', (e) => {
        const rect = this.canvas.getBoundingClientRect();
        this.targetMouseX = e.clientX - rect.left;
        this.targetMouseY = e.clientY - rect.top;
      }, { passive: true });

      // Touch tracking
      window.addEventListener('touchmove', (e) => {
        if (e.touches.length > 0) {
          const rect = this.canvas.getBoundingClientRect();
          this.targetMouseX = e.touches[0].clientX - rect.left;
          this.targetMouseY = e.touches[0].clientY - rect.top;
        }
      }, { passive: true });

      // Create particles
      const shapes = ['capsule', 'capsule', 'circle', 'diamond'];
      for (let i = 0; i < this.particleCount; i++) {
        const color = PALETTE[i % PALETTE.length];
        const shape = shapes[i % shapes.length];
        this.particles.push({
          x: Math.random() * this.width,
          y: Math.random() * this.height,
          vx: (Math.random() - 0.5) * 0.4,
          vy: (Math.random() - 0.5) * 0.4 - 0.1,
          baseRotation: Math.random() * Math.PI * 2,
          rotation: Math.random() * Math.PI * 2,
          rotSpeed: (Math.random() - 0.5) * 0.015,
          scale: Math.random() * 0.5 + 0.6,
          depth: Math.random() * 0.6 + 0.4,
          alpha: Math.random() * 0.45 + 0.35,
          sprite: getSprite(color, shape),
          shape: shape
        });
      }

      // Intersection Observer to save power when scrolled out
      const observer = new IntersectionObserver((entries) => {
        this.isInView = entries[0].isIntersecting;
        if (this.isInView && this.isRunning && !this.animationFrameId) {
          this.loop();
        }
      }, { threshold: 0.05 });
      observer.observe(this.container);

      // Motion Toggle Button
      const toggleBtn = document.getElementById('heroMotionToggle');
      const label = document.getElementById('heroMotionLabel');
      if (toggleBtn && label) {
        toggleBtn.addEventListener('click', () => {
          this.isRunning = !this.isRunning;
          toggleBtn.classList.toggle('paused', !this.isRunning);
          toggleBtn.setAttribute('aria-pressed', String(!this.isRunning));
          label.textContent = this.isRunning ? 'Hiệu ứng hạt: Đang chạy' : 'Hiệu ứng hạt: Đã dừng';
          if (this.isRunning && !this.animationFrameId) {
            this.loop();
          }
        });
      }

      this.loop();
    }

    resize() {
      const dpr = Math.min(window.devicePixelRatio || 1, 2);
      this.width = this.canvas.parentElement.clientWidth;
      this.height = this.canvas.parentElement.clientHeight;

      this.canvas.width = this.width * dpr;
      this.canvas.height = this.height * dpr;
      this.canvas.style.width = `${this.width}px`;
      this.canvas.style.height = `${this.height}px`;

      this.ctx.setTransform(1, 0, 0, 1, 0, 0);
      this.ctx.scale(dpr, dpr);
    }

    loop() {
      if (!this.isRunning || !this.isInView) {
        this.animationFrameId = null;
        return;
      }

      this.ctx.clearRect(0, 0, this.width, this.height);

      // Smooth mouse follow
      this.mouseX += (this.targetMouseX - this.mouseX) * 0.1;
      this.mouseY += (this.targetMouseY - this.mouseY) * 0.1;

      const interactionRadius = 140;

      for (let i = 0; i < this.particles.length; i++) {
        const p = this.particles[i];

        // Natural ambient drift along subtle flow vector
        p.x += p.vx * p.depth;
        p.y += p.vy * p.depth;
        p.rotation += p.rotSpeed;

        // Subtle organic sway
        p.vx += Math.sin(p.y * 0.005 + p.baseRotation) * 0.015;

        // Mouse deflection (Antigravity physics)
        const dx = p.x - this.mouseX;
        const dy = p.y - this.mouseY;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < interactionRadius && dist > 0) {
          const force = (interactionRadius - dist) / interactionRadius;
          const angle = Math.atan2(dy, dx);
          const push = force * 2.2;
          p.vx += Math.cos(angle) * push;
          p.vy += Math.sin(angle) * push;
        }

        // Friction damping
        p.vx *= 0.96;
        p.vy *= 0.96;

        // Wrap around boundaries
        if (p.x < -30) p.x = this.width + 30;
        if (p.x > this.width + 30) p.x = -30;
        if (p.y < -30) p.y = this.height + 30;
        if (p.y > this.height + 30) p.y = -30;

        // Draw sprite
        this.ctx.save();
        this.ctx.globalAlpha = p.alpha;
        this.ctx.translate(p.x, p.y);
        this.ctx.rotate(p.rotation);
        const s = p.scale * p.depth;
        this.ctx.scale(s, s);
        this.ctx.drawImage(p.sprite, -24, -24);
        this.ctx.restore();
      }

      this.animationFrameId = requestAnimationFrame(() => this.loop());
    }
  }

  /* ========================================================
     2. COURSES INTERACTIVE MORPHING (34 - 45s IN REFERENCE VIDEO)
     ======================================================== */
  class CoursesMorphSystem {
    constructor() {
      this.canvas = document.getElementById('coursesMorphCanvas');
      if (!this.canvas) return;

      this.ctx = this.canvas.getContext('2d');
      this.section = document.getElementById('khoa-hoc-chinh');
      this.cardPro = document.getElementById('cardCoursePro');
      this.cardPersonal = document.getElementById('cardCoursePersonal');

      this.state = 'idle'; // 'idle', 'pro', 'personal'
      this.particles = [];
      this.particleCount = window.innerWidth < 768 ? 140 : 260;
      this.isRunning = !prefersReducedMotion;
      this.isInView = true;
      this.animationFrameId = null;

      this.init();
    }

    init() {
      this.resize();
      window.addEventListener('resize', () => {
        this.resize();
        this.calculateCardBounds();
        this.updateTargets();
      }, { passive: true });

      // Create morph particles
      const shapes = ['capsule', 'circle', 'diamond'];
      for (let i = 0; i < this.particleCount; i++) {
        const color = PALETTE[i % PALETTE.length];
        const shape = shapes[i % shapes.length];
        const baseX = Math.random() * this.width;
        const baseY = Math.random() * this.height;

        this.particles.push({
          index: i,
          x: baseX,
          y: baseY,
          vx: 0,
          vy: 0,
          targetX: baseX,
          targetY: baseY,
          baseX: baseX,
          baseY: baseY,
          rotation: Math.random() * Math.PI * 2,
          rotSpeed: (Math.random() - 0.5) * 0.02,
          scale: Math.random() * 0.4 + 0.65,
          depth: Math.random() * 0.5 + 0.5,
          alpha: Math.random() * 0.5 + 0.4,
          sprite: getSprite(color, shape),
          idlePhase: Math.random() * Math.PI * 2
        });
      }

      this.calculateCardBounds();

      // Card hover/focus interactions
      if (this.cardPro) {
        const setPro = () => {
          this.state = 'pro';
          this.cardPro.classList.add('is-active');
          if (this.cardPersonal) this.cardPersonal.classList.remove('is-active');
          this.updateTargets();
        };
        this.cardPro.addEventListener('mouseenter', setPro);
        this.cardPro.addEventListener('focusin', setPro);
      }

      if (this.cardPersonal) {
        const setPersonal = () => {
          this.state = 'personal';
          this.cardPersonal.classList.add('is-active');
          if (this.cardPro) this.cardPro.classList.remove('is-active');
          this.updateTargets();
        };
        this.cardPersonal.addEventListener('mouseenter', setPersonal);
        this.cardPersonal.addEventListener('focusin', setPersonal);
      }

      // Leaving section or both cards resets to ambient idle
      if (this.section) {
        this.section.addEventListener('mouseleave', () => {
          this.state = 'idle';
          if (this.cardPro) this.cardPro.classList.remove('is-active');
          if (this.cardPersonal) this.cardPersonal.classList.remove('is-active');
          this.updateTargets();
        });
      }

      // Intersection Observer
      const observer = new IntersectionObserver((entries) => {
        this.isInView = entries[0].isIntersecting;
        if (this.isInView && this.isRunning && !this.animationFrameId) {
          this.loop();
        }
      }, { threshold: 0.05 });
      observer.observe(this.section);

      this.updateTargets();
      this.loop();
    }

    resize() {
      const dpr = Math.min(window.devicePixelRatio || 1, 2);
      this.width = this.canvas.parentElement.clientWidth;
      this.height = this.canvas.parentElement.clientHeight;

      this.canvas.width = this.width * dpr;
      this.canvas.height = this.height * dpr;
      this.canvas.style.width = `${this.width}px`;
      this.canvas.style.height = `${this.height}px`;

      this.ctx.setTransform(1, 0, 0, 1, 0, 0);
      this.ctx.scale(dpr, dpr);
    }

    calculateCardBounds() {
      if (!this.canvas) return;
      const canvasRect = this.canvas.getBoundingClientRect();

      if (this.cardPro) {
        const rect = this.cardPro.getBoundingClientRect();
        this.boundsPro = {
          x: rect.left - canvasRect.left,
          y: rect.top - canvasRect.top,
          w: rect.width,
          h: rect.height,
          cx: rect.left - canvasRect.left + rect.width / 2,
          cy: rect.top - canvasRect.top + rect.height / 2
        };
      }

      if (this.cardPersonal) {
        const rect = this.cardPersonal.getBoundingClientRect();
        this.boundsPersonal = {
          x: rect.left - canvasRect.left,
          y: rect.top - canvasRect.top,
          w: rect.width,
          h: rect.height,
          cx: rect.left - canvasRect.left + rect.width / 2,
          cy: rect.top - canvasRect.top + rect.height / 2
        };
      }
    }

    updateTargets() {
      this.calculateCardBounds();
      const total = this.particles.length;

      for (let i = 0; i < total; i++) {
        const p = this.particles[i];

        if (this.state === 'idle') {
          // Spread across ambient field
          p.targetX = p.baseX;
          p.targetY = p.baseY;
        } else if (this.state === 'pro') {
          // LEFT CARD: 4-Lobed Rounded Petal Frame around Card Pro
          if (this.boundsPro) {
            const { cx, cy, w, h } = this.boundsPro;
            if (i < total * 0.72) {
              const subTotal = Math.floor(total * 0.72);
              const angle = (i / subTotal) * Math.PI * 2;
              // 4-lobed clover contour hugging the card perimeter:
              const rx = (w / 2 + 38) * (1 + 0.16 * Math.cos(4 * angle));
              const ry = (h / 2 + 38) * (1 + 0.16 * Math.cos(4 * angle));
              p.targetX = cx + Math.cos(angle) * rx;
              p.targetY = cy + Math.sin(angle) * ry;
            } else {
              // Remaining particles disperse gently on the right half
              p.targetX = p.baseX;
              p.targetY = p.baseY;
            }
          }
        } else if (this.state === 'personal') {
          // RIGHT CARD: 6 Orbital Circular Clusters around Card Personal (Frame 35s in video)
          if (this.boundsPersonal) {
            const { cx, cy, w, h } = this.boundsPersonal;
            if (i < total * 0.78) {
              const subTotal = Math.floor(total * 0.78);
              const clusterCount = 6;
              const clusterIdx = i % clusterCount;
              const particlesPerCluster = Math.floor(subTotal / clusterCount);
              const localIdx = Math.floor(i / clusterCount);
              const localAngle = (localIdx / particlesPerCluster) * Math.PI * 2;

              // Exact 6 cluster center points hugging the outer boundary:
              let clusterCenterX = cx;
              let clusterCenterY = cy;
              const margin = 55;

              switch (clusterIdx) {
                case 0: // Top
                  clusterCenterX = cx;
                  clusterCenterY = cy - h / 2 - margin;
                  break;
                case 1: // Top-Right
                  clusterCenterX = cx + w / 2 + margin * 0.9;
                  clusterCenterY = cy - h / 4;
                  break;
                case 2: // Bottom-Right
                  clusterCenterX = cx + w / 2 + margin * 0.9;
                  clusterCenterY = cy + h / 4;
                  break;
                case 3: // Bottom
                  clusterCenterX = cx;
                  clusterCenterY = cy + h / 2 + margin;
                  break;
                case 4: // Bottom-Left
                  clusterCenterX = cx - w / 2 - margin * 0.9;
                  clusterCenterY = cy + h / 4;
                  break;
                case 5: // Top-Left
                  clusterCenterX = cx - w / 2 - margin * 0.9;
                  clusterCenterY = cy - h / 4;
                  break;
              }

              // Circular radius of each cluster (50px to 68px with depth variance)
              const clusterR = 50 + (p.depth * 18);
              p.targetX = clusterCenterX + Math.cos(localAngle) * clusterR;
              p.targetY = clusterCenterY + Math.sin(localAngle) * clusterR;
            } else {
              // Remaining particles disperse gently on the left half
              p.targetX = p.baseX;
              p.targetY = p.baseY;
            }
          }
        }
      }
    }

    loop() {
      if (!this.isRunning || !this.isInView) {
        this.animationFrameId = null;
        return;
      }

      this.ctx.clearRect(0, 0, this.width, this.height);

      const time = performance.now() * 0.001;

      for (let i = 0; i < this.particles.length; i++) {
        const p = this.particles[i];

        // Smooth spring physics toward target
        const dx = p.targetX - p.x;
        const dy = p.targetY - p.y;

        const spring = 0.045 * p.depth;
        p.vx += dx * spring;
        p.vy += dy * spring;

        // Subtle ambient jitter / oscillation for organic breathing feel
        p.vx += Math.sin(time * 1.5 + p.idlePhase) * 0.06;
        p.vy += Math.cos(time * 1.5 + p.idlePhase) * 0.06;

        // Damping
        p.vx *= 0.88;
        p.vy *= 0.88;

        p.x += p.vx;
        p.y += p.vy;
        p.rotation += p.rotSpeed;

        // Draw particle sprite
        this.ctx.save();
        this.ctx.globalAlpha = p.alpha;
        this.ctx.translate(p.x, p.y);
        this.ctx.rotate(p.rotation);
        const s = p.scale * p.depth;
        this.ctx.scale(s, s);
        this.ctx.drawImage(p.sprite, -24, -24);
        this.ctx.restore();
      }

      this.animationFrameId = requestAnimationFrame(() => this.loop());
    }
  }

  /* ========================================================
     3. GALLERY FILTERING (SECTION 2)
     ======================================================== */
  function initGalleryFilters() {
    const filterPills = document.querySelectorAll('.filter-pill');
    const items = document.querySelectorAll('.curated-mosaic .mosaic-item');

    if (!filterPills.length || !items.length) return;

    filterPills.forEach((pill) => {
      pill.addEventListener('click', () => {
        filterPills.forEach((p) => {
          p.classList.remove('active');
          p.setAttribute('aria-selected', 'false');
        });
        pill.classList.add('active');
        pill.setAttribute('aria-selected', 'true');

        const filter = pill.getAttribute('data-filter');

        items.forEach((item) => {
          const category = item.getAttribute('data-category');
          if (filter === 'all' || category === filter) {
            item.style.display = '';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  /* ========================================================
     4. FAQ ACCORDION (SECTION 6)
     ======================================================== */
  function initFaqAccordion() {
    const triggers = document.querySelectorAll('.faq-trigger');

    triggers.forEach((trigger) => {
      trigger.addEventListener('click', () => {
        const item = trigger.closest('.faq-item');
        const isOpen = item.classList.contains('open');

        // Close all items
        document.querySelectorAll('.faq-item').forEach((i) => {
          i.classList.remove('open');
          const t = i.querySelector('.faq-trigger');
          if (t) t.setAttribute('aria-expanded', 'false');
        });

        // Toggle clicked
        if (!isOpen) {
          item.classList.add('open');
          trigger.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  /* ========================================================
     5. MOBILE DRAWER NAVIGATION
     ======================================================== */
  function initMobileDrawer() {
    const toggle = document.getElementById('mobileToggle');
    const drawer = document.getElementById('mobileDrawer');
    const closeBtn = document.getElementById('drawerClose');
    const overlay = document.getElementById('drawerOverlay');
    const drawerLinks = document.querySelectorAll('.drawer-link, .btn-block-consult');

    if (!toggle || !drawer) return;

    const openDrawer = () => {
      drawer.classList.add('open');
      drawer.setAttribute('aria-hidden', 'false');
      toggle.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    };

    const closeDrawer = () => {
      drawer.classList.remove('open');
      drawer.setAttribute('aria-hidden', 'true');
      toggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    };

    toggle.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    drawerLinks.forEach((link) => {
      link.addEventListener('click', closeDrawer);
    });
  }

  /* ========================================================
     6. PROTOTYPE FORM SIMULATION & PRE-SELECT BUTTONS
     ======================================================== */
  function initPrototypeForm() {
    const form = document.getElementById('prototypeLeadForm');
    const successNotice = document.getElementById('formSuccessNotice');
    const courseSelect = document.getElementById('leadCourseSelect');

    // Pre-select buttons from Course Cards
    const preSelectButtons = document.querySelectorAll('[data-course-select]');
    preSelectButtons.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        const courseName = btn.getAttribute('data-course-select');
        if (courseSelect && courseName) {
          for (let i = 0; i < courseSelect.options.length; i++) {
            if (courseSelect.options[i].value === courseName) {
              courseSelect.selectedIndex = i;
              break;
            }
          }
        }
      });
    });

    if (!form || !successNotice) return;

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const name = document.getElementById('leadFullName').value.trim() || 'Học viên';
      const phone = document.getElementById('leadPhone').value.trim() || '088 997 97 91';
      const course = courseSelect ? courseSelect.value : 'Khóa Học';

      document.getElementById('mockName').textContent = name;
      document.getElementById('mockPhone').textContent = phone;
      document.getElementById('mockCourse').textContent = course;

      successNotice.classList.add('show');
      successNotice.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
  }

  /* ========================================================
     BOOTSTRAP ON DOM READY
     ======================================================== */
  document.addEventListener('DOMContentLoaded', () => {
    new HeroParticleSystem();
    new CoursesMorphSystem();
    initGalleryFilters();
    initFaqAccordion();
    initMobileDrawer();
    initPrototypeForm();
  });

})();

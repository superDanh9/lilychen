/**
 * Lily Chen Makeup Academy - Interactive Logic & Particle Morphing Engine
 * Direction: High-fashion Editorial, Clean Open Space, Celestial Stardust Particles
 * Pure Vanilla JavaScript - WCAG Accessible, Core Web Vitals & Performance Optimized
 *
 * Modules:
 * 1. Rhythmic Word Reveal (Progressive Enhancement)
 * 2. Homepage Hero Ambient Stardust Particle Field (No lines, pure floating nodes)
 * 3. Dual Courses Morphing Particle System (Antigravity-inspired morphing shapes)
 * 4. Ambient Header Canvases (Portfolio, Blog & Article Pages)
 * 5. Scroll Reveal Rhythm (Staggered Content Flow)
 * 6. Sticky Glassmorphism Header
 * 7. Mobile Navigation Drawer
 * 8. Smooth Anchor Scrolling with Header Offset
 * 9. Category Filter Tabs for Gallery & Blog
 * 10. FAQ Accordion Expanding Logic
 * 11. Lead Consultation Form Validation & Feedback
 */

(function () {
  'use strict';

  // Clean up legacy localStorage motion disable flag from earlier iterations
  try {
    localStorage.removeItem('lily_motion_disabled');
  } catch (e) {}

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ---------------------------------------------------------------------------
  // 1. Rhythmic Staggered Word Reveal
  // ---------------------------------------------------------------------------
  function initTextReveal() {
    const hasRevealWords = document.querySelector('.reveal-word');
    if (!hasRevealWords) return;

    if (!prefersReducedMotion) {
      document.body.classList.add('js-reveal-ready');
    }
  }

  // ---------------------------------------------------------------------------
  // 2. Homepage Hero Ambient Stardust Canvas
  // ---------------------------------------------------------------------------
  function initHeroParticleCanvas() {
    const canvas = document.getElementById('particleCanvas');
    const heroSection = document.getElementById('hero') || document.querySelector('.hero-section');
    if (!canvas || !heroSection) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let width = 0;
    let height = 0;
    let dpr = 1;
    let particles = [];
    let animationFrameId = null;
    let isVisible = true;
    let isTabActive = true;

    const mouse = {
      x: -9999,
      y: -9999,
      active: false,
      radius: 130
    };

    function getCount(w) {
      if (w < 768) return 24;
      if (w < 1200) return 40;
      return 56;
    }

    class StardustParticle {
      constructor() {
        this.reset(true);
      }

      reset(initial = false) {
        this.x = initial ? Math.random() * width : (Math.random() > 0.5 ? 0 : width);
        this.y = initial ? Math.random() * height : Math.random() * height;

        const angle = Math.random() * Math.PI * 2;
        const speed = 0.18 + Math.random() * 0.28;
        this.baseVx = Math.cos(angle) * speed;
        this.baseVy = Math.sin(angle) * speed;
        this.vx = this.baseVx;
        this.vy = this.baseVy;

        this.radius = 1.3 + Math.random() * 1.5;
        this.isRose = Math.random() > 0.35;
        this.alpha = 0.22 + Math.random() * 0.32;
        this.phase = Math.random() * Math.PI * 2;
        this.phaseSpeed = 0.012 + Math.random() * 0.016;
      }

      update() {
        this.phase += this.phaseSpeed;
        const wobbleX = Math.cos(this.phase) * 0.16;
        const wobbleY = Math.sin(this.phase) * 0.16;

        if (mouse.active) {
          const dx = this.x - mouse.x;
          const dy = this.y - mouse.y;
          const dist = Math.hypot(dx, dy);

          if (dist < mouse.radius && dist > 1) {
            const nx = dx / dist;
            const ny = dy / dist;
            const force = (1 - dist / mouse.radius) * 0.85;
            this.vx += nx * force * 1.2;
            this.vy += ny * force * 1.2;
          }
        }

        this.vx *= 0.94;
        this.vy *= 0.94;
        this.vx += (this.baseVx - this.vx) * 0.025;
        this.vy += (this.baseVy - this.vy) * 0.025;

        this.x += this.vx + wobbleX;
        this.y += this.vy + wobbleY;

        const pad = 20;
        if (this.x < -pad) this.x = width + pad;
        else if (this.x > width + pad) this.x = -pad;
        if (this.y < -pad) this.y = height + pad;
        else if (this.y > height + pad) this.y = -pad;
      }

      draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        if (this.isRose) {
          ctx.fillStyle = `rgba(212, 83, 122, ${this.alpha})`;
        } else {
          ctx.fillStyle = `rgba(185, 168, 172, ${this.alpha * 0.9})`;
        }
        ctx.fill();
      }
    }

    function resize() {
      const rect = heroSection.getBoundingClientRect();
      width = rect.width;
      height = rect.height;
      dpr = Math.min(window.devicePixelRatio || 1, 2);

      canvas.width = Math.floor(width * dpr);
      canvas.height = Math.floor(height * dpr);
      canvas.style.width = width + 'px';
      canvas.style.height = height + 'px';

      ctx.scale(dpr, dpr);

      const targetCount = getCount(width);
      particles = [];
      for (let i = 0; i < targetCount; i++) {
        particles.push(new StardustParticle());
      }

      if (prefersReducedMotion) {
        drawFrame();
      }
    }

    function drawFrame() {
      ctx.clearRect(0, 0, width, height);
      for (let i = 0; i < particles.length; i++) {
        particles[i].draw();
      }
    }

    function loop() {
      if (prefersReducedMotion || !isVisible || !isTabActive) {
        animationFrameId = null;
        return;
      }

      ctx.clearRect(0, 0, width, height);
      for (let i = 0; i < particles.length; i++) {
        particles[i].update();
        particles[i].draw();
      }

      animationFrameId = requestAnimationFrame(loop);
    }

    function startLoop() {
      if (!animationFrameId && !prefersReducedMotion && isVisible && isTabActive) {
        animationFrameId = requestAnimationFrame(loop);
      }
    }

    function stopLoop() {
      if (animationFrameId) {
        cancelAnimationFrame(animationFrameId);
        animationFrameId = null;
      }
    }

    // Passive interaction
    window.addEventListener('mousemove', e => {
      const rect = heroSection.getBoundingClientRect();
      if (e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom) {
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
        mouse.active = true;
      } else {
        mouse.active = false;
      }
    }, { passive: true });

    window.addEventListener('mouseleave', () => {
      mouse.active = false;
    });

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          isVisible = entry.isIntersecting;
          if (isVisible) startLoop();
          else stopLoop();
        });
      }, { threshold: 0.05 });
      observer.observe(heroSection);
    }

    document.addEventListener('visibilitychange', () => {
      isTabActive = !document.hidden;
      if (isTabActive) startLoop();
      else stopLoop();
    });

    let resizeTimer = null;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(resize, 150);
    }, { passive: true });

    resize();
    if (!prefersReducedMotion) {
      startLoop();
    }
  }

  // ---------------------------------------------------------------------------
  // 3. Dual Courses Morphing Particle System (Antigravity-Inspired Engine)
  // ---------------------------------------------------------------------------
  function initCoursesMorphingParticles() {
    const cluster = document.getElementById('coursesInteractiveCluster');
    const canvas = document.getElementById('coursesMorphCanvas');
    if (!cluster || !canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const sectionPro = document.getElementById('khoa-hoc') || document.querySelector('[data-course-id="pro"]');
    const sectionPersonal = document.getElementById('khoa-ca-nhan') || document.querySelector('[data-course-id="personal"]');

    let width = 0;
    let height = 0;
    let dpr = 1;
    let particles = [];
    let animationFrameId = null;
    let isClusterVisible = true;
    let isTabActive = true;
    let currentState = 'idle'; // 'idle' | 'pro' | 'personal'
    let time = 0;

    function getParticleCount(w) {
      if (w < 768) return 120;
      if (w < 1200) return 200;
      return 260;
    }

    class MorphParticle {
      constructor(index, total) {
        this.index = index;
        this.total = total;
        this.seed = Math.random() * 1000;
        this.speed = 0.6 + Math.random() * 0.8;
        this.size = 1.3 + Math.random() * 1.5;

        // Base ambient coordinates (jittered grid)
        this.baseX = Math.random() * (width || 800);
        this.baseY = Math.random() * (height || 1200);

        this.x = this.baseX;
        this.y = this.baseY;
        this.targetX = this.baseX;
        this.targetY = this.baseY;

        this.alpha = 0.25;
        this.targetAlpha = 0.25;
        this.r = 185;
        this.g = 168;
        this.b = 172;
        this.targetR = 185;
        this.targetG = 168;
        this.targetB = 172;
      }

      repositionBase() {
        const cols = Math.floor(Math.sqrt(this.total * (width / Math.max(height, 1))));
        const col = this.index % Math.max(cols, 1);
        const row = Math.floor(this.index / Math.max(cols, 1));
        const cellW = width / Math.max(cols, 1);
        const cellH = height / Math.max(Math.ceil(this.total / Math.max(cols, 1)), 1);

        this.baseX = col * cellW + Math.random() * cellW;
        this.baseY = row * cellH + Math.random() * cellH;
      }

      computeTargets(state, now) {
        if (state === 'pro' && sectionPro) {
          // Shape 1: Celestial Crown & Editorial Arch (Professional Course)
          const clusterRect = cluster.getBoundingClientRect();
          const proVisual = sectionPro.querySelector('.course-open-visual') || sectionPro;
          const proRect = proVisual.getBoundingClientRect();

          const cx = (proRect.left + proRect.width / 2) - clusterRect.left;
          const cy = (proRect.top + proRect.height / 2) - clusterRect.top;
          const halfW = proRect.width / 2;
          const halfH = proRect.height / 2;

          this.targetAlpha = 0.88;
          this.targetR = 212;
          this.targetG = 83;
          this.targetB = 122;

          if (this.index < this.total * 0.52) {
            // Couture Flanking Arches framing the photo
            const t = this.index / (this.total * 0.52);
            const side = this.index % 2 === 0 ? 1 : -1;
            const phi = (t - 0.5) * Math.PI * 0.92;
            const archOffset = halfW + 28 + Math.sin(phi) * 22;
            this.targetX = cx + side * archOffset + Math.cos(now * 0.002 + this.index * 0.15) * 3.5;
            this.targetY = cy + Math.sin(phi) * (halfH * 0.95) + Math.sin(now * 0.002 + this.index * 0.15) * 3.5;
          } else {
            // Celestial Apex Crown hovering above the photo
            const t = (this.index - this.total * 0.52) / (this.total * 0.48);
            const theta = -Math.PI * 0.85 + t * (Math.PI * 0.7);
            const crownCenterY = cy - halfH - 24;
            const crownR = (halfW * 0.7) * (1 + 0.15 * Math.cos(5 * theta));
            this.targetX = cx + Math.cos(theta) * crownR + Math.cos(now * 0.0025 + theta * 3) * 3;
            this.targetY = crownCenterY + Math.sin(theta) * (crownR * 0.65) + Math.sin(now * 0.0025 + theta * 3) * 3;
          }

        } else if (state === 'personal' && sectionPersonal) {
          // Shape 2: The Radiant Bloom / 5-Petal Lotus (Personal Course)
          const clusterRect = cluster.getBoundingClientRect();
          const persVisual = sectionPersonal.querySelector('.course-open-visual') || sectionPersonal;
          const persRect = persVisual.getBoundingClientRect();

          const cx = (persRect.left + persRect.width / 2) - clusterRect.left;
          const cy = (persRect.top + persRect.height / 2) - clusterRect.top;
          const baseRadius = Math.max(persRect.width, persRect.height) * 0.54 + 20;

          this.targetAlpha = 0.86;
          this.targetR = 224;
          this.targetG = 102;
          this.targetB = 140;

          if (this.index < this.total * 0.72) {
            // 5-Petal Rhodonea Curve unfurling around the portrait
            const theta = (this.index / (this.total * 0.72)) * Math.PI * 2;
            const r = baseRadius * (0.76 + 0.32 * Math.cos(5 * theta));
            const breath = Math.sin(now * 0.002 + theta * 5) * 4.5;
            this.targetX = cx + Math.cos(theta) * (r + breath);
            this.targetY = cy + Math.sin(theta) * (r + breath);
          } else {
            // Inner Pistil Stardust Halo
            const theta = ((this.index - this.total * 0.72) / (this.total * 0.28)) * Math.PI * 2;
            const r = baseRadius * 0.44 * (1 + 0.12 * Math.sin(5 * theta));
            const breath = Math.cos(now * 0.0025 + theta * 3) * 2.5;
            this.targetX = cx + Math.cos(theta) * (r + breath);
            this.targetY = cy + Math.sin(theta) * (r + breath);
          }

        } else {
          // Ambient State (Natural Drift when mouse stationary or idle)
          const driftX = Math.sin(now * 0.0009 + this.seed) * 14;
          const driftY = Math.cos(now * 0.0011 + this.seed * 1.3) * 14;
          this.targetX = this.baseX + driftX;
          this.targetY = this.baseY + driftY;
          this.targetAlpha = 0.24;
          this.targetR = 185;
          this.targetG = 168;
          this.targetB = 172;
        }
      }

      update(state, now) {
        this.computeTargets(state, now);

        // Smooth physics-based interpolation (lerp factor 0.055)
        this.x += (this.targetX - this.x) * 0.055;
        this.y += (this.targetY - this.y) * 0.055;
        this.alpha += (this.targetAlpha - this.alpha) * 0.055;
        this.r += (this.targetR - this.r) * 0.055;
        this.g += (this.targetG - this.g) * 0.055;
        this.b += (this.targetB - this.b) * 0.055;
      }

      draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(${Math.round(this.r)}, ${Math.round(this.g)}, ${Math.round(this.b)}, ${this.alpha})`;
        ctx.fill();

        // If morphed, add subtle radiant shimmer to selected nodal particles
        if (this.alpha > 0.5 && this.index % 4 === 0) {
          ctx.beginPath();
          ctx.arc(this.x, this.y, this.size * 2.2, 0, Math.PI * 2);
          ctx.fillStyle = `rgba(${Math.round(this.r)}, ${Math.round(this.g)}, ${Math.round(this.b)}, ${this.alpha * 0.22})`;
          ctx.fill();
        }
      }
    }

    function resize() {
      const rect = cluster.getBoundingClientRect();
      width = rect.width;
      height = rect.height;
      dpr = Math.min(window.devicePixelRatio || 1, 2);

      canvas.width = Math.floor(width * dpr);
      canvas.height = Math.floor(height * dpr);
      canvas.style.width = width + 'px';
      canvas.style.height = height + 'px';

      ctx.scale(dpr, dpr);

      const targetCount = getParticleCount(width);
      particles = [];
      for (let i = 0; i < targetCount; i++) {
        const p = new MorphParticle(i, targetCount);
        p.repositionBase();
        particles.push(p);
      }

      if (prefersReducedMotion) {
        drawFrame();
      }
    }

    function drawFrame() {
      ctx.clearRect(0, 0, width, height);
      for (let i = 0; i < particles.length; i++) {
        particles[i].draw();
      }
    }

    function loop() {
      if (prefersReducedMotion || !isClusterVisible || !isTabActive) {
        animationFrameId = null;
        return;
      }

      time = performance.now();
      ctx.clearRect(0, 0, width, height);

      for (let i = 0; i < particles.length; i++) {
        particles[i].update(currentState, time);
        particles[i].draw();
      }

      animationFrameId = requestAnimationFrame(loop);
    }

    function startLoop() {
      if (!animationFrameId && !prefersReducedMotion && isClusterVisible && isTabActive) {
        animationFrameId = requestAnimationFrame(loop);
      }
    }

    function stopLoop() {
      if (animationFrameId) {
        cancelAnimationFrame(animationFrameId);
        animationFrameId = null;
      }
    }

    // Interaction Listeners on Course Sections
    function handlePointer(e) {
      if (!sectionPro || !sectionPersonal) return;
      const proRect = sectionPro.getBoundingClientRect();
      const persRect = sectionPersonal.getBoundingClientRect();

      const inPro = e.clientY >= proRect.top && e.clientY <= proRect.bottom;
      const inPers = e.clientY >= persRect.top && e.clientY <= persRect.bottom;

      if (inPro) {
        currentState = 'pro';
      } else if (inPers) {
        currentState = 'personal';
      } else {
        currentState = 'idle';
      }
    }

    cluster.addEventListener('mousemove', handlePointer, { passive: true });
    cluster.addEventListener('mouseleave', () => {
      currentState = 'idle';
    });

    // Direct enter/move listeners on individual course sections
    if (sectionPro) {
      sectionPro.addEventListener('mouseenter', () => { currentState = 'pro'; });
      sectionPro.addEventListener('mousemove', () => { currentState = 'pro'; }, { passive: true });
      sectionPro.addEventListener('focusin', () => { currentState = 'pro'; });
      sectionPro.addEventListener('focusout', () => { currentState = 'idle'; });
    }
    if (sectionPersonal) {
      sectionPersonal.addEventListener('mouseenter', () => { currentState = 'personal'; });
      sectionPersonal.addEventListener('mousemove', () => { currentState = 'personal'; }, { passive: true });
      sectionPersonal.addEventListener('focusin', () => { currentState = 'personal'; });
      sectionPersonal.addEventListener('focusout', () => { currentState = 'idle'; });
    }

    // Mobile Viewport Observer (Activates gentle shape when scrolled into view)
    if ('IntersectionObserver' in window && window.innerWidth <= 768) {
      const mobileObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            if (entry.target === sectionPro) currentState = 'pro';
            else if (entry.target === sectionPersonal) currentState = 'personal';
          }
        });
      }, { threshold: 0.45 });

      if (sectionPro) mobileObserver.observe(sectionPro);
      if (sectionPersonal) mobileObserver.observe(sectionPersonal);
    }

    // Visibility Observer for RAF loop pausing
    if ('IntersectionObserver' in window) {
      const clusterObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          isClusterVisible = entry.isIntersecting;
          if (isClusterVisible) startLoop();
          else stopLoop();
        });
      }, { threshold: 0.05 });
      clusterObserver.observe(cluster);
    }

    document.addEventListener('visibilitychange', () => {
      isTabActive = !document.hidden;
      if (isTabActive) startLoop();
      else stopLoop();
    });

    let resizeTimer = null;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(resize, 150);
    }, { passive: true });

    resize();
    window.coursesMorphSystem = {
      getActiveTarget: () => currentState,
      getParticleCount: () => particles.length
    };
    if (!prefersReducedMotion) {
      startLoop();
    }
  }

  // ---------------------------------------------------------------------------
  // 4. Ambient Header Stardust Canvases (Portfolio, Blog & 14 Articles)
  // ---------------------------------------------------------------------------
  function initAmbientHeaderCanvases() {
    const headerCanvases = document.querySelectorAll('.page-hero-canvas, .article-hero-canvas');
    if (!headerCanvases.length) return;

    headerCanvases.forEach(canvas => {
      const parent = canvas.parentElement;
      if (!parent) return;

      const ctx = canvas.getContext('2d');
      if (!ctx) return;

      let width = 0;
      let height = 0;
      let dpr = 1;
      let particles = [];
      let animationFrameId = null;
      let isVisible = true;
      let isTabActive = true;

      function resize() {
        const rect = parent.getBoundingClientRect();
        width = rect.width;
        height = rect.height;
        dpr = Math.min(window.devicePixelRatio || 1, 2);

        canvas.width = Math.floor(width * dpr);
        canvas.height = Math.floor(height * dpr);
        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';

        ctx.scale(dpr, dpr);

        const count = width < 768 ? 16 : 28;
        particles = [];
        for (let i = 0; i < count; i++) {
          particles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: 1.2 + Math.random() * 1.4,
            alpha: 0.2 + Math.random() * 0.25,
            isRose: Math.random() > 0.4,
            phase: Math.random() * Math.PI * 2,
            phaseSpeed: 0.01 + Math.random() * 0.015,
            vx: (Math.random() - 0.5) * 0.25,
            vy: (Math.random() - 0.5) * 0.25
          });
        }

        if (prefersReducedMotion) {
          drawFrame();
        }
      }

      function drawFrame() {
        ctx.clearRect(0, 0, width, height);
        particles.forEach(p => {
          ctx.beginPath();
          ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
          ctx.fillStyle = p.isRose
            ? `rgba(212, 83, 122, ${p.alpha})`
            : `rgba(185, 168, 172, ${p.alpha * 0.85})`;
          ctx.fill();
        });
      }

      function loop() {
        if (prefersReducedMotion || !isVisible || !isTabActive) {
          animationFrameId = null;
          return;
        }

        ctx.clearRect(0, 0, width, height);
        particles.forEach(p => {
          p.phase += p.phaseSpeed;
          p.x += p.vx + Math.cos(p.phase) * 0.15;
          p.y += p.vy + Math.sin(p.phase) * 0.15;

          if (p.x < -10) p.x = width + 10;
          else if (p.x > width + 10) p.x = -10;
          if (p.y < -10) p.y = height + 10;
          else if (p.y > height + 10) p.y = -10;

          ctx.beginPath();
          ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
          ctx.fillStyle = p.isRose
            ? `rgba(212, 83, 122, ${p.alpha})`
            : `rgba(185, 168, 172, ${p.alpha * 0.85})`;
          ctx.fill();
        });

        animationFrameId = requestAnimationFrame(loop);
      }

      function startLoop() {
        if (!animationFrameId && !prefersReducedMotion && isVisible && isTabActive) {
          animationFrameId = requestAnimationFrame(loop);
        }
      }

      function stopLoop() {
        if (animationFrameId) {
          cancelAnimationFrame(animationFrameId);
          animationFrameId = null;
        }
      }

      if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(entries => {
          entries.forEach(entry => {
            isVisible = entry.isIntersecting;
            if (isVisible) startLoop();
            else stopLoop();
          });
        }, { threshold: 0.05 });
        observer.observe(parent);
      }

      document.addEventListener('visibilitychange', () => {
        isTabActive = !document.hidden;
        if (isTabActive) startLoop();
        else stopLoop();
      });

      let timer = null;
      window.addEventListener('resize', () => {
        clearTimeout(timer);
        timer = setTimeout(resize, 150);
      }, { passive: true });

      resize();
      if (!prefersReducedMotion) {
        startLoop();
      }
    });
  }

  // ---------------------------------------------------------------------------
  // 5. Scroll Reveal Rhythm (Once per load, failsafe ensured)
  // ---------------------------------------------------------------------------
  function initScrollReveal() {
    if (prefersReducedMotion) return;

    const revealTargets = document.querySelectorAll(
      '.course-open-section, .photo-mosaic, .gallery-grid, .activity-mosaic, .instructor-grid, .testimonials-grid, .blog-grid, .faq-accordion, .conversion-grid'
    );

    if (!revealTargets.length) return;

    revealTargets.forEach(el => {
      el.classList.add('reveal-group');
    });

    if ('IntersectionObserver' in window) {
      const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
      });

      revealTargets.forEach(el => revealObserver.observe(el));
    } else {
      revealTargets.forEach(el => el.classList.add('is-revealed'));
    }

    // Failsafe: reveal everything after 1.5s if not triggered
    setTimeout(() => {
      revealTargets.forEach(el => el.classList.add('is-revealed'));
    }, 1500);
  }

  // ---------------------------------------------------------------------------
  // 6. Header Scroll Effect
  // ---------------------------------------------------------------------------
  function initHeaderScroll() {
    const header = document.getElementById('siteHeader') || document.querySelector('.site-header');
    if (!header) return;

    function handleScroll() {
      if (window.scrollY > 24) {
        header.classList.add('is-scrolled');
        header.classList.add('scrolled');
      } else {
        header.classList.remove('is-scrolled');
        header.classList.remove('scrolled');
      }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  // ---------------------------------------------------------------------------
  // 7. Mobile Navigation Drawer
  // ---------------------------------------------------------------------------
  function initMobileDrawer() {
    const toggleBtn = document.getElementById('mobileToggle');
    const drawer = document.getElementById('mobileDrawer');
    const closeBtn = document.getElementById('drawerClose');
    const backdrop = document.getElementById('drawerBackdrop');
    if (!toggleBtn || !drawer) return;

    function openDrawer() {
      drawer.classList.add('is-open');
      drawer.classList.add('open');
      toggleBtn.classList.add('active');
      toggleBtn.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
      if (closeBtn) closeBtn.focus();
    }

    function closeDrawer() {
      drawer.classList.remove('is-open');
      drawer.classList.remove('open');
      toggleBtn.classList.remove('active');
      toggleBtn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
      toggleBtn.focus();
    }

    toggleBtn.addEventListener('click', () => {
      const isOpen = drawer.classList.contains('is-open') || drawer.classList.contains('open');
      if (isOpen) closeDrawer();
      else openDrawer();
    });

    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (backdrop) backdrop.addEventListener('click', closeDrawer);

    window.addEventListener('keydown', e => {
      if (e.key === 'Escape' && (drawer.classList.contains('is-open') || drawer.classList.contains('open'))) {
        closeDrawer();
      }
    });

    const drawerLinks = drawer.querySelectorAll('a');
    drawerLinks.forEach(link => {
      link.addEventListener('click', () => {
        closeDrawer();
      });
    });
  }

  // ---------------------------------------------------------------------------
  // 8. Smooth Anchor Scrolling with Header Offset
  // ---------------------------------------------------------------------------
  function initSmoothAnchorScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === '#' || !href) return;

        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          const header = document.querySelector('.site-header') || document.querySelector('.proto-header');
          const headerHeight = header ? header.offsetHeight : 72;
          const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 16;

          window.scrollTo({
            top: targetPosition,
            behavior: prefersReducedMotion ? 'instant' : 'smooth'
          });

          if (history.pushState) {
            history.pushState(null, null, href);
          }
        }
      });
    });
  }

  // ---------------------------------------------------------------------------
  // 9. Category Filter Tabs for Gallery & Blog
  // ---------------------------------------------------------------------------
  function initCategoryFilters() {
    // Gallery filter
    const galleryButtons = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    if (galleryButtons.length && galleryItems.length) {
      galleryButtons.forEach(btn => {
        btn.addEventListener('click', function () {
          galleryButtons.forEach(b => b.classList.remove('active'));
          this.classList.add('active');

          const filter = this.getAttribute('data-filter');
          galleryItems.forEach(item => {
            const cat = item.getAttribute('data-category');
            if (filter === 'all' || cat === filter) {
              item.style.display = '';
              item.style.opacity = '1';
            } else {
              item.style.display = 'none';
            }
          });
        });
      });
    }

    // Blog filter
    const blogButtons = document.querySelectorAll('.blog-filter-btn');
    const blogCards = document.querySelectorAll('.blog-grid .blog-card');

    if (blogButtons.length && blogCards.length) {
      blogButtons.forEach(btn => {
        btn.addEventListener('click', function () {
          blogButtons.forEach(b => b.classList.remove('active'));
          this.classList.add('active');

          const filter = this.getAttribute('data-filter');
          blogCards.forEach(card => {
            const cat = card.getAttribute('data-category');
            if (filter === 'all' || cat === filter) {
              card.style.display = '';
            } else {
              card.style.display = 'none';
            }
          });
        });
      });
    }
  }

  // ---------------------------------------------------------------------------
  // 10. FAQ Accordion Expanding Logic
  // ---------------------------------------------------------------------------
  function initFaqAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');
    if (!faqItems.length) return;

    faqItems.forEach(item => {
      const questionBtn = item.querySelector('.faq-question');
      const answer = item.querySelector('.faq-answer');
      if (!questionBtn || !answer) return;

      questionBtn.addEventListener('click', () => {
        const isActive = item.classList.contains('active');

        // Close other items
        faqItems.forEach(other => {
          if (other !== item && other.classList.contains('active')) {
            other.classList.remove('active');
            const otherBtn = other.querySelector('.faq-question');
            const otherAns = other.querySelector('.faq-answer');
            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
            if (otherAns) otherAns.style.maxHeight = null;
          }
        });

        // Toggle current item
        if (isActive) {
          item.classList.remove('active');
          questionBtn.setAttribute('aria-expanded', 'false');
          answer.style.maxHeight = null;
        } else {
          item.classList.add('active');
          questionBtn.setAttribute('aria-expanded', 'true');
          answer.style.maxHeight = answer.scrollHeight + 'px';
        }
      });
    });
  }

  // ---------------------------------------------------------------------------
  // 11. Lead Consultation Form Validation & Feedback
  // ---------------------------------------------------------------------------
  function initLeadForm() {
    const form = document.getElementById('leadForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const nameInput = document.getElementById('leadName');
      const phoneInput = document.getElementById('leadPhone');
      const courseSelect = document.getElementById('leadCourse');
      let isValid = true;

      // Reset errors
      [nameInput, phoneInput, courseSelect].forEach(input => {
        if (input) input.classList.remove('is-invalid');
      });

      if (!nameInput || !nameInput.value.trim()) {
        if (nameInput) nameInput.classList.add('is-invalid');
        isValid = false;
      }

      const phoneRegex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
      if (!phoneInput || !phoneRegex.test(phoneInput.value.trim().replace(/\s+/g, ''))) {
        if (phoneInput) phoneInput.classList.add('is-invalid');
        isValid = false;
      }

      if (!courseSelect || !courseSelect.value) {
        if (courseSelect) courseSelect.classList.add('is-invalid');
        isValid = false;
      }

      if (!isValid) return;

      // Known project state: UI feedback provided, backend endpoint to be configured
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalText = submitBtn ? submitBtn.innerHTML : '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Đang gửi thông tin...</span>';
      }

      setTimeout(() => {
        form.innerHTML = `
          <div class="form-success-message" style="text-align: center; padding: 32px 16px;">
            <div style="width: 56px; height: 56px; border-radius: 50%; background: #e8f5e9; color: #2e7d32; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
            </div>
            <h4 style="font-size: 1.3rem; margin-bottom: 8px; color: var(--text-primary);">Đã Tiếp Nhận Thông Tin!</h4>
            <p style="color: var(--text-secondary); font-size: 0.95rem; line-height: 1.6; margin-bottom: 18px;">
              Cảm ơn bạn. Master Lily Chen sẽ liên hệ qua số điện thoại/Zalo để tư vấn lộ trình học phù hợp nhất cho bạn trong vòng 24 giờ.
            </p>
            <p style="font-size: 0.85rem; color: var(--text-muted);">
              Cần trao đổi gấp? Gọi ngay hotline: <a href="tel:0889979791" style="color: var(--color-rose); font-weight: 700;">088 997 97 91</a>
            </p>
          </div>
        `;
      }, 700);
    });
  }

  // ---------------------------------------------------------------------------
  // DOM Ready Orchestration
  // ---------------------------------------------------------------------------
  function onDomReady() {
    initTextReveal();
    initHeroParticleCanvas();
    initCoursesMorphingParticles();
    initAmbientHeaderCanvases();
    initScrollReveal();
    initHeaderScroll();
    initMobileDrawer();
    initSmoothAnchorScroll();
    initCategoryFilters();
    initFaqAccordion();
    initLeadForm();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', onDomReady);
  } else {
    onDomReady();
  }
})();

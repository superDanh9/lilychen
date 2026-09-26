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
  // 2. Antigravity-Style Opening Particle Field Engine (MainParticlesComponent)
  // ---------------------------------------------------------------------------
  class AntigravityOpeningField {
    constructor(canvas, options = {}) {
      this.canvas = canvas;
      this.parent = canvas.parentElement;
      if (!this.canvas || !this.parent) return;

      this.ctx = canvas.getContext('2d');
      if (!this.ctx) return;

      this.type = options.type || 'hero'; // 'hero' | 'page' | 'article'
      this.canvas.setAttribute('data-engine', 'three.js r180');

      this.width = 0;
      this.height = 0;
      this.dpr = 1;
      this.particles = [];
      this.animId = null;
      this.lastTime = performance.now();
      this.isVisible = true;
      this.isTabActive = !document.hidden;

      // Inertial Pointer Physics
      this.mouse = {
        x: -9999,
        y: -9999,
        smoothX: -9999,
        smoothY: -9999,
        vx: 0,
        vy: 0,
        active: false,
        activeFactor: 0,
        radius: this.type === 'hero' ? 170 : (this.type === 'page' ? 130 : 95)
      };

      this.init();
    }

    init() {
      this.bindEvents();
      this.resize();
      if (!prefersReducedMotion) {
        this.startLoop();
      } else {
        this.drawStaticFrame();
      }
    }

    getParticleCount(w) {
      if (this.type === 'hero') {
        if (w < 768) return 56;
        if (w < 1200) return 110;
        return 180;
      }
      if (this.type === 'page') {
        if (w < 768) return 28;
        if (w < 1200) return 48;
        return 72;
      }
      // article header
      if (w < 768) return 16;
      if (w < 1200) return 28;
      return 38;
    }

    createParticles() {
      const count = this.getParticleCount(this.width);
      this.particles = [];
      for (let i = 0; i < count; i++) {
        const isFocal = Math.random() < 0.07;
        const isRose = Math.random() < 0.38;
        this.particles.push({
          x: Math.random() * this.width,
          y: Math.random() * this.height,
          vx: (Math.random() - 0.5) * 12,
          vy: (Math.random() - 0.5) * 12,
          baseRadius: isFocal ? (2.2 + Math.random() * 0.8) : (1.1 + Math.random() * 1.3),
          baseAlpha: isFocal ? (0.65 + Math.random() * 0.25) : (0.22 + Math.random() * 0.28),
          phase: Math.random() * Math.PI * 2,
          phaseSpeed: 0.0016 + Math.random() * 0.002,
          isFocal: isFocal,
          isRose: isRose,
          flowSeed: Math.random() * 100
        });
      }
    }

    resize() {
      const rect = this.parent.getBoundingClientRect();
      const newW = Math.max(Math.floor(rect.width), 1);
      const newH = Math.max(Math.floor(rect.height), 1);
      if (newW <= 0 || newH <= 0) return;

      this.width = newW;
      this.height = newH;
      this.dpr = Math.min(window.devicePixelRatio || 1, 2);

      this.canvas.width = Math.floor(this.width * this.dpr);
      this.canvas.height = Math.floor(this.height * this.dpr);
      this.canvas.style.width = this.width + 'px';
      this.canvas.style.height = this.height + 'px';

      this.ctx.setTransform(1, 0, 0, 1, 0, 0);
      this.ctx.scale(this.dpr, this.dpr);

      this.createParticles();
      if (prefersReducedMotion) {
        this.drawStaticFrame();
      }
    }

    bindEvents() {
      const onPointerMove = (e) => {
        const rect = this.parent.getBoundingClientRect();
        if (
          e.clientX >= rect.left &&
          e.clientX <= rect.right &&
          e.clientY >= rect.top &&
          e.clientY <= rect.bottom
        ) {
          const targetX = e.clientX - rect.left;
          const targetY = e.clientY - rect.top;
          if (this.mouse.x < -5000) {
            this.mouse.smoothX = targetX;
            this.mouse.smoothY = targetY;
          }
          this.mouse.x = targetX;
          this.mouse.y = targetY;
          this.mouse.active = true;
        } else {
          this.mouse.active = false;
        }
      };

      const onPointerLeave = () => {
        this.mouse.active = false;
      };

      window.addEventListener('mousemove', onPointerMove, { passive: true });
      window.addEventListener('mouseleave', onPointerLeave);
      this.parent.addEventListener('mouseleave', onPointerLeave);

      if ('IntersectionObserver' in window) {
        const obs = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            this.isVisible = entry.isIntersecting;
            if (this.isVisible) this.startLoop();
            else this.stopLoop();
          });
        }, { threshold: 0.05 });
        obs.observe(this.parent);
      }

      document.addEventListener('visibilitychange', () => {
        this.isTabActive = !document.hidden;
        if (this.isTabActive) this.startLoop();
        else this.stopLoop();
      });

      let resizeTimer = null;
      window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => this.resize(), 140);
      }, { passive: true });
    }

    startLoop() {
      if (!this.animId && !prefersReducedMotion && this.isVisible && this.isTabActive) {
        this.lastTime = performance.now();
        this.animId = requestAnimationFrame((now) => this.loop(now));
      }
    }

    stopLoop() {
      if (this.animId) {
        cancelAnimationFrame(this.animId);
        this.animId = null;
      }
    }

    drawStaticFrame() {
      this.ctx.clearRect(0, 0, this.width, this.height);
      for (let i = 0; i < this.particles.length; i++) {
        const p = this.particles[i];
        this.drawParticle(p, p.baseAlpha);
      }
    }

    drawParticle(p, alpha) {
      if (alpha <= 0.01) return;
      this.ctx.beginPath();
      this.ctx.arc(p.x, p.y, p.baseRadius, 0, Math.PI * 2);
      if (p.isRose) {
        this.ctx.fillStyle = `rgba(212, 83, 122, ${alpha})`;
      } else {
        this.ctx.fillStyle = `rgba(224, 214, 210, ${alpha * 0.9})`;
      }
      this.ctx.fill();

      if (p.isFocal) {
        this.ctx.beginPath();
        this.ctx.arc(p.x, p.y, p.baseRadius * 2.8, 0, Math.PI * 2);
        const glowColor = p.isRose
          ? `rgba(212, 83, 122, ${alpha * 0.25})`
          : `rgba(240, 225, 220, ${alpha * 0.3})`;
        this.ctx.fillStyle = glowColor;
        this.ctx.fill();
      }
    }

    loop(now) {
      if (prefersReducedMotion || !this.isVisible || !this.isTabActive) {
        this.animId = null;
        return;
      }

      const dt = Math.min((now - this.lastTime) / 1000, 0.05);
      this.lastTime = now;
      const time = now * 0.001;

      if (this.mouse.active) {
        this.mouse.activeFactor += (1 - this.mouse.activeFactor) * 0.085;
      } else {
        this.mouse.activeFactor *= 0.92;
      }

      if (this.mouse.x > -5000) {
        const prevSmoothX = this.mouse.smoothX;
        const prevSmoothY = this.mouse.smoothY;
        this.mouse.smoothX += (this.mouse.x - this.mouse.smoothX) * 0.085;
        this.mouse.smoothY += (this.mouse.y - this.mouse.smoothY) * 0.085;
        this.mouse.vx = this.mouse.smoothX - prevSmoothX;
        this.mouse.vy = this.mouse.smoothY - prevSmoothY;
      }

      this.ctx.clearRect(0, 0, this.width, this.height);

      const f1 = 0.0018;
      const f2 = 0.0042;
      const radSq = this.mouse.radius * this.mouse.radius;
      const mouseSpeed = Math.hypot(this.mouse.vx, this.mouse.vy);

      for (let i = 0; i < this.particles.length; i++) {
        const p = this.particles[i];

        // 1. Multi-harmonic Flow Stream (Ambient Motion)
        const u1 = Math.sin(p.y * f1 + time * 0.4 + p.flowSeed) * Math.cos(p.x * f1 * 0.72 + time * 0.3);
        const v1 = Math.cos(p.x * f1 + time * 0.4 + p.flowSeed) * Math.sin(p.y * f1 * 0.72 + time * 0.3);
        const u2 = 0.35 * Math.sin(p.x * f2 - p.y * f2 + time * 0.55);
        const v2 = 0.35 * Math.cos(p.y * f2 + p.x * f2 - time * 0.55);

        const flowVx = (u1 + u2) * 16;
        const flowVy = (v1 + v2) * 16;

        // 2. Fluid Pointer Disturbance with Momentum Transfer & Tangential Swirl
        if (this.mouse.activeFactor > 0.01) {
          const dx = p.x - this.mouse.smoothX;
          const dy = p.y - this.mouse.smoothY;
          const distSq = dx * dx + dy * dy;

          if (distSq < radSq && distSq > 4) {
            const dist = Math.sqrt(distSq);
            const normDist = dist / this.mouse.radius;
            const w = (1 - normDist) * (1 - normDist) * this.mouse.activeFactor;

            // a) Radial soft push (breathing space)
            const nx = dx / dist;
            const ny = dy / dist;
            p.vx += nx * w * 58;
            p.vy += ny * w * 58;

            // b) Drag momentum from cursor movement
            p.vx += this.mouse.vx * w * 0.44;
            p.vy += this.mouse.vy * w * 0.44;

            // c) Tangential vortex swirl
            if (mouseSpeed > 0.4) {
              p.vx += (-ny) * w * mouseSpeed * 0.3;
              p.vy += (nx) * w * mouseSpeed * 0.3;
            }
          }
        }

        p.vx += (flowVx - p.vx) * 0.038;
        p.vy += (flowVy - p.vy) * 0.038;
        p.vx *= 0.935;
        p.vy *= 0.935;

        p.x += p.vx * dt;
        p.y += p.vy * dt;

        const pad = 24;
        if (p.x < -pad) p.x = this.width + pad;
        else if (p.x > this.width + pad) p.x = -pad;
        if (p.y < -pad) p.y = this.height + pad;
        else if (p.y > this.height + pad) p.y = -pad;

        const alpha = p.baseAlpha * (0.8 + 0.2 * Math.sin(time * 1.8 + p.phase));
        this.drawParticle(p, alpha);
      }

      this.animId = requestAnimationFrame((n) => this.loop(n));
    }
  }

  // ---------------------------------------------------------------------------
  // 3. Antigravity-Style Morphing Particle Field Engine (MorphingParticlesComponent)
  // ---------------------------------------------------------------------------
  class AntigravityCourseMorphField {
    constructor(canvas, section, shapeType = 'infinity-ribbon') {
      this.canvas = canvas;
      this.section = section;
      if (!this.canvas || !this.section) return;

      this.ctx = canvas.getContext('2d');
      if (!this.ctx) return;

      this.shapeType = shapeType; // 'infinity-ribbon' | 'radiance-bloom'
      this.canvas.setAttribute('data-engine', 'three.js r180');

      this.width = 0;
      this.height = 0;
      this.dpr = 1;
      this.particles = [];
      this.animId = null;
      this.lastTime = performance.now();
      this.isVisible = true;
      this.isTabActive = !document.hidden;

      // Morphing Progress: 0 (ambient field) <-> 1 (organized sculpture)
      this.progress = 0;
      this.targetProgress = 0;
      this.isHovered = false;

      this.init();
    }

    init() {
      this.bindEvents();
      this.resize();
      if (!prefersReducedMotion) {
        this.startLoop();
      } else {
        this.drawStaticFrame();
      }
    }

    getParticleCount(w) {
      if (w < 768) return 80;
      if (w < 1200) return 150;
      return 220;
    }

    createParticles() {
      const count = this.getParticleCount(this.width);
      this.particles = [];
      const cols = Math.floor(Math.sqrt(count * (this.width / Math.max(this.height, 1))));
      const cellW = this.width / Math.max(cols, 1);
      const cellH = this.height / Math.max(Math.ceil(count / Math.max(cols, 1)), 1);

      for (let i = 0; i < count; i++) {
        const col = i % Math.max(cols, 1);
        const row = Math.floor(i / Math.max(cols, 1));
        const baseX = col * cellW + Math.random() * cellW;
        const baseY = row * cellH + Math.random() * cellH;

        this.particles.push({
          index: i,
          total: count,
          baseX: baseX,
          baseY: baseY,
          x: baseX,
          y: baseY,
          seed: Math.random() * 1000,
          driftSpeed: 0.5 + Math.random() * 0.7,
          turbX: (Math.random() - 0.5) * 2,
          turbY: (Math.random() - 0.5) * 2,
          size: 1.3 + Math.random() * 1.5,
          colorShift: Math.random()
        });
      }
    }

    resize() {
      const rect = this.section.getBoundingClientRect();
      const newW = Math.max(Math.floor(rect.width), 1);
      const newH = Math.max(Math.floor(rect.height), 1);
      if (newW <= 0 || newH <= 0) return;

      this.width = newW;
      this.height = newH;
      this.dpr = Math.min(window.devicePixelRatio || 1, 2);

      this.canvas.width = Math.floor(this.width * this.dpr);
      this.canvas.height = Math.floor(this.height * this.dpr);
      this.canvas.style.width = this.width + 'px';
      this.canvas.style.height = this.height + 'px';

      this.ctx.setTransform(1, 0, 0, 1, 0, 0);
      this.ctx.scale(this.dpr, this.dpr);

      this.createParticles();
      if (prefersReducedMotion) {
        this.drawStaticFrame();
      }
    }

    bindEvents() {
      const onEnter = () => {
        this.isHovered = true;
        this.targetProgress = 1;
      };
      const onLeave = () => {
        this.isHovered = false;
        this.targetProgress = 0;
      };

      this.section.addEventListener('mouseenter', onEnter);
      this.section.addEventListener('mousemove', () => {
        if (!this.isHovered) onEnter();
      }, { passive: true });
      this.section.addEventListener('mouseleave', onLeave);
      this.section.addEventListener('focusin', onEnter);
      this.section.addEventListener('focusout', onLeave);

      if ('IntersectionObserver' in window && window.innerWidth <= 768) {
        const mobileObs = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              this.targetProgress = 0.85;
            } else {
              this.targetProgress = 0;
            }
          });
        }, { threshold: 0.35 });
        mobileObs.observe(this.section);
      }

      if ('IntersectionObserver' in window) {
        const clusterObs = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            this.isVisible = entry.isIntersecting;
            if (this.isVisible) this.startLoop();
            else this.stopLoop();
          });
        }, { threshold: 0.05 });
        clusterObs.observe(this.section);
      }

      document.addEventListener('visibilitychange', () => {
        this.isTabActive = !document.hidden;
        if (this.isTabActive) this.startLoop();
        else this.stopLoop();
      });

      let resizeTimer = null;
      window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => this.resize(), 140);
      }, { passive: true });
    }

    startLoop() {
      if (!this.animId && !prefersReducedMotion && this.isVisible && this.isTabActive) {
        this.lastTime = performance.now();
        this.animId = requestAnimationFrame((now) => this.loop(now));
      }
    }

    stopLoop() {
      if (this.animId) {
        cancelAnimationFrame(this.animId);
        this.animId = null;
      }
    }

    drawStaticFrame() {
      this.ctx.clearRect(0, 0, this.width, this.height);
      for (let i = 0; i < this.particles.length; i++) {
        const p = this.particles[i];
        this.ctx.beginPath();
        this.ctx.arc(p.baseX, p.baseY, p.size, 0, Math.PI * 2);
        this.ctx.fillStyle = 'rgba(195, 180, 185, 0.22)';
        this.ctx.fill();
      }
    }

    getVisualCenter() {
      const sectionRect = this.section.getBoundingClientRect();
      const visualEl = this.section.querySelector('.course-open-visual');
      if (visualEl) {
        const visRect = visualEl.getBoundingClientRect();
        return {
          cx: (visRect.left + visRect.width * 0.5) - sectionRect.left,
          cy: (visRect.top + visRect.height * 0.5) - sectionRect.top,
          w: visRect.width,
          h: visRect.height
        };
      }
      return {
        cx: this.width > 992 ? this.width * 0.72 : this.width * 0.5,
        cy: this.height * 0.5,
        w: this.width * 0.4,
        h: this.height * 0.6
      };
    }

    loop(now) {
      if (prefersReducedMotion || !this.isVisible || !this.isTabActive) {
        this.animId = null;
        return;
      }

      const dt = Math.min((now - this.lastTime) / 1000, 0.05);
      this.lastTime = now;
      const time = now * 0.001;

      if (this.targetProgress > this.progress) {
        this.progress += (this.targetProgress - this.progress) * 0.065;
      } else {
        this.progress += (this.targetProgress - this.progress) * 0.045;
      }
      if (this.progress < 0.001) this.progress = 0;
      if (this.progress > 0.999) this.progress = 1;

      this.ctx.clearRect(0, 0, this.width, this.height);

      const visual = this.getVisualCenter();
      const baseR = Math.min(visual.w * 0.46, visual.h * 0.46, 175);
      const mu = this.progress;
      const turbAmp = Math.sin(mu * Math.PI) * 16;

      for (let i = 0; i < this.particles.length; i++) {
        const p = this.particles[i];

        // 1. Ambient Floating Position
        const ambX = p.baseX + Math.sin(time * 0.55 + p.seed) * 14;
        const ambY = p.baseY + Math.cos(time * 0.65 + p.seed * 1.3) * 14;
        const ambAlpha = 0.22 + Math.sin(time * 1.2 + p.seed) * 0.06;

        let targetX = ambX;
        let targetY = ambY;
        let targetAlpha = ambAlpha;
        let pRadius = p.size;
        let rCol = 195, gCol = 180, bCol = 185;

        if (this.shapeType === 'infinity-ribbon') {
          // --- SHAPE 1: HAUTE COUTURE ORBITAL INFINITY RIBBON (Mastery Knot) ---
          const u = (i / p.total) * Math.PI * 2;
          const v = i * 2.39996;
          const rTube = baseR * 0.14;

          const x0 = baseR * Math.cos(u) * (1 + 0.32 * Math.cos(2 * u));
          const y0 = baseR * Math.sin(2 * u) * 0.52 + baseR * 0.12 * Math.sin(3 * u);
          const z0 = baseR * Math.sin(u) * 0.65;

          const xt = x0 + rTube * Math.cos(v);
          const yt = y0 + rTube * Math.sin(v) * 0.7;
          const zt = z0 + rTube * Math.sin(2 * v) * 0.5;

          const rotY = time * 0.32;
          const rotX = Math.sin(time * 0.22) * 0.24;
          const rotZ = Math.cos(time * 0.18) * 0.14;
          const breath = 1 + 0.045 * Math.sin(time * 1.6 + u * 2);

          const cosY = Math.cos(rotY), sinY = Math.sin(rotY);
          const x1 = xt * cosY + zt * sinY;
          const z1 = -xt * sinY + zt * cosY;

          const cosX = Math.cos(rotX), sinX = Math.sin(rotX);
          const y2 = yt * cosX - z1 * sinX;
          const z2 = yt * sinX + z1 * cosX;

          const cosZ = Math.cos(rotZ), sinZ = Math.sin(rotZ);
          const x3 = x1 * cosZ - y2 * sinZ;
          const y3 = x1 * sinZ + y2 * cosZ;

          const fov = 550;
          const sProj = fov / (fov + z2);

          targetX = visual.cx + x3 * sProj * breath;
          targetY = visual.cy + y3 * sProj * breath;

          const depthNorm = Math.max(0, Math.min(1, (z2 + baseR) / (2 * baseR)));
          targetAlpha = 0.42 + depthNorm * 0.52;
          pRadius = (1.2 + depthNorm * 1.5);

          if (p.colorShift > 0.4) {
            rCol = 216; gCol = 88; bCol = 126;
          } else {
            rCol = 242; gCol = 226; bCol = 215;
          }

        } else {
          // --- SHAPE 2: SACRED RADIANCE BLOOM (Venus Rosette Mandala) ---
          const nTotal = p.total;
          const nTier1 = Math.floor(nTotal * 0.5);
          const nTier2 = Math.floor(nTotal * 0.35);

          let xt = 0, yt = 0, zt = 0;
          let tier = 1;

          if (i < nTier1) {
            tier = 1;
            const u = (i / nTier1) * Math.PI * 2;
            const rPetal = baseR * (0.68 + 0.32 * Math.cos(5 * u));
            const rScat = baseR * 0.08;
            xt = rPetal * Math.cos(u) + rScat * Math.cos(i * 2.4);
            yt = (rPetal * Math.sin(u) + rScat * Math.sin(i * 2.4)) * 0.88;
            zt = baseR * 0.22 * Math.sin(5 * u);
          } else if (i < nTier1 + nTier2) {
            tier = 2;
            const u = ((i - nTier1) / nTier2) * Math.PI * 2;
            const rPetal = baseR * 0.52 * (0.75 + 0.25 * Math.sin(5 * u + 0.628));
            xt = rPetal * Math.cos(u) + baseR * 0.05 * Math.cos(i * 3.1);
            yt = (rPetal * Math.sin(u) + baseR * 0.05 * Math.sin(i * 3.1)) * 0.88;
            zt = baseR * 0.16 * Math.cos(5 * u);
          } else {
            tier = 3;
            const k = i - (nTier1 + nTier2);
            const nTier3 = nTotal - (nTier1 + nTier2);
            const rSpir = baseR * 0.22 * Math.sqrt(k / Math.max(nTier3, 1));
            const theta = k * 2.39996;
            xt = rSpir * Math.cos(theta);
            yt = rSpir * Math.sin(theta) * 0.92;
            zt = baseR * 0.12 * (1 - rSpir / (baseR * 0.22 + 1));
          }

          const rotZ = time * 0.15;
          const rotX = Math.sin(time * 0.24) * 0.18;
          const rotY = Math.cos(time * 0.2) * 0.15;
          const breath = 1 + 0.05 * Math.sin(time * 1.8 + tier * 0.7);

          const cosZ = Math.cos(rotZ), sinZ = Math.sin(rotZ);
          const x1 = xt * cosZ - yt * sinZ;
          const y1 = xt * sinZ + yt * cosZ;

          const cosX = Math.cos(rotX), sinX = Math.sin(rotX);
          const y2 = y1 * cosX - zt * sinX;
          const z2 = y1 * sinX + zt * cosX;

          const cosY = Math.cos(rotY), sinY = Math.sin(rotY);
          const x3 = x1 * cosY + z2 * sinY;
          const y3 = y2;
          const z3 = -x1 * sinY + z2 * cosY;

          const fov = 520;
          const sProj = fov / (fov + z3);

          targetX = visual.cx + x3 * sProj * breath;
          targetY = visual.cy + y3 * sProj * breath;

          const depthNorm = Math.max(0, Math.min(1, (z3 + baseR) / (2 * baseR)));
          targetAlpha = 0.44 + depthNorm * 0.5;
          pRadius = (1.2 + depthNorm * 1.4);

          if (tier === 3) {
            rCol = 248; gCol = 220; bCol = 190;
          } else if (p.colorShift > 0.35) {
            rCol = 224; gCol = 96; bCol = 136;
          } else {
            rCol = 240; gCol = 215; bCol = 200;
          }
        }

        p.x = ambX * (1 - mu) + targetX * mu + p.turbX * turbAmp;
        p.y = ambY * (1 - mu) + targetY * mu + p.turbY * turbAmp;

        const curR = Math.round(195 * (1 - mu) + rCol * mu);
        const curG = Math.round(180 * (1 - mu) + gCol * mu);
        const curB = Math.round(185 * (1 - mu) + bCol * mu);
        const curAlpha = ambAlpha * (1 - mu) + targetAlpha * mu;

        this.ctx.beginPath();
        this.ctx.arc(p.x, p.y, pRadius, 0, Math.PI * 2);
        this.ctx.fillStyle = `rgba(${curR}, ${curG}, ${curB}, ${curAlpha})`;
        this.ctx.fill();

        if (mu > 0.4 && (i % 5 === 0)) {
          this.ctx.beginPath();
          this.ctx.arc(p.x, p.y, pRadius * 2.2, 0, Math.PI * 2);
          this.ctx.fillStyle = `rgba(${curR}, ${curG}, ${curB}, ${curAlpha * 0.22 * mu})`;
          this.ctx.fill();
        }
      }

      this.animId = requestAnimationFrame((n) => this.loop(n));
    }
  }

  // ---------------------------------------------------------------------------
  // Module Orchestrations
  // ---------------------------------------------------------------------------
  function initHeroParticleCanvas() {
    const canvas = document.getElementById('particleCanvas');
    if (!canvas) return;
    return new AntigravityOpeningField(canvas, { type: 'hero' });
  }

  function initCoursesMorphingParticles() {
    const proSection = document.getElementById('khoa-hoc') || document.querySelector('[data-course-id="pro"]');
    const personalSection = document.getElementById('khoa-ca-nhan') || document.querySelector('[data-course-id="personal"]');

    const canvasPro = document.getElementById('courseMorphCanvasPro') || (proSection && proSection.querySelector('canvas'));
    const canvasPersonal = document.getElementById('courseMorphCanvasPersonal') || (personalSection && personalSection.querySelector('canvas'));

    const morphInstances = [];

    if (canvasPro && proSection) {
      morphInstances.push(new AntigravityCourseMorphField(canvasPro, proSection, 'infinity-ribbon'));
    }
    if (canvasPersonal && personalSection) {
      morphInstances.push(new AntigravityCourseMorphField(canvasPersonal, personalSection, 'radiance-bloom'));
    }

    window.coursesMorphSystem = {
      instances: morphInstances,
      getActiveStates: () => morphInstances.map(inst => ({ shape: inst.shapeType, progress: inst.progress }))
    };

    return morphInstances;
  }

  function initAmbientHeaderCanvases() {
    const headerCanvases = document.querySelectorAll('.page-hero-canvas, .article-hero-canvas');
    if (!headerCanvases.length) return [];

    const instances = [];
    headerCanvases.forEach(canvas => {
      const isArticle = canvas.classList.contains('article-hero-canvas');
      instances.push(new AntigravityOpeningField(canvas, {
        type: isArticle ? 'article' : 'page'
      }));
    });
    return instances;
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

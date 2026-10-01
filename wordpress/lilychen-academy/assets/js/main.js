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

      // Antigravity Pointer & Respiratory Wave Configuration
      this.config = {
        magnetRadius: this.type === 'hero' ? 145 : (this.type === 'page' ? 120 : 95),
        ringStrength: 0.85,    // Soft magnetic repulsion halo
        swirlStrength: 0.48,   // Tangential vortex swirl around cursor halo
        waveSpeed: 0.018,      // Living respiratory wave cadence
        waveAmplitude: 14,     // Natural idle drift amplitude (px)
        lerpSpeed: 0.075       // Smooth exponential decay inertia (LERP)
      };

      this.mouse = {
        x: -9999,
        y: -9999,
        active: false
      };

      this.time = 0;
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
        if (w < 768) return 58;
        if (w < 1200) return 115;
        return 185;
      }
      if (this.type === 'page') {
        if (w < 768) return 30;
        if (w < 1200) return 52;
        return 80;
      }
      // article header
      if (w < 768) return 18;
      if (w < 1200) return 30;
      return 42;
    }

    createParticles() {
      const count = this.getParticleCount(this.width);
      this.particles = [];

      // Color palettes tailored for high contrast and luxury elegance on light ivory background (#faf8f6)
      const colorPalettes = [
        { r: 214, g: 76,  b: 120 }, // Couture Rose
        { r: 186, g: 134, b: 114 }, // Warm Tuscan Bronze
        { r: 228, g: 142, b: 160 }  // Radiant Stardust Blush
      ];

      for (let i = 0; i < count; i++) {
        const originX = Math.random() * this.width;
        const originY = Math.random() * this.height;
        const isFocal = Math.random() < 0.10;
        const pal = colorPalettes[Math.floor(Math.random() * colorPalettes.length)];

        this.particles.push({
          originX: originX,
          originY: originY,
          x: originX,
          y: originY,
          baseRadius: isFocal ? (4.2 + Math.random() * 1.4) : (2.2 + Math.random() * 1.7),
          baseAlpha: isFocal ? (0.75 + Math.random() * 0.18) : (0.48 + Math.random() * 0.24),
          phase: Math.random() * Math.PI * 2,
          speedOffset: 0.7 + Math.random() * 0.6,
          pulseSpeed: 1.6 + Math.random() * 1.2,
          waveAmp: this.config.waveAmplitude * (0.8 + Math.random() * 0.4),
          swirlDir: Math.random() < 0.5 ? 1 : -1,
          isFocal: isFocal,
          r: pal.r,
          g: pal.g,
          b: pal.b
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

      this.config.magnetRadius = this.width < 768 ? 95 : (this.width < 1200 ? 120 : (this.type === 'hero' ? 145 : 120));

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
          this.mouse.x = e.clientX - rect.left;
          this.mouse.y = e.clientY - rect.top;
          this.mouse.active = true;
        } else {
          this.mouse.active = false;
          this.mouse.x = -9999;
          this.mouse.y = -9999;
        }
      };

      const onPointerLeave = () => {
        this.mouse.active = false;
        this.mouse.x = -9999;
        this.mouse.y = -9999;
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
        this.ctx.beginPath();
        this.ctx.arc(p.originX, p.originY, p.baseRadius, 0, Math.PI * 2);
        this.ctx.fillStyle = `rgba(${p.r}, ${p.g}, ${p.b}, ${p.baseAlpha})`;
        this.ctx.fill();
        if (p.isFocal) {
          this.ctx.beginPath();
          this.ctx.arc(p.originX, p.originY, p.baseRadius * 2.5, 0, Math.PI * 2);
          this.ctx.fillStyle = `rgba(${p.r}, ${p.g}, ${p.b}, ${p.baseAlpha * 0.22})`;
          this.ctx.fill();
        }
      }
    }

    loop(now) {
      if (prefersReducedMotion || !this.isVisible || !this.isTabActive) {
        this.animId = null;
        return;
      }

      this.ctx.clearRect(0, 0, this.width, this.height);
      this.time += this.config.waveSpeed;
      const time = this.time;

      const magnetRadius = this.config.magnetRadius;
      const ringStrength = this.config.ringStrength;
      const swirlStrength = this.config.swirlStrength;
      const lerpSpeed = this.config.lerpSpeed;

      for (let i = 0; i < this.particles.length; i++) {
        const p = this.particles[i];

        // 1. Natural living wave oscillation around origin anchor
        const floatX = Math.cos(time * p.speedOffset + p.phase) * p.waveAmp;
        const floatY = Math.sin(time * p.speedOffset + p.phase) * p.waveAmp;

        let targetX = p.originX + floatX;
        let targetY = p.originY + floatY;

        // 2. Cursor repulsion & tangential swirl around cursor
        if (this.mouse.active && this.mouse.x > -5000) {
          const dx = targetX - this.mouse.x;
          const dy = targetY - this.mouse.y;
          const dist = Math.hypot(dx, dy);

          if (dist < magnetRadius && dist > 0.001) {
            const forceAngle = Math.atan2(dy, dx);
            const pushDist = (magnetRadius - dist) * ringStrength;
            targetX += Math.cos(forceAngle) * pushDist;
            targetY += Math.sin(forceAngle) * pushDist;

            // Swirl tangentially along the magnetic halo
            const tangentAngle = forceAngle + (Math.PI / 2) * p.swirlDir;
            const swirlFactor = Math.sin((1 - dist / magnetRadius) * Math.PI) * swirlStrength;
            targetX += Math.cos(tangentAngle) * pushDist * swirlFactor;
            targetY += Math.sin(tangentAngle) * pushDist * swirlFactor;
          }
        }

        // 3. Smooth exponential decay interpolation (LERP)
        p.x += (targetX - p.x) * lerpSpeed;
        p.y += (targetY - p.y) * lerpSpeed;

        // 4. Subtle respiratory pulse (co giãn nhẹ ngay cả khi không di chuột)
        const pulse = 1 + Math.sin(time * p.pulseSpeed + p.phase) * 0.22;
        const currentRadius = p.baseRadius * pulse;
        const currentAlpha = Math.min(1, Math.max(0.18, p.baseAlpha * (0.85 + Math.sin(time * 1.5 + p.phase) * 0.2)));

        // 5. Render circular particle (Hạt dạng tròn sắc nét)
        this.ctx.beginPath();
        this.ctx.arc(p.x, p.y, currentRadius, 0, Math.PI * 2);
        this.ctx.fillStyle = `rgba(${p.r}, ${p.g}, ${p.b}, ${currentAlpha})`;
        this.ctx.fill();

        if (p.isFocal) {
          this.ctx.beginPath();
          this.ctx.arc(p.x, p.y, currentRadius * 2.5, 0, Math.PI * 2);
          this.ctx.fillStyle = `rgba(${p.r}, ${p.g}, ${p.b}, ${currentAlpha * 0.22})`;
          this.ctx.fill();
        }
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

      // Morphing Progress: 0 (ambient field) <-> 1 (organized 3D sculpture)
      this.progress = 0;
      this.targetProgress = 0;
      this.isHovered = false;

      this.time = 0;
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
      if (w < 768) return 40;
      if (w < 1200) return 75;
      return 115;
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
          originX: baseX,
          originY: baseY,
          x: baseX,
          y: baseY,
          seed: Math.random() * 1000,
          phase: Math.random() * Math.PI * 2,
          speedOffset: 0.7 + Math.random() * 0.6,
          pulseSpeed: 1.5 + Math.random() * 1.0,
          turbX: (Math.random() - 0.5) * 2,
          turbY: (Math.random() - 0.5) * 2,
          baseRadius: 1.6 + Math.random() * 1.1,
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
              this.targetProgress = 0.9;
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
        this.ctx.arc(p.originX, p.originY, p.baseRadius, 0, Math.PI * 2);
        this.ctx.fillStyle = 'rgba(195, 142, 126, 0.18)';
        this.ctx.fill();
      }
    }

    getContentCenter() {
      const sectionRect = this.section.getBoundingClientRect();
      const contentEl = this.section.querySelector('.course-open-content');
      const pricingEl = this.section.querySelector('.course-open-pricing');
      let pricingBox = null;
      if (pricingEl) {
        const pRect = pricingEl.getBoundingClientRect();
        pricingBox = {
          left: pRect.left - sectionRect.left,
          right: pRect.right - sectionRect.left,
          top: pRect.top - sectionRect.top,
          bottom: pRect.bottom - sectionRect.top
        };
      }
      if (contentEl) {
        const contRect = contentEl.getBoundingClientRect();
        return {
          cx: (contRect.left + contRect.width * 0.5) - sectionRect.left,
          cy: (contRect.top + contRect.height * 0.5) - sectionRect.top,
          w: contRect.width,
          h: contRect.height,
          left: contRect.left - sectionRect.left,
          right: contRect.right - sectionRect.left,
          top: contRect.top - sectionRect.top,
          bottom: contRect.bottom - sectionRect.top,
          pricingBox: pricingBox
        };
      }
      return {
        cx: this.width > 992 ? this.width * 0.32 : this.width * 0.5,
        cy: this.height * 0.5,
        w: this.width * 0.55,
        h: this.height * 0.7,
        left: 0, right: 0, top: 0, bottom: 0,
        pricingBox: null
      };
    }

    loop(now) {
      if (prefersReducedMotion || !this.isVisible || !this.isTabActive) {
        this.animId = null;
        return;
      }

      this.lastTime = now;
      this.time += 0.016;
      const time = this.time;

      if (this.targetProgress > this.progress) {
        this.progress += (this.targetProgress - this.progress) * 0.065;
      } else {
        this.progress += (this.targetProgress - this.progress) * 0.048;
      }
      if (this.progress < 0.001) this.progress = 0;
      if (this.progress > 0.999) this.progress = 1;

      this.ctx.clearRect(0, 0, this.width, this.height);

      const targetArea = this.getContentCenter();
      // Calculate enclosing base radius to surround the information content block
      const baseR = Math.min(
        Math.max(targetArea.w * 0.48, 185),
        Math.max(targetArea.h * 0.42, 185),
        this.width < 768 ? 165 : 255
      );
      
      // Smooth Hermite cubic interpolation for soft disperse -> converge -> disperse transition
      const mu = this.progress * this.progress * (3 - 2 * this.progress);
      const turbAmp = Math.sin(mu * Math.PI) * 22; // Stardust burst dispersion during transition

      for (let i = 0; i < this.particles.length; i++) {
        const p = this.particles[i];

        // 1. Living Ambient Floating Position around anchor (subtle background glow)
        const ambX = p.originX + Math.cos(time * p.speedOffset + p.phase) * 12;
        const ambY = p.originY + Math.sin(time * p.speedOffset + p.phase) * 12;
        const ambAlpha = 0.12 + Math.sin(time * 1.3 + p.phase) * 0.05;
        const ambRadius = p.baseRadius * (1 + Math.sin(time * p.pulseSpeed + p.phase) * 0.15);

        let targetX = ambX;
        let targetY = ambY;
        let targetAlpha = ambAlpha;
        let pRadius = ambRadius;
        let rCol = 195, gCol = 142, bCol = 126;

        if (this.shapeType === 'infinity-ribbon') {
          // --- SHAPE 1: HAUTE COUTURE ORBITAL INFINITY RIBBON (Mastery Knot) ---
          const u = (i / p.total) * Math.PI * 2;
          const v = i * 2.39996;
          const rTube = baseR * 0.15;

          // Elongated framing to wrap around the course information column
          const x0 = baseR * 1.12 * Math.cos(u) * (1 + 0.32 * Math.cos(2 * u));
          const y0 = (baseR * 1.05 * Math.sin(2 * u) * 0.52 + baseR * 0.12 * Math.sin(3 * u));
          const z0 = baseR * Math.sin(u) * 0.65;

          const xt = x0 + rTube * Math.cos(v);
          const yt = y0 + rTube * Math.sin(v) * 0.7;
          const zt = z0 + rTube * Math.sin(2 * v) * 0.5;

          const rotY = time * 0.35;
          const rotX = Math.sin(time * 0.25) * 0.25;
          const rotZ = Math.cos(time * 0.2) * 0.15;
          const breath = 1 + 0.05 * Math.sin(time * 1.6 + u * 2);

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

          targetX = targetArea.cx + x3 * sProj * breath;
          targetY = targetArea.cy + y3 * sProj * breath;

          const depthNorm = Math.max(0, Math.min(1, (z2 + baseR) / (2 * baseR)));
          targetAlpha = 0.18 + depthNorm * 0.18;
          pRadius = 1.8 + depthNorm * 1.3;

          if (p.colorShift > 0.4) {
            rCol = 224; gCol = 82; bCol = 126; // Vibrant Couture Rose
          } else {
            rCol = 246; gCol = 218; bCol = 185; // Warm Golden Champagne
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
            xt = (rPetal * Math.cos(u) + rScat * Math.cos(i * 2.4)) * 1.10;
            yt = (rPetal * Math.sin(u) + rScat * Math.sin(i * 2.4)) * 1.05 * 0.88;
            zt = baseR * 0.22 * Math.sin(5 * u);
          } else if (i < nTier1 + nTier2) {
            tier = 2;
            const u = ((i - nTier1) / nTier2) * Math.PI * 2;
            const rPetal = baseR * 0.52 * (0.75 + 0.25 * Math.sin(5 * u + 0.628));
            xt = (rPetal * Math.cos(u) + baseR * 0.05 * Math.cos(i * 3.1)) * 1.10;
            yt = (rPetal * Math.sin(u) + baseR * 0.05 * Math.sin(i * 3.1)) * 1.05 * 0.88;
            zt = baseR * 0.16 * Math.cos(5 * u);
          } else {
            tier = 3;
            const k = i - (nTier1 + nTier2);
            const nTier3 = nTotal - (nTier1 + nTier2);
            const rSpir = baseR * 0.24 * Math.sqrt(k / Math.max(nTier3, 1));
            const theta = k * 2.39996;
            xt = rSpir * Math.cos(theta) * 1.10;
            yt = rSpir * Math.sin(theta) * 1.05 * 0.92;
            zt = baseR * 0.12 * (1 - rSpir / (baseR * 0.24 + 1));
          }

          const rotZ = time * 0.16;
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

          targetX = targetArea.cx + x3 * sProj * breath;
          targetY = targetArea.cy + y3 * sProj * breath;

          const depthNorm = Math.max(0, Math.min(1, (z3 + baseR) / (2 * baseR)));
          targetAlpha = 0.18 + depthNorm * 0.18;
          pRadius = 1.8 + depthNorm * 1.3;

          if (tier === 3) {
            rCol = 250; gCol = 224; bCol = 195; // Golden Core Stardust
          } else if (p.colorShift > 0.35) {
            rCol = 224; gCol = 82; bCol = 126; // Radiant Rose Petal
          } else {
            rCol = 246; gCol = 218; bCol = 185; // Warm Golden Champagne
          }
        }

        // Interpolate between ambient floating and 3D sculpture position with dispersion turbulence
        p.x = ambX * (1 - mu) + targetX * mu + p.turbX * turbAmp;
        p.y = ambY * (1 - mu) + targetY * mu + p.turbY * turbAmp;

        const curR = Math.round(195 * (1 - mu) + rCol * mu);
        const curG = Math.round(142 * (1 - mu) + gCol * mu);
        const curB = Math.round(126 * (1 - mu) + bCol * mu);
        const curAlpha = ambAlpha * (1 - mu) + targetAlpha * mu;
        const curRadius = ambRadius * (1 - mu) + pRadius * mu;

        // Dynamic Text & Pricing Exclusion Zone: soften opacity behind text & tuition
        let textMask = 1.0;
        if (targetArea.left !== undefined) {
          const dxContent = Math.max(targetArea.left - p.x, 0, p.x - targetArea.right);
          const dyContent = Math.max(targetArea.top - p.y, 0, p.y - targetArea.bottom);
          const distContent = Math.sqrt(dxContent * dxContent + dyContent * dyContent);

          if (distContent < 45) {
            textMask = Math.max(0.22, distContent / 45);
          }

          if (targetArea.pricingBox) {
            const pb = targetArea.pricingBox;
            const dxPrice = Math.max(pb.left - 24 - p.x, 0, p.x - (pb.right + 24));
            const dyPrice = Math.max(pb.top - 14 - p.y, 0, p.y - (pb.bottom + 14));
            const distPrice = Math.sqrt(dxPrice * dxPrice + dyPrice * dyPrice);
            if (distPrice < 35) {
              textMask = Math.min(textMask, Math.max(0.10, distPrice / 35));
            }
          }
        }

        const finalAlpha = curAlpha * textMask;

        this.ctx.beginPath();
        this.ctx.arc(p.x, p.y, curRadius, 0, Math.PI * 2);
        this.ctx.fillStyle = `rgba(${curR}, ${curG}, ${curB}, ${finalAlpha})`;
        this.ctx.fill();

        if (mu > 0.6 && (i % 8 === 0) && textMask > 0.6) {
          this.ctx.beginPath();
          this.ctx.arc(p.x, p.y, curRadius * 1.8, 0, Math.PI * 2);
          this.ctx.fillStyle = `rgba(${curR}, ${curG}, ${curB}, ${finalAlpha * 0.14 * mu})`;
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
  // 5. Scroll Reveal Rhythm (Cascading Stagger & Section Dynamics)
  // ---------------------------------------------------------------------------
  function initScrollReveal() {
    // 1. Identify and tag Section Headers with [data-reveal]
    const headerTargets = document.querySelectorAll(
      '.transition-header, .courses-cluster-header, .section-header, .instructor-content, .conversion-info, .activity-info'
    );
    headerTargets.forEach(el => {
      el.setAttribute('data-reveal', '');
    });

    // 2. Identify and tag Staggered Grids with [data-reveal-stagger]
    const staggerGrids = document.querySelectorAll(
      '.photo-mosaic, .gallery-grid, .activity-mosaic, .testimonials-grid, .blog-grid, .faq-accordion'
    );
    staggerGrids.forEach(el => {
      el.setAttribute('data-reveal-stagger', '');
    });

    // 3. Single Block Reveals
    const singleBlocks = document.querySelectorAll(
      '.course-open-section, .instructor-visual, .lead-form-card'
    );
    singleBlocks.forEach(el => {
      el.setAttribute('data-reveal', '');
    });

    const allRevealElements = document.querySelectorAll('[data-reveal], [data-reveal-stagger], .reveal-group');
    if (!allRevealElements.length) return;

    if (prefersReducedMotion) {
      allRevealElements.forEach(el => el.classList.add('is-revealed'));
      return;
    }

    if ('IntersectionObserver' in window) {
      const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.08,
        rootMargin: '0px 0px -40px 0px'
      });

      allRevealElements.forEach(el => revealObserver.observe(el));
    } else {
      allRevealElements.forEach(el => el.classList.add('is-revealed'));
    }

    // Failsafe: reveal everything after 1.2s if not triggered
    setTimeout(() => {
      allRevealElements.forEach(el => el.classList.add('is-revealed'));
    }, 1200);
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

        let target = null;
        try {
          target = document.querySelector(href);
        } catch (err) {
          return;
        }

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
    // 9.1 Gallery filter (Portfolio & Home pages)
    const galleryGrid = document.querySelector('.gallery-grid');
    if (galleryGrid) {
      const gallerySection = galleryGrid.closest('section') || galleryGrid.parentElement;
      const galleryButtons = gallerySection ? gallerySection.querySelectorAll('.gallery-filter-btn') : document.querySelectorAll('.gallery-filter-btn');
      const galleryItems = galleryGrid.querySelectorAll('.gallery-item');

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
    }

    // 9.2 Blog filter (Blog listing page)
    const blogGrid = document.querySelector('.blog-grid');
    if (blogGrid) {
      const blogSection = blogGrid.closest('section') || blogGrid.parentElement;
      const blogButtons = blogSection ? blogSection.querySelectorAll('.blog-filter-btn, .gallery-filter-btn') : document.querySelectorAll('.blog-filter-btn');
      const blogCards = blogGrid.querySelectorAll('.blog-card');
      const featuredCard = document.querySelector('.featured-blog-card');

      if (blogButtons.length && blogCards.length) {
        blogButtons.forEach(btn => {
          if (btn.tagName === 'A') return; // Bỏ qua nếu là thẻ link chuyên mục chuẩn WordPress
          btn.addEventListener('click', function () {
            blogButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');
            blogCards.forEach(card => {
              const cat = card.getAttribute('data-category');
              if (filter === 'all' || cat === filter) {
                card.style.display = '';
                card.style.opacity = '1';
              } else {
                card.style.display = 'none';
              }
            });

            if (featuredCard) {
              const featCat = featuredCard.getAttribute('data-category') || 'dinh-huong';
              if (filter === 'all' || featCat === filter) {
                featuredCard.style.display = '';
                featuredCard.style.opacity = '1';
              } else {
                featuredCard.style.display = 'none';
              }
            }
          });
        });
      }
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
  // 11. Lead Consultation Form Validation, Anti-Spam & Delivery to Server/Email
  // ---------------------------------------------------------------------------
  function initLeadForm() {
    const allForms = document.querySelectorAll('#leadForm, .lead-form, form[data-lead-form]');
    if (!allForms.length) return;

    allForms.forEach(form => {
      // 1. Anti-spam honeypot injection (hidden from visual & accessibility tree)
      if (!form.querySelector('input[name="_hp_company"]')) {
        const hpInput = document.createElement('input');
        hpInput.type = 'text';
        hpInput.name = '_hp_company';
        hpInput.className = 'hp-field';
        hpInput.tabIndex = -1;
        hpInput.autocomplete = 'off';
        hpInput.setAttribute('aria-hidden', 'true');
        form.appendChild(hpInput);
      }

      // 2. Anti-spam timestamp injection
      let timeInput = form.querySelector('input[name="_form_load_time"]');
      if (!timeInput) {
        timeInput = document.createElement('input');
        timeInput.type = 'hidden';
        timeInput.name = '_form_load_time';
        timeInput.value = String(Date.now());
        form.appendChild(timeInput);
      } else {
        timeInput.value = String(Date.now());
      }

      // 3. Source Page tracking
      let sourceInput = form.querySelector('input[name="source_page"]');
      if (!sourceInput) {
        sourceInput = document.createElement('input');
        sourceInput.type = 'hidden';
        sourceInput.name = 'source_page';
        sourceInput.value = window.location.pathname || document.title;
        form.appendChild(sourceInput);
      }

      // Ensure error box exists
      let errorBox = form.querySelector('.form-error-msg');
      if (!errorBox) {
        errorBox = document.createElement('div');
        errorBox.className = 'form-error-msg';
        errorBox.setAttribute('role', 'alert');
        errorBox.setAttribute('aria-live', 'assertive');
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn && submitBtn.parentNode) {
          submitBtn.parentNode.insertBefore(errorBox, submitBtn);
        } else {
          form.appendChild(errorBox);
        }
      }

      const nameInput = form.querySelector('input[name="name"], #leadName');
      const phoneInput = form.querySelector('input[name="phone"], #leadPhone');
      const courseSelect = form.querySelector('select[name="course"], #leadCourse');
      const timeSelect = form.querySelector('select[name="time"], #leadTime');
      const messageInput = form.querySelector('textarea[name="message"], #leadMessage');
      const submitBtn = form.querySelector('button[type="submit"]');

      // Auto clear error on typing
      [nameInput, phoneInput, courseSelect].forEach(input => {
        if (!input) return;
        input.addEventListener('input', () => {
          input.classList.remove('is-invalid');
          if (errorBox) errorBox.classList.remove('is-visible');
        });
        input.addEventListener('change', () => {
          input.classList.remove('is-invalid');
          if (errorBox) errorBox.classList.remove('is-visible');
        });
      });

      form.addEventListener('submit', async function (e) {
        e.preventDefault();

        // Clear previous error message
        if (errorBox) {
          errorBox.classList.remove('is-visible');
          errorBox.innerHTML = '';
        }

        let isValid = true;
        let firstInvalid = null;

        // Reset errors
        [nameInput, phoneInput, courseSelect].forEach(input => {
          if (input) input.classList.remove('is-invalid');
        });

        // Validate Name
        if (!nameInput || !nameInput.value.trim() || nameInput.value.trim().length < 2) {
          if (nameInput) {
            nameInput.classList.add('is-invalid');
            if (!firstInvalid) firstInvalid = nameInput;
          }
          isValid = false;
        }

        // Validate Vietnamese Phone Number
        const phoneRegex = /^(?:\+?84|0)(?:3|5|7|8|9)\d{8}$/;
        const cleanedPhone = phoneInput ? phoneInput.value.trim().replace(/[\s.-]+/g, '') : '';
        if (!phoneInput || !phoneRegex.test(cleanedPhone)) {
          if (phoneInput) {
            phoneInput.classList.add('is-invalid');
            if (!firstInvalid) firstInvalid = phoneInput;
          }
          isValid = false;
        }

        // Validate Course (if select exists)
        if (courseSelect && !courseSelect.value) {
          courseSelect.classList.add('is-invalid');
          if (!firstInvalid) firstInvalid = courseSelect;
          isValid = false;
        }

        if (!isValid) {
          if (firstInvalid) firstInvalid.focus();
          return;
        }

        const submittedName = nameInput ? nameInput.value.trim() : 'bạn';
        const submittedPhone = cleanedPhone;
        const submittedCourse = courseSelect && courseSelect.value ? courseSelect.value : 'Tư vấn khóa học phù hợp';
        const submittedTime = timeSelect && timeSelect.value ? timeSelect.value : 'Linh hoạt';
        const submittedMessage = messageInput ? messageInput.value.trim() : '';
        const hpVal = form.querySelector('input[name="_hp_company"]')?.value || '';
        const formLoadTime = form.querySelector('input[name="_form_load_time"]')?.value || String(Date.now());
        const sourcePage = form.querySelector('input[name="source_page"]')?.value || window.location.pathname;

        // Real Lead Submission to Server (WordPress REST API with AJAX fallback)
        const originalBtnHtml = submitBtn ? submitBtn.innerHTML : 'GỬI ĐĂNG KÝ TƯ VẤN';
        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.classList.add('is-loading');
          submitBtn.innerHTML = '<span>Đang gửi thông tin... ⏳</span>';
        }

        const payload = {
          name: submittedName,
          phone: submittedPhone,
          course: submittedCourse,
          time: submittedTime,
          message: submittedMessage,
          source_page: sourcePage,
          _hp_company: hpVal,
          _form_load_time: formLoadTime,
        };

        const targetEndpoint = (window.lilychenVars && window.lilychenVars.restUrl)
          ? window.lilychenVars.restUrl
          : '/wp-json/lilychen/v1/lead';

        const reqHeaders = {
          'Content-Type': 'application/json',
        };
        if (window.lilychenVars && window.lilychenVars.nonce) {
          reqHeaders['X-WP-Nonce'] = window.lilychenVars.nonce;
        }

        try {
          const response = await fetch(targetEndpoint, {
            method: 'POST',
            headers: reqHeaders,
            body: JSON.stringify(payload),
          });

          const resData = await response.json();

          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('is-loading');
            submitBtn.innerHTML = originalBtnHtml;
          }

          if (response.ok && resData && resData.success) {
            const successMsgBox = form.querySelector('#formSuccessMsg, .form-success-msg');
            if (successMsgBox) {
              while (successMsgBox.firstChild) {
                successMsgBox.removeChild(successMsgBox.firstChild);
              }

              const iconWrap = document.createElement('div');
              iconWrap.style.cssText = 'width: 44px; height: 44px; border-radius: 50%; background: #d1e7dd; color: #0f5132; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: bold; margin: 0 auto 10px;';
              iconWrap.textContent = '✓';

              const titlePara = document.createElement('div');
              titlePara.style.cssText = 'font-weight: 700; color: #0f5132; font-size: 1.05rem; margin-bottom: 6px; text-align: center;';
              titlePara.textContent = 'Gửi Yêu Cầu Tư Vấn Thành Công!';

              const descPara = document.createElement('p');
              descPara.style.cssText = 'font-size: 0.92rem; color: #4b5563; line-height: 1.6; margin: 0; text-align: center;';
              descPara.textContent = resData.message || ('Cảm ơn ' + submittedName + '! Lily Chen Academy đã nhận được thông tin và sẽ liên hệ qua số ' + submittedPhone + ' trong 24 giờ tới.');

              successMsgBox.appendChild(iconWrap);
              successMsgBox.appendChild(titlePara);
              successMsgBox.appendChild(descPara);

              successMsgBox.classList.add('is-visible');
              successMsgBox.style.display = 'block';

              // Hide inputs for clean confirmation
              form.querySelectorAll('.form-group, .form-submit-btn, .form-privacy-note').forEach(el => {
                el.style.display = 'none';
              });

              successMsgBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
          } else {
            const errMsg = (resData && resData.message) ? resData.message : 'Có lỗi xảy ra khi gửi thông tin. Vui lòng kiểm tra lại hoặc liên hệ hotline.';
            if (errorBox) {
              errorBox.textContent = errMsg;
              errorBox.classList.add('is-visible');
              errorBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
              alert(errMsg);
            }
          }
        } catch (err) {
          console.error('[Lily Chen Academy Theme] Lead form submission network error:', err);
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('is-loading');
            submitBtn.innerHTML = originalBtnHtml;
          }
          if (errorBox) {
            errorBox.textContent = 'Không thể kết nối đến máy chủ. Vui lòng kiểm tra kết nối mạng hoặc gọi hotline để được tư vấn ngay.';
            errorBox.classList.add('is-visible');
          }
        }
      });
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

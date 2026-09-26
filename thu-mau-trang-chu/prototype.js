/**
 * Lily Chen Makeup Academy - Prototype Logic
 * Features:
 * 1. Rhythmic Staggered Word Reveal
 * 2. High-Performance 2D Canvas Particle System (Idle Drift + Proximity Inertia)
 * 3. Accessible Motion Pause/Play Toggle & prefers-reduced-motion support
 * 4. IntersectionObserver & Tab Visibility Power-Saving
 * 5. Mobile Navigation Drawer
 */

(function () {
  'use strict';

  // ---------------------------------------------------------------------------
  // 1. Rhythmic Word Reveal on Page Load
  // ---------------------------------------------------------------------------
  function initTextReveal() {
    // Only animate if user hasn't requested reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!prefersReducedMotion) {
      document.body.classList.add('js-reveal-ready');
    }
  }

  // ---------------------------------------------------------------------------
  // 2. 2D Canvas Particle System
  // ---------------------------------------------------------------------------
  function initParticleCanvas() {
    const canvas = document.getElementById('particleCanvas');
    const heroSection = document.getElementById('heroSection');
    const motionToggleBtn = document.getElementById('motionToggle');
    const motionLabel = document.getElementById('motionLabel');
    if (!canvas || !heroSection) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let width = 0;
    let height = 0;
    let dpr = 1;
    let particles = [];
    let animationFrameId = null;
    let isPaused = false;
    let isHeroVisible = true;
    let isTabVisible = true;

    // Mouse tracking state
    const mouse = {
      x: -9999,
      y: -9999,
      active: false,
      radius: 140 // Proximity interaction distance
    };

    // Check system preference
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced) {
      isPaused = true;
      updateToggleButtonUI();
    }

    // Determine particle count based on viewport width
    function getParticleCount(w) {
      if (w < 768) return 18;
      if (w < 1200) return 32;
      return 48;
    }

    // Particle Class
    class Particle {
      constructor() {
        this.reset(true);
      }

      reset(initial = false) {
        this.x = initial ? Math.random() * width : (Math.random() > 0.5 ? 0 : width);
        this.y = initial ? Math.random() * height : Math.random() * height;
        
        // Base subtle drift velocity (smooth background motion when idle)
        const angle = Math.random() * Math.PI * 2;
        const speed = 0.15 + Math.random() * 0.25;
        this.baseVx = Math.cos(angle) * speed;
        this.baseVy = Math.sin(angle) * speed;

        // Current velocity (reacts to mouse with inertia)
        this.vx = this.baseVx;
        this.vy = this.baseVy;

        // Size & Color
        this.radius = 1.4 + Math.random() * 1.5;
        this.isRose = Math.random() > 0.38;
        this.alpha = 0.25 + Math.random() * 0.25;

        // Subtle sinusoidal wobble
        this.phase = Math.random() * Math.PI * 2;
        this.phaseSpeed = 0.012 + Math.random() * 0.018;
      }

      update() {
        // Natural ambient drift & oscillation
        this.phase += this.phaseSpeed;
        const wobbleX = Math.cos(this.phase) * 0.15;
        const wobbleY = Math.sin(this.phase) * 0.15;

        // Cursor proximity physics (smooth repulsion + inertia)
        if (mouse.active) {
          const dx = this.x - mouse.x;
          const dy = this.y - mouse.y;
          const dist = Math.hypot(dx, dy);

          if (dist < mouse.radius && dist > 1) {
            // Normalized direction away from mouse
            const nx = dx / dist;
            const ny = dy / dist;
            // Eased force: stronger when closer, soft drop-off
            const force = (1 - dist / mouse.radius) * 0.75;
            this.vx += nx * force * 1.1;
            this.vy += ny * force * 1.1;
          }
        }

        // Apply velocity with damping (friction for smooth return to idle)
        this.vx *= 0.94;
        this.vy *= 0.94;

        // Smooth spring-back to ambient base drift
        this.vx += (this.baseVx - this.vx) * 0.025;
        this.vy += (this.baseVy - this.vy) * 0.025;

        // Integrate position
        this.x += this.vx + wobbleX;
        this.y += this.vy + wobbleY;

        // Screen wrap-around with padding
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
          ctx.fillStyle = `rgba(185, 168, 155, ${this.alpha * 0.9})`;
        }
        ctx.fill();
      }
    }

    // Resize canvas respecting devicePixelRatio
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

      // Re-populate particles based on screen size
      const targetCount = getParticleCount(width);
      particles = [];
      for (let i = 0; i < targetCount; i++) {
        particles.push(new Particle());
      }

      // Draw single frame if paused
      if (isPaused) {
        drawFrame();
      }
    }

    // Draw connecting filaments between close particles (delicate constellation aura)
    function drawConnections() {
      const maxDist = 85;
      const count = particles.length;

      for (let i = 0; i < count; i++) {
        for (let j = i + 1; j < count; j++) {
          const dx = particles[i].x - particles[j].x;
          const dy = particles[i].y - particles[j].y;
          const dist = Math.hypot(dx, dy);

          if (dist < maxDist) {
            const lineAlpha = (1 - dist / maxDist) * 0.11;
            ctx.beginPath();
            ctx.moveTo(particles[i].x, particles[i].y);
            ctx.lineTo(particles[j].x, particles[j].y);
            ctx.strokeStyle = `rgba(212, 83, 122, ${lineAlpha})`;
            ctx.lineWidth = 0.75;
            ctx.stroke();
          }
        }
      }
    }

    // Main animation loop
    function loop() {
      if (isPaused || !isHeroVisible || !isTabVisible) {
        animationFrameId = null;
        return;
      }

      ctx.clearRect(0, 0, width, height);

      // Update & render particles
      for (let i = 0; i < particles.length; i++) {
        particles[i].update();
        particles[i].draw();
      }

      // Render subtle connections
      drawConnections();

      animationFrameId = requestAnimationFrame(loop);
    }

    function drawFrame() {
      ctx.clearRect(0, 0, width, height);
      for (let i = 0; i < particles.length; i++) {
        particles[i].draw();
      }
      drawConnections();
    }

    function startAnimation() {
      if (!animationFrameId && !isPaused && isHeroVisible && isTabVisible) {
        animationFrameId = requestAnimationFrame(loop);
      }
    }

    function stopAnimation() {
      if (animationFrameId) {
        cancelAnimationFrame(animationFrameId);
        animationFrameId = null;
      }
    }

    // Mouse & Touch Tracking (Non-blocking: passive listeners on window)
    window.addEventListener('mousemove', e => {
      const rect = heroSection.getBoundingClientRect();
      const inHero = (
        e.clientX >= rect.left &&
        e.clientX <= rect.right &&
        e.clientY >= rect.top &&
        e.clientY <= rect.bottom
      );

      if (inHero) {
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

    // Touch support for mobile interaction
    window.addEventListener('touchmove', e => {
      if (e.touches && e.touches[0]) {
        const touch = e.touches[0];
        const rect = heroSection.getBoundingClientRect();
        const inHero = (
          touch.clientX >= rect.left &&
          touch.clientX <= rect.right &&
          touch.clientY >= rect.top &&
          touch.clientY <= rect.bottom
        );

        if (inHero) {
          mouse.x = touch.clientX - rect.left;
          mouse.y = touch.clientY - rect.top;
          mouse.active = true;
        } else {
          mouse.active = false;
        }
      }
    }, { passive: true });

    window.addEventListener('touchend', () => {
      mouse.active = false;
    }, { passive: true });

    // UI state updater for motion pause/play toggle
    function updateToggleButtonUI() {
      if (!motionToggleBtn) return;
      motionToggleBtn.setAttribute('aria-pressed', String(isPaused));
      const iconPause = motionToggleBtn.querySelector('.icon-pause');
      const iconPlay = motionToggleBtn.querySelector('.icon-play');

      if (isPaused) {
        if (iconPause) iconPause.style.display = 'none';
        if (iconPlay) iconPlay.style.display = 'inline-block';
        if (motionLabel) motionLabel.textContent = 'Chuyển động: Đã tắt';
        motionToggleBtn.setAttribute('aria-label', 'Bật chuyển động hạt nền');
      } else {
        if (iconPause) iconPause.style.display = 'inline-block';
        if (iconPlay) iconPlay.style.display = 'none';
        if (motionLabel) motionLabel.textContent = 'Chuyển động: Bật';
        motionToggleBtn.setAttribute('aria-label', 'Tạm dừng hiệu ứng hạt chuyển động');
      }
    }

    if (motionToggleBtn) {
      motionToggleBtn.addEventListener('click', () => {
        isPaused = !isPaused;
        updateToggleButtonUI();
        if (isPaused) {
          stopAnimation();
          drawFrame();
        } else {
          startAnimation();
        }
      });
    }

    // IntersectionObserver: Pause when hero is scrolled out of view
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        isHeroVisible = entry.isIntersecting;
        if (isHeroVisible) {
          startAnimation();
        } else {
          stopAnimation();
        }
      });
    }, { threshold: 0.05 });

    observer.observe(heroSection);

    // Tab visibility handling: Pause when browser tab is inactive
    document.addEventListener('visibilitychange', () => {
      isTabVisible = !document.hidden;
      if (isTabVisible) {
        startAnimation();
      } else {
        stopAnimation();
      }
    });

    // Handle resize
    let resizeTimer = null;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        resize();
      }, 150);
    }, { passive: true });

    // Initialize
    resize();
    if (!isPaused) {
      startAnimation();
    } else {
      drawFrame();
    }
  }

  // ---------------------------------------------------------------------------
  // 3. Header Scroll Shadow & Sticky Styling
  // ---------------------------------------------------------------------------
  function initHeaderScroll() {
    const header = document.getElementById('siteHeader');
    if (!header) return;

    function handleScroll() {
      if (window.scrollY > 24) {
        header.classList.add('is-scrolled');
      } else {
        header.classList.remove('is-scrolled');
      }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  // ---------------------------------------------------------------------------
  // 4. Mobile Navigation Drawer
  // ---------------------------------------------------------------------------
  function initMobileDrawer() {
    const toggleBtn = document.getElementById('mobileToggle');
    const drawer = document.getElementById('mobileDrawer');
    const closeBtn = document.getElementById('drawerClose');
    const backdrop = document.getElementById('drawerBackdrop');
    if (!toggleBtn || !drawer) return;

    function openDrawer() {
      drawer.classList.add('is-open');
      toggleBtn.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
      if (closeBtn) closeBtn.focus();
    }

    function closeDrawer() {
      drawer.classList.remove('is-open');
      toggleBtn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
      toggleBtn.focus();
    }

    toggleBtn.addEventListener('click', () => {
      const isOpen = drawer.classList.contains('is-open');
      if (isOpen) closeDrawer();
      else openDrawer();
    });

    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (backdrop) backdrop.addEventListener('click', closeDrawer);

    // Close on Escape key
    window.addEventListener('keydown', e => {
      if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
        closeDrawer();
      }
    });

    // Close drawer when any link inside is clicked
    const drawerLinks = drawer.querySelectorAll('a');
    drawerLinks.forEach(link => {
      link.addEventListener('click', () => {
        closeDrawer();
      });
    });
  }

  // ---------------------------------------------------------------------------
  // 5. Initialize All Components
  // ---------------------------------------------------------------------------
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      initTextReveal();
      initParticleCanvas();
      initHeaderScroll();
      initMobileDrawer();
    });
  } else {
    initTextReveal();
    initParticleCanvas();
    initHeaderScroll();
    initMobileDrawer();
  }

})();

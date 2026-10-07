// Adapted from davidpelayo/antigravity-animation, commit 48f23bbf5de85e46339d74488c5237378c68e666.
// GPL-3.0; original source and license: vendor/antigravity-animation/.
// Modified 2026-10-02: Gemini-style floating, breathing, opacity and perspective depth.
document.addEventListener('DOMContentLoaded', () => {

        // --- Configuration & URL Parsing ---
        const params = new URLSearchParams(window.location.search);
        
        const config = {
            particleCount: parseInt(params.get('count')) || 400,
            speedFactor: parseFloat(params.get('speed')) || 0.8,
            bgColor: params.get('bg') ? '#' + params.get('bg').replace('#','') : '#ffffff',
            colors: params.get('fill') 
                ? params.get('fill').split(',').map(c => '#' + c.replace('#','')) 
                : ['#EA4335', '#FBBC05', '#34A853', '#4285F4', '#E8F0FE', '#DADCE0'],
            shape: params.get('shape') || 'circle', // mixed, circle, square, triangle
            gravity: parseFloat(params.get('gravity')) || -0.05,
            usePattern: params.get('pattern') === 'true',
            interactionRadius: 130,
            ringStrength: 0.85,
            waveSpeed: 0.02,
            waveAmplitude: 12,
            lerpSpeed: 0.07,
            breathAmplitude: 0.2,
            focalLength: 700,
            depthAmplitude: 90
        };

        // --- High Performance Sprite Generator ---
        // Pre-renders shapes to offscreen canvases so we just draw images (GPU textures)
        // instead of calculating vector paths and shadows every frame.
        const spriteCache = {};

        function getSprite(color, shapeType) {
            const key = `${color}-${shapeType}`;
            if (spriteCache[key]) return spriteCache[key];

            const size = 64; // High res for crispness
            const center = size / 2;
            const drawSize = 30; // Size of the shape within the canvas
            
            const c = document.createElement('canvas');
            c.width = size;
            c.height = size;
            const cx = c.getContext('2d');

            // Bake Shadow
            cx.shadowColor = "rgba(0,0,0,0.08)";
            cx.shadowBlur = 15;
            cx.shadowOffsetX = 5;
            cx.shadowOffsetY = 5;
            cx.fillStyle = color;

            cx.translate(center, center);

            cx.beginPath();
            if (shapeType === 0) { // Circle
                cx.arc(0, 0, drawSize/2, 0, Math.PI * 2);
            } else if (shapeType === 1) { // Square
                cx.rect(-drawSize/2, -drawSize/2, drawSize, drawSize);
            } else if (shapeType === 2) { // Triangle
                cx.moveTo(0, -drawSize/2);
                cx.lineTo(drawSize/2, drawSize/2);
                cx.lineTo(-drawSize/2, drawSize/2);
                cx.closePath();
            }
            cx.fill();

            spriteCache[key] = c;
            return c;
        }

        // --- Canvas Setup ---
        const canvas = document.getElementById('heroParticleCanvas');
        const ctx = canvas.getContext('2d', { 
            alpha: true,
            desynchronized: true, // Allow async rendering for better performance
            willReadFrequently: false // Optimize for GPU rendering
        });
        let width, height;
        
        // Optimize canvas rendering settings for GPU
        ctx.imageSmoothingEnabled = true;
        ctx.imageSmoothingQuality = 'high';
        
        function resize() {
            const dpr = window.devicePixelRatio || 1;
            width = canvas.parentElement.clientWidth;
            height = canvas.parentElement.clientHeight;
            
            canvas.width = width * dpr;
            canvas.height = height * dpr;
            canvas.style.width = `${width}px`;
            canvas.style.height = `${height}px`;
            ctx.scale(dpr, dpr);
            
            // Re-apply settings after resize
            ctx.imageSmoothingEnabled = true;
            ctx.imageSmoothingQuality = 'high';
        }
        
        window.addEventListener('resize', resize);
        resize();

        // --- Physics & Shapes ---

        class Particle {
            constructor(index) {
                this.index = index;
                this.init(true);
            }

            init(randomY = false) {
                this.x = Math.random() * width;
                this.y = randomY ? Math.random() * height : height + 50;
                
                // Base size logic: The sprite is fixed (64px), so we scale it down
                // to match the desired visual size (5px to 20px)
                this.visualSize = Math.random() * 15 + 5; 
                
                this.vx = (Math.random() - 0.5) * 2 * config.speedFactor;
                this.vy = (Math.random() - 0.5) * 2 * config.speedFactor;
                
                if (!config.usePattern) {
                    if (config.gravity < 0) {
                        this.vy -= Math.random() * 1 * Math.abs(config.gravity);
                    } else {
                        this.y = randomY ? Math.random() * height : -50;
                    }
                } else if (!randomY) {
                     this.x = width/2;
                     this.y = height/2;
                }

                this.color = config.colors[Math.floor(Math.random() * config.colors.length)];
                this.rotation = Math.random() * Math.PI * 2;
                this.rotationSpeed = (Math.random() - 0.5) * 0.05;
                this.type = this.getShapeType();
                
                // Get the pre-rendered sprite for this particle
                this.sprite = getSprite(this.color, this.type);
                
                this.depth = Math.random() * 1 + 0.5;
                this.originU = this.x / width;
                this.originV = this.y / height;
                this.phase = Math.random() * Math.PI * 2;
                this.speedOffset = 0.7 + Math.random() * 0.6;
                this.depthPhase = Math.random() * Math.PI * 2;
                this.baseZ = (Math.random() - 0.5) * 160;
                this.z = this.baseZ;
                this.projection = config.focalLength / (config.focalLength + this.z);
                this.pulse = 1;
                this.alpha = 0.6; 
            }

            getShapeType() {
                if (config.shape === 'circle') return 0;
                if (config.shape === 'square') return 1;
                if (config.shape === 'triangle') return 2;
                return Math.floor(Math.random() * 3);
            }

            getPatternTarget() {
                const cx = width / 2;
                const cy = height / 2;
                const r = Math.min(width, height) * 0.35;
                const total = config.particleCount;
                const t = this.index / total;
                
                let tx = cx, ty = cy;
                let patternType = config.shape === 'mixed' ? 'circle' : config.shape;

                if (patternType === 'circle') {
                    const angle = t * Math.PI * 2 - Math.PI / 2;
                    tx = cx + Math.cos(angle) * r;
                    ty = cy + Math.sin(angle) * r;
                } 
                else if (patternType === 'square') {
                    const side = Math.floor(t * 4);
                    const subT = (t * 4) % 1;
                    switch(side) {
                        case 0: tx = cx - r + (2 * r * subT); ty = cy - r; break;
                        case 1: tx = cx + r; ty = cy - r + (2 * r * subT); break;
                        case 2: tx = cx + r - (2 * r * subT); ty = cy + r; break;
                        default: tx = cx - r; ty = cy + r - (2 * r * subT); break;
                    }
                }
                else if (patternType === 'triangle') {
                    const sides = 3;
                    const sideIdx = Math.floor(t * sides);
                    const subT = (t * sides) % 1;
                    const angles = [-Math.PI/2, -Math.PI/2+(Math.PI*2/3), -Math.PI/2+(2*Math.PI*2/3)];
                    
                    const a1 = angles[sideIdx];
                    const a2 = angles[(sideIdx + 1) % 3];
                    const x1 = cx + Math.cos(a1) * r;
                    const y1 = cy + Math.sin(a1) * r;
                    const x2 = cx + Math.cos(a2) * r;
                    const y2 = cy + Math.sin(a2) * r;
                    
                    tx = x1 + (x2 - x1) * subT;
                    ty = y1 + (y2 - y1) * subT;
                }
                return { x: tx, y: ty };
            }

            update(mouseX, mouseY, time, step) {
                const phase = time * this.speedOffset + this.phase;
                const origin = config.usePattern ? this.getPatternTarget()
                    : { x: this.originU * width, y: this.originV * height };
                const worldX = origin.x + Math.cos(phase) * config.waveAmplitude;
                const worldY = origin.y + Math.sin(phase) * config.waveAmplitude;

                // Slow Z motion is distinct from the faster breathing rhythm.
                this.z = this.baseZ + Math.sin(time * 0.35 + this.depthPhase) * config.depthAmplitude;
                this.projection = config.focalLength / (config.focalLength + this.z);
                let targetX = width / 2 + (worldX - width / 2) * this.projection;
                let targetY = height / 2 + (worldY - height / 2) * this.projection;

                // Apply Gemini's pointer ring in screen coordinates after projection.
                const dx = targetX - mouseX;
                const dy = targetY - mouseY;
                const dist = Math.hypot(dx, dy);
                if (dist < config.interactionRadius && dist > 0.001) {
                    const push = (config.interactionRadius - dist) * config.ringStrength;
                    targetX += dx / dist * push;
                    targetY += dy / dist * push;
                }
                const follow = 1 - Math.pow(1 - config.lerpSpeed, step);
                this.x += (targetX - this.x) * follow;
                this.y += (targetY - this.y) * follow;
                this.pulse = 1 + Math.sin(time * 2 + this.phase) * config.breathAmplitude;
                this.alpha = 0.6 + Math.sin(time + this.phase) * 0.25;
            }

            draw() {
                // Use save/restore for better GPU compositing
                ctx.save();
                ctx.globalAlpha = this.alpha;
                ctx.translate(this.x, this.y);
                ctx.rotate(this.rotation);
                
                // Draw cached sprite instead of vector paths
                // Calculate final render size including the sprite's internal padding
                // The sprite is 64x64, but the visual shape is approx 30x30 inside it.
                // We scale the whole sprite so the visual shape matches 'this.visualSize'.
                
                const scaleFactor = (this.visualSize * this.depth * this.pulse * this.projection) / 30; // 30 is the drawSize in sprite
                const renderSize = 64 * scaleFactor;

                // drawImage is highly optimized by browsers and uses GPU textures
                ctx.drawImage(this.sprite, -renderSize/2, -renderSize/2, renderSize, renderSize);
                
                ctx.restore();
            }
        }

        // --- Animation Loop ---
        const particles = [];
        for(let i = 0; i < config.particleCount; i++) {
            particles.push(new Particle(i));
        }

        let mouseX = -1000;
        let mouseY = -1000;

        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX - canvas.getBoundingClientRect().left;
            mouseY = e.clientY - canvas.getBoundingClientRect().top;
        });
        window.addEventListener('touchmove', (e) => {
            mouseX = e.touches[0].clientX - canvas.getBoundingClientRect().left;
            mouseY = e.touches[0].clientY - canvas.getBoundingClientRect().top;
        });


        // Local motion experiment: retained upstream sprites; adapted particle motion.
        const hero = canvas.parentElement;
        const reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
        let paused = reduced.matches;
        let visible = true;
        let frame = null;
        let motionTime = 0;
        let lastTime = null;
        function render(update, step = 0) {
            ctx.clearRect(0, 0, width, height);
            if (update) {
                motionTime += config.waveSpeed * step;
                for (const p of particles) p.update(mouseX, mouseY, motionTime, step);
            }
            // Paint distant particles first.
            const ordered = particles.slice().sort((a, b) => b.z - a.z);
            for (const p of ordered) p.draw();
        }
        function animate(timestamp) {
            frame = null;
            if (paused || !visible || document.hidden) return;
            const step = lastTime === null ? 1 : Math.min((timestamp - lastTime) / (1000 / 60), 3);
            lastTime = timestamp;
            render(true, step);
            frame = requestAnimationFrame(animate);
        }
        function sync() {
            if (frame !== null) cancelAnimationFrame(frame);
            frame = null;
            lastTime = null;
            const button = document.getElementById('heroMotionToggle');
            const label = document.getElementById('heroMotionLabel');
            if (button) button.setAttribute('aria-pressed', String(paused));
            if (label) label.textContent = paused ? 'Hiệu ứng hạt: Đã dừng' : 'Hiệu ứng hạt: Đang chạy';
            if (!paused && visible && !document.hidden) frame = requestAnimationFrame(animate);
        }
        function clearPointer() { mouseX = mouseY = -1000; }
        hero.addEventListener('mouseleave', clearPointer);
        window.addEventListener('blur', clearPointer);
        window.addEventListener('touchend', clearPointer, {passive:true});
        window.addEventListener('touchcancel', clearPointer, {passive:true});
        document.addEventListener('visibilitychange', sync);
        reduced.addEventListener('change', () => { paused = reduced.matches; sync(); });
        const button = document.getElementById('heroMotionToggle');
        if (button) button.addEventListener('click', () => { paused = !paused; sync(); });
        new IntersectionObserver(entries => { visible = entries[0].isIntersecting; sync(); }).observe(hero);
        window.addEventListener('resize', () => render(false));
        render(false);
        sync();

});

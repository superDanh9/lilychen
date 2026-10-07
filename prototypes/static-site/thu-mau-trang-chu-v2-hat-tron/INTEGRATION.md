# Local hero motion experiment — 2026-10-02

Derived from davidpelayo/antigravity-animation, commit 48f23bbf5de85e46339d74488c5237378c68e666, GPL-3.0. Original source and license retained under vendor/antigravity-animation/.

The particle update/draw logic is now modified; this is NOT the unchanged upstream effect.
Retained: sprite rendering, palette, 400 circles, source base-size and base-depth distributions, course effects.
Added from the user's Gemini sample: continuous circular floating (amplitude 12, wave increment 0.02 at 60 Hz), pointer ring (radius 130, strength 0.85), return interpolation 0.07, circular diameter breathing +/-20%, opacity 0.35–0.85.
Added locally: slowly varying Z, perspective projection with focal length 700 and Z amplitude 90, far-to-near drawing order. Not Google's original algorithm. Time normalized to a 60 Hz baseline; pause, offscreen and reduced-motion controls retained.
Original gravity drift is replaced by motion around normalized origin positions to allow return after pointer exit.
Backup before this change: scratch/davidpelayo-hero-before-breathing.js.
Local prototype only; production unchanged.

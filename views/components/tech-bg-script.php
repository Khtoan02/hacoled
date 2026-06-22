    <script>
    (function() {
        var COLOR_MAIN  = '#d32f2f';
        var COLOR_ALT   = '#dfb931';
        var COLOR_PULSE = '#ffb300';
        var COLOR_DOT   = '#C4941A';
        var GRID        = 40;
        var PART_COUNT  = 50;
        var PART_SPEED  = 0.22;
        var LINK_DIST   = 120;

        function snap(v) { return Math.round(v / GRID) * GRID; }

        function makePath(W, H) {
            var pts = [{ x: snap(Math.random()*W), y: snap(Math.random()*H) }];
            var isDashed = Math.random() > 0.7;
            var color    = Math.random() > 0.45 ? COLOR_MAIN : COLOR_ALT;
            var lw       = Math.random() > 0.8 ? 1.5 : 1.0;
            var alpha    = Math.random() * 0.11 + 0.04;
            var cur = pts[0], angle = Math.floor(Math.random()*8) * (Math.PI/4);
            var segs = Math.floor(Math.random()*4) + 2;
            for (var i = 0; i < segs; i++) {
                var len  = (Math.floor(Math.random()*5)+2) * GRID;
                var next = { x: cur.x + Math.cos(angle)*len, y: cur.y + Math.sin(angle)*len };
                pts.push(next); cur = next;
                angle += (Math.random()>0.5?1:-1) * (Math.random()>0.5 ? Math.PI/2 : Math.PI/4);
            }
            return { pts:pts, isDashed:isDashed, color:color, lw:lw, alpha:alpha };
        }

        function drawPath(ctx, p) {
            if (p.pts.length < 2) return;
            ctx.beginPath();
            ctx.moveTo(p.pts[0].x, p.pts[0].y);
            for (var i = 1; i < p.pts.length; i++) ctx.lineTo(p.pts[i].x, p.pts[i].y);
            ctx.strokeStyle = p.color;
            ctx.lineWidth   = p.lw;
            ctx.globalAlpha = p.alpha;
            ctx.setLineDash(p.isDashed ? [4,6] : []);
            ctx.stroke();
            ctx.globalAlpha = 1; ctx.setLineDash([]);
        }

        function makePulse(path) {
            return { path:path, seg:0, prog:0, speed:0.007+Math.random()*0.012, size:2 };
        }

        function updatePulse(pulse) {
            pulse.prog += pulse.speed;
            if (pulse.prog >= 1) {
                pulse.prog = 0; pulse.seg++;
                if (pulse.seg >= pulse.path.pts.length-1) pulse.seg = 0;
            }
        }

        function drawPulse(ctx, pulse) {
            var p1 = pulse.path.pts[pulse.seg], p2 = pulse.path.pts[pulse.seg+1];
            if (!p1||!p2) return;
            var x = p1.x + (p2.x-p1.x)*pulse.prog;
            var y = p1.y + (p2.y-p1.y)*pulse.prog;
            ctx.beginPath(); ctx.arc(x, y, pulse.size, 0, Math.PI*2);
            ctx.fillStyle = COLOR_PULSE;
            ctx.globalAlpha = 0.45;
            ctx.shadowBlur = 4; ctx.shadowColor = COLOR_PULSE;
            ctx.fill();
            ctx.shadowBlur = 0; ctx.globalAlpha = 1;
        }

        function makeDecoration(x, y) {
            return { x:x, y:y, type:Math.floor(Math.random()*4), r:Math.random()*7+3 };
        }

        function drawDecoration(ctx, d) {
            ctx.strokeStyle = COLOR_MAIN; ctx.fillStyle = COLOR_MAIN;
            ctx.lineWidth = 1.0; ctx.globalAlpha = 0.15;
            if (d.type===0) {
                ctx.beginPath(); ctx.arc(d.x,d.y,2.5,0,Math.PI*2); ctx.fill();
            } else if (d.type===1) {
                ctx.beginPath(); ctx.arc(d.x,d.y,1.5,0,Math.PI*2); ctx.fill();
                ctx.beginPath(); ctx.arc(d.x,d.y,d.r,0,Math.PI*2); ctx.globalAlpha=0.08; ctx.stroke();
            } else if (d.type===2) {
                ctx.beginPath(); ctx.arc(d.x,d.y,d.r,0,Math.PI*2); ctx.globalAlpha=0.10; ctx.stroke();
                ctx.setLineDash([2,4]); ctx.beginPath(); ctx.arc(d.x,d.y,d.r+4,0,Math.PI*2);
                ctx.globalAlpha=0.06; ctx.stroke(); ctx.setLineDash([]);
            } else {
                ctx.beginPath(); ctx.arc(d.x,d.y,2.5,0,Math.PI*2);
                ctx.fillStyle=COLOR_PULSE; ctx.globalAlpha=0.3; ctx.fill();
            }
            ctx.globalAlpha = 1;
        }

        function SectionFX(section) {
            this.section = section;
            this.type    = section.getAttribute('data-tech-bg') || 'circuit';
            this.canvas  = document.createElement('canvas');
            this.canvas.setAttribute('aria-hidden','true');
            this.canvas.style.cssText =
                'position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:0;display:block;';
            this.ctx    = this.canvas.getContext('2d');
            this.active = false; this.animID = null;
            this.paths = []; this.pulses = []; this.decs = []; this.particles = [];
            section.insertBefore(this.canvas, section.firstChild);
            this.resize();
            this.generate();
        }

        SectionFX.prototype.resize = function() {
            this.W = this.canvas.width  = this.section.offsetWidth  || window.innerWidth;
            this.H = this.canvas.height = this.section.offsetHeight || 600;
        };

        SectionFX.prototype.generate = function() {
            var W = this.W, H = this.H, type = this.type;
            this.paths = []; this.pulses = []; this.decs = []; this.particles = [];
            if (type === 'circuit') {
                var numPaths = Math.max(5, Math.floor((W * H) / 60000));
                for (var i = 0; i < numPaths; i++) {
                    var p = makePath(W, H);
                    this.paths.push(p);
                    if (Math.random() > 0.35) this.pulses.push(makePulse(p));
                    this.decs.push(makeDecoration(p.pts[0].x, p.pts[0].y));
                    var last = p.pts[p.pts.length-1];
                    this.decs.push(makeDecoration(last.x, last.y));
                    for (var j = 1; j < p.pts.length-1; j++) {
                        if (Math.random() > 0.7) this.decs.push(makeDecoration(p.pts[j].x, p.pts[j].y));
                    }
                }
            }
            if (type === 'particle') {
                for (var i = 0; i < PART_COUNT; i++) {
                    this.particles.push({
                        x: Math.random()*W, y: Math.random()*H,
                        vx:(Math.random()-0.5)*PART_SPEED, vy:(Math.random()-0.5)*PART_SPEED,
                        r: Math.random()*1.2+0.6
                    });
                }
            }
        };

        SectionFX.prototype.draw = function() {
            if (!this.active) return;
            var ctx = this.ctx, W = this.W, H = this.H, type = this.type;
            ctx.clearRect(0, 0, W, H);
            if (type === 'circuit') {
                for (var i = 0; i < this.paths.length; i++) drawPath(ctx, this.paths[i]);
                for (var i = 0; i < this.decs.length;  i++) drawDecoration(ctx, this.decs[i]);
                for (var i = 0; i < this.pulses.length; i++) {
                    updatePulse(this.pulses[i]);
                    drawPulse(ctx, this.pulses[i]);
                }
            }
            if (type === 'particle') {
                var ps = this.particles;
                for (var i = 0; i < ps.length; i++) {
                    var p = ps[i];
                    p.x += p.vx; p.y += p.vy;
                    if (p.x < 0 || p.x > W) p.vx *= -1;
                    if (p.y < 0 || p.y > H) p.vy *= -1;
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.r + 1.6, 0, Math.PI*2);
                    ctx.fillStyle = COLOR_DOT;
                    ctx.globalAlpha = 0.35;
                    ctx.fill();
                }
                ctx.globalAlpha = 1;
                for (var i = 0; i < ps.length; i++) {
                    for (var j = i+1; j < ps.length; j++) {
                        var a = ps[i], b = ps[j];
                        var dx = a.x-b.x, dy = a.y-b.y;
                        var distSq = dx*dx + dy*dy;
                        if (distSq < LINK_DIST*LINK_DIST) {
                            var al = (1 - Math.sqrt(distSq)/LINK_DIST) * 0.10;
                            ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y);
                            ctx.strokeStyle = 'rgba(204,0,0,'+al+')';
                            ctx.lineWidth = 0.6; ctx.stroke();
                        }
                    }
                }
            }
            var self = this;
            this.animID = requestAnimationFrame(function(){ self.draw(); });
        };

        SectionFX.prototype.start = function() {
            this.active = true;
            if (!this.animID) this.draw();
        };

        SectionFX.prototype.stop = function() {
            this.active = false;
            if (this.animID) { cancelAnimationFrame(this.animID); this.animID = null; }
        };

        function initFX() {
            var sections  = document.querySelectorAll('[data-tech-bg]');
            var instances = [];
            sections.forEach(function(sec) {
                if (getComputedStyle(sec).position === 'static') sec.style.position = 'relative';
                instances.push(new SectionFX(sec));
            });
            var io = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    for (var k = 0; k < instances.length; k++) {
                        if (instances[k].section === entry.target) {
                            if (entry.isIntersecting) instances[k].start();
                            else instances[k].stop();
                            break;
                        }
                    }
                });
            }, { threshold: 0.05 });
            sections.forEach(function(s) { io.observe(s); });
            window.addEventListener('resize', function() {
                instances.forEach(function(fx) { fx.resize(); fx.generate(); });
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initFX);
        } else {
            initFX();
        }
    })();
    </script>

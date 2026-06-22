import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// Register GSAP ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

// Set window global references for flexibility in inline scripts if needed
window.Alpine = Alpine;
window.gsap = gsap;

// Initialize Alpine.js
Alpine.start();

// Premium Animations and Interactions
document.addEventListener('DOMContentLoaded', () => {
  // GSAP Fade in scroll reveal animations
  const fadeElements = document.querySelectorAll('.gsap-reveal');
  fadeElements.forEach((element) => {
    const delay = element.dataset.delay || 0;
    const direction = element.dataset.direction || 'up';
    
    let fromVars = {
      opacity: 0,
      duration: 1,
      delay: parseFloat(delay),
      ease: 'power3.out',
      scrollTrigger: {
        trigger: element,
        start: 'top 85%',
        toggleActions: 'play none none none'
      }
    };
    
    if (direction === 'up') fromVars.y = 40;
    else if (direction === 'down') fromVars.y = -40;
    else if (direction === 'left') fromVars.x = 40;
    else if (direction === 'right') fromVars.x = -40;
    
    gsap.from(element, fromVars);
  });

  // Glowing mouse-follow effect for premium LED product cards
  const glowCards = document.querySelectorAll('.glow-card');
  glowCards.forEach((card) => {
    card.addEventListener('mousemove', (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      
      card.style.setProperty('--mouse-x', `${x}px`);
      card.style.setProperty('--mouse-y', `${y}px`);
    });
  });
});

// Flatsome early initialization patch for sticky headers and click delay
function flatsomeEarlyInit() {
  setTimeout(() => {
    try {
      window.dispatchEvent(new PointerEvent('pointermove', {
        bubbles: true, cancelable: true, clientX: 1, clientY: 1
      }));
    } catch(e) {}
    try {
      window.dispatchEvent(new TouchEvent('touchstart', { bubbles: true, cancelable: true }));
    } catch(e) {}
  }, 0);
}
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', flatsomeEarlyInit, { once: true });
} else {
  flatsomeEarlyInit();
}

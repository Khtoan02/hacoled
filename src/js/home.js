import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('error', (event) => {
  const image = event.target;
  if (!(image instanceof HTMLImageElement)) return;

  const fallback = image.dataset.fallbackSrc;
  if (fallback && image.src !== fallback) {
    delete image.dataset.fallbackSrc;
    image.src = fallback;
    return;
  }

  if (image.dataset.errorAction === 'hide-show-next') {
    image.hidden = true;
    if (image.nextElementSibling) image.nextElementSibling.style.display = 'block';
  }
}, true);

Alpine.data('hacoledNavMenu', (menuId, closeDelay = 180) => ({
  menuId,
  open: false,
  closeTimer: null,
  otherMenuHandler: null,

  init() {
    this.otherMenuHandler = (event) => {
      if (event.detail?.id !== this.menuId) this.closeMenu(false);
    };
    window.addEventListener('hacoled:menu-open', this.otherMenuHandler);
  },

  destroy() {
    window.removeEventListener('hacoled:menu-open', this.otherMenuHandler);
    window.clearTimeout(this.closeTimer);
  },

  openMenu() {
    window.clearTimeout(this.closeTimer);
    if (!this.open) {
      window.dispatchEvent(new CustomEvent('hacoled:menu-open', { detail: { id: this.menuId } }));
      this.open = true;
    }
    this.$nextTick(() => this.loadMenuImages());
  },

  toggleMenu() {
    if (this.open) this.closeMenu(false);
    else this.openMenu();
  },

  scheduleClose() {
    window.clearTimeout(this.closeTimer);
    this.closeTimer = window.setTimeout(() => this.closeMenu(false), closeDelay);
  },

  closeMenu(returnFocus = false) {
    window.clearTimeout(this.closeTimer);
    this.open = false;
    if (returnFocus) this.$nextTick(() => this.$refs.trigger?.focus());
  },

  handleFocusOut(event) {
    if (!this.$root.contains(event.relatedTarget)) this.scheduleClose();
  },

  focusFirst() {
    this.openMenu();
    this.$nextTick(() => window.requestAnimationFrame(() => {
      window.setTimeout(() => this.menuItems()[0]?.focus({ preventScroll: true }), 210);
    }));
  },

  focusItem(direction) {
    const items = this.menuItems();
    if (!items.length) return;
    const current = items.indexOf(document.activeElement);
    const next = current < 0 ? 0 : (current + direction + items.length) % items.length;
    items[next].focus();
  },

  focusBoundary(position) {
    const items = this.menuItems();
    if (!items.length) return;
    items[position === 'end' ? items.length - 1 : 0].focus();
  },

  menuItems() {
    return Array.from(this.$root.querySelectorAll('[role="menuitem"]'));
  },

  loadMenuImages() {
    this.$root.querySelectorAll('img[data-menu-src]').forEach((image) => {
      const source = image.dataset.menuSrc;
      if (!source) return;

      image.addEventListener('load', () => image.classList.add('is-loaded'), { once: true });
      image.addEventListener('error', () => {
        const fallback = image.dataset.fallback;
        if (fallback && image.src !== fallback) image.src = fallback;
      }, { once: true });

      image.src = source;
      delete image.dataset.menuSrc;
    });
  },
}));

Alpine.start();

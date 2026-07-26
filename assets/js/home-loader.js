(() => {
  const loader = document.currentScript;
  if (!loader) return;

  let requested = false;
  let stylesActivated = false;
  let deferredScriptsActivated = false;

  const activateDeferredScripts = () => {
    if (deferredScriptsActivated) return;
    deferredScriptsActivated = true;
    document.querySelectorAll('script[data-hacoled-deferred-script]').forEach((placeholder) => {
      const script = document.createElement('script');
      script.textContent = placeholder.textContent;
      placeholder.replaceWith(script);
    });
  };

  const activateStyles = () => {
    if (stylesActivated) return;
    stylesActivated = true;
    document.querySelectorAll('link[data-hacoled-full-style]').forEach((link) => {
      link.media = 'all';
    });
  };

  const loadBundle = () => {
    if (requested) return;
    requested = true;

    const bundle = document.createElement('script');
    bundle.src = loader.src.replace('home-loader.js', 'home.js');
    bundle.defer = true;
    document.head.appendChild(bundle);
  };

  // A browser may report an idle window before its first meaningful paint.
  // Give rendering priority; any real user interaction still loads instantly.
  ['pointermove', 'touchstart', 'keydown', 'wheel', 'scroll'].forEach((eventName) => {
    window.addEventListener(eventName, () => {
      activateStyles();
      activateDeferredScripts();
      loadBundle();
    }, {
      once: true,
      passive: true,
      capture: true,
    });
  });

  // Do not make complete styling or interactive sections depend on a user
  // gesture. This short fallback keeps first paint light while guaranteeing
  // that mobile visitors receive the same complete page as desktop.
  const activatePage = () => {
    activateStyles();
    activateDeferredScripts();
    loadBundle();
  };
  if ('requestIdleCallback' in window) {
    window.requestIdleCallback(activatePage, { timeout: 1200 });
  } else {
    window.setTimeout(activatePage, 900);
  }
})();

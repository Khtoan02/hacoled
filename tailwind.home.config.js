const base = require('./tailwind.config.js');

module.exports = {
  ...base,
  content: [
    './app/Support/header-menu.php',
    './app/Config/header-menu.php',
    './views/pages/home.php',
    './views/components/headers/header-default.php',
    './views/components/headers/mega/*.php',
    './views/components/footers/footer-default.php',
    './views/components/home/*.php',
    './views/components/product-card.php',
    './src/js/app.js',
  ],
};

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./app/**/*.php",
    "./page-templates/**/*.php",
    "./views/**/*.php",
    "./woocommerce/**/*.php",
    "./src/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        haco: {
          red: '#B31217',
          redHot: '#E60000',
          redDeep: '#8A0B10',
          gold: '#FBBF24',
          goldSoft: '#FFFBEB',
          surface: '#F8F6F5',
          ink: '#1C0505',
          muted: '#5C3030',
        },
        primary: {
          light: '#B31217',   // header/footer brand red
          DEFAULT: '#A30F14', // header/footer middle red
          dark: '#8A0B10',    // header/footer deep red
        },
        accent: {
          red: '#E60000',
          rose: '#B31217',
          orange: '#ea580c',
          gold: '#FBBF24',    // brand gold accent
          border: '#B31217',  // brand border red
        },
        brand: {
          red: '#B31217',      // Đỏ thương hiệu theo header/footer
          hotRed: '#E60000',   // Đỏ nhấn mạnh, dùng tiết chế
          darkRed: '#8A0B10',  // Đỏ sâu chỉ dùng làm điểm neo gradient
          gold: '#FBBF24',     // Vàng premium theo header/footer
          lightGold: '#FFFBEB',// Vàng nhạt (Nền phụ)
          text: '#1C0505',     // Đỏ nâu sâu (thay đen)
          muted: '#5C3030',    // Đỏ xám trung tính
          bg: '#F8F6F5',       // Trắng kem hiện đại
        }
      },
      fontFamily: {
        sans: ['var(--font-body)', 'Inter', 'sans-serif'],
        body: ['var(--font-body)', 'Inter', 'sans-serif'],
        heading: ['var(--font-heading)', 'Outfit', 'sans-serif'],
        display: ['var(--font-display)', 'Outfit', 'sans-serif'],
        caption: ['var(--font-caption)', 'Inter', 'sans-serif'],
        mono: ['var(--font-mono)', 'ui-monospace', 'monospace'],
      },
      boxShadow: {
        'glow-red': '0 0 15px rgba(239, 68, 68, 0.4)',
        'glow-gold': '0 0 15px rgba(251, 191, 36, 0.4)',
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ],
}

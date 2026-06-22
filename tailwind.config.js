/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./app/**/*.php",
    "./views/**/*.php",
    "./woocommerce/**/*.php",
    "./src/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          light: '#7f1d1d',   // brand crimson
          DEFAULT: '#5a0c0c', // brand red maroon
          dark: '#3f0707',    // deep dark red
        },
        accent: {
          red: '#ef4444',
          rose: '#e11d48',
          orange: '#ea580c',
          gold: '#fbbf24',    // brand gold accent
          border: '#991b1b',  // brand border red
        },
        brand: {
          red: '#CC0000',      // Đỏ thương hiệu (Sang, mạnh mẽ)
          darkRed: '#990000',  // Đỏ sậm
          gold: '#F5A623',     // Vàng nghệ thuật (Premium)
          lightGold: '#FDF4E3',// Vàng nhạt (Nền phụ)
          text: '#1C0505',     // Đỏ nâu sâu (thay đen)
          muted: '#5C3030',    // Đỏ xám trung tính
          bg: '#FAFAFA',       // Trắng kem hiện đại
        }
      },
      fontFamily: {
        sans: ['Inter', 'Outfit', 'sans-serif'],
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

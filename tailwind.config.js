/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // toggle via class="dark" di <html>, bukan ikut preferensi OS
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.jsx",
  ],
  theme: {
    extend: {
      colors: {
        // ============ COKLAT KEEMASAN ============
        primary: '#8B5E34',        // Coklat kayu (dominan)
        'primary-dark': '#5C3B1E', // Coklat lebih gelap (hover/dark bg)
        'primary-light': '#A9744A',// Coklat terang
        accent: '#C9952C',         // Gold accent (badge, harga, ikon)
        'accent-dark': '#8B6A1F',
        secondary: '#2B1B0E',       // Teks utama (dark brown, ganti hitam)
        'secondary-light': '#4A3520',

        dark: '#1C140C',            // Background mode gelap
        light: '#FAF6EE',           // Background mode terang (krem hangat)

        navbar: '#6B5A45',

        gray: {
          50: '#FAF8F4',
          100: '#F3EAD8',
          200: '#E7DAC0',
          300: '#D8C6A3',
          400: '#B79E7C',
          500: '#8F7A5C',
          600: '#6B5A45',
          700: '#4A3520',
          800: '#2E2216',
          900: '#1C140C',
        }
      },
      fontFamily: {
        poppins: ['Poppins', 'sans-serif'],
        inter: ['Inter', 'sans-serif'],
      },
      boxShadow: {
        'card': '0 4px 12px rgba(43, 27, 14, 0.08)',
        'card-hover': '0 8px 24px rgba(43, 27, 14, 0.14)',
        'md': '0 4px 6px rgba(43, 27, 14, 0.1)',
      },
      animation: {
        'fade-in': 'fadeIn 0.3s ease-in-out',
        'slide-in': 'slideIn 0.3s ease-in-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideIn: {
          '0%': { transform: 'translateX(100%)' },
          '100%': { transform: 'translateX(0)' },
        },
      }
    },
  },
  plugins: [],
}
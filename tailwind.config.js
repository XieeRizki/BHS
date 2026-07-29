/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // toggle via class="dark" di <html>
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.jsx",
    "./resources/js/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        // ============ COKLAT KEEMASAN ============
        primary: '#8B5E34',        // brown wood (dominant)
        'primary-dark': '#5C3B1E', // darker brown (hover / dark bg)
        'primary-light': '#A9744A',// lighter brown
        accent: '#FFD700',         // bright gold (main accent)
        'accent-dark': '#D4AF37',  // metallic gold darker
        secondary: '#2B1B0E',      // main text (dark brown)
        'secondary-light': '#4A3520',

        dark: '#1C140C',           // dark mode background
        light: '#FAF6EE',          // light mode background (warm cream)

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
        'md': '0 4px 6px rgba(43, 27, 14, 0.10)',
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
      },
      // small helpers for gradient backgrounds
      backgroundImage: theme => ({
        'gradient-primary': 'linear-gradient(135deg, #8B5E34 0%, #FFD700 100%)',
        'gradient-primary-dark': 'linear-gradient(135deg, #5C3B1E 0%, #D4AF37 100%)'
      })
    },
  },
  plugins: [],
}
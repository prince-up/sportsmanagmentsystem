import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './app/**/*.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        brand: {
          50: '#eefbf5',
          100: '#d6f5e5',
          200: '#ade9cb',
          300: '#78d9a8',
          400: '#41c17a',
          500: '#22a35f',
          600: '#17824b',
          700: '#15653c',
          800: '#134f31',
          900: '#114128',
        },
      },
      boxShadow: {
        soft: '0 18px 40px -20px rgba(15, 23, 42, 0.35)',
      },
    },
  },
  plugins: [forms],
};
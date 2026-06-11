/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        chocolate:  '#2C1A0E',
        bordeaux:   '#8B1A1A',
        cream:      '#FDFAF6',
        surface:    '#F5EFE6',
        industrial: '#2E5F8A',
        navy:       '#1E3A5F',
        'navy-dark':'#152C47',
        amber:      '#C07A35',
        dark:       '#0F0806',
        slate:      '#263345',
        'text-secondary': '#6B5A4E',
        border:     '#E8DDD0',
      },
      fontFamily: {
        playfair: ['"Playfair Display"', 'serif'],
        inter:    ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}



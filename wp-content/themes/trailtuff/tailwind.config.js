module.exports = {
  content: [
    "./**/*.php",                   // All PHP files in theme
    "./src/**/*.{html,js}",         // If you have a src folder
    "./template-parts/**/*.php",    // Includes template parts
    "./cpt/**/*.php",               // Custom post types if stored here
    "./functions/**/*.php",         // Optional: custom functions folder
  ],
  safelist: [
    'backdrop-blur-lg',
    'bg-black/70',
    'transition-opacity',
    'duration-300'
  ],
  theme: {
    extend: {
      screens: {
        '3xl': '1750px',
        '4xl': '1900px',
      },
      fontFamily: {
        sans: ['Figtree', 'sans-serif'],
      },
      maxWidth: {
        '8xl': '90rem',   // 1440px
        '9xl': '100rem',  // 1600px
        '10xl': '120rem', // 1920px
      },
    },
  },
  plugins: [],
}
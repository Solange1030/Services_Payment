/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",                // arquivo HTML principal
    "./src/**/*.{vue,js,ts,jsx,tsx}", // todos os componentes Vue e JS/TS
    "./node_modules/flowbite/**/*.js" // necessário para que o Flowbite funcione
  ],
  theme: {
    extend: {
      colors: {

        primary: '#2563EB',
        secondary: '#1E293B',
        accent: '#F59E0B',

        success: '#16A34A',
        danger: '#DC2626',

        background: '#F8FAFC'
      }
    },
  },
  plugins: [
    require('flowbite/plugin') // habilita os componentes JS do Flowbite
  ],
}
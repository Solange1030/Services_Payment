/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",                // arquivo HTML principal
    "./src/**/*.{vue,js,ts,jsx,tsx}", // todos os componentes Vue e JS/TS
    "./node_modules/flowbite/**/*.js" // necessário para que o Flowbite funcione
  ],
  theme: {
    extend: {}, // aqui você pode adicionar cores, fontes, etc.
  },
  plugins: [
    require('flowbite/plugin') // habilita os componentes JS do Flowbite
  ],
}
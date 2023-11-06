/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php","./**/**/*.php"],
  theme: {
    extend: {
      backgroundImage: {
        overlay: "url('./images/theme/layout-bg-1.png')",
        image1: "url('./images/theme/services-bg-01.png')",
        servicesoverlay2: "url('./images/theme/services-overlay-2.png')",
        servicesoverlay3: "url('./images/theme/services-bg-02.png')",
      },
      colors: {
        primary: "#0059A0",
        btn: "#0090CC",
      },
      fontFamily: {
        barlow: ['"Barlow"', "Inter"],
        inter: ['"Inter"', "Barlow"],
      },
      fontSize: {
        banner: "clamp(2.5rem, 2.0821rem + 1.8072vw, 3.4375rem)",
        dynamic: "clamp(1.875rem, 1.5964rem + 1.2048vw, 2.5rem)",
      },
      flexBasis: {
        '570': '570px',
        '500': '500px',
      },
      boxShadow: {
        custom: '0px 4px 32px 0px rgba(0, 0, 0, 0.05);'
      },
      screens: {
        desktop: { max: "1440px" },
        // => @media (max-width: 1279px) { ... }

        laptop_lg: { max: "1366px" },
        // => @media (max-width: 1366px) { ... }

        laptop: { max: "1200px" },
        // => @media (max-width: 1279px) { ... }

        tablet: { max: "1024px" },
        // => @media (max-width: 1023px) { ... }

        // tablet: { max: "767px" },
        // => @media (max-width: 767px) { ... }

        mobile: { max: "639px" },
        // => @media (max-width: 639px) { ... }
      },
      keyframes: {
        fadein: {
          "0%": { opacity: 0 },
          "100%": { opacity: 1 },
        },
      },
      animation: {
        fadein: "fadein 1.2s cubic-bezier(0.390, 0.575, 0.565, 1.000) both",
      },
    },
  },
  corePlugins: {
    aspectRatio: false,
  },
  plugins: [
    require('tailwind-children'),
    require('@tailwindcss/aspect-ratio'),
  ],
};

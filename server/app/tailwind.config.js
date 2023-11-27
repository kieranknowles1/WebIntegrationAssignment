/**
 * Configuration for Tailwind CSS
 *
 * @author Kieran Knowles
 * @generated Github Copilot was used to assist in writing this code.
 */
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './index.html',
    './src/**/*.{js,ts,jsx,tsx}'
  ],
  theme: {
    extend: {},
    colors: {
      // Generated using https://huemint.com/brand-3/#palette=252d35-eef1ee-f18c89-727be0
      // Shades using https://javisperez.github.io/tailwindcolorshades
      background: {
        // 50: '#F2F4F5',
        // 100: '#E4E9EB',
        // 200: '#BEC7CC',
        // 300: '#99A6AD',
        highlight: '#99A6AD',
        topbottom: '#5B6873',
        default: '#252d35'
        // 600: '#1F2730',
        // 700: '#151E29',
        // 800: '#0E1621',
        // 900: '#070D17',
        // 950: '#03070F'
      },
      foreground: {
        // 50: '#FFFFFF',
        // 100: '#FFFFFF',
        // 200: '#FCFCFC',
        // 300: '#FAFAFA',
        topbottom: '#F5F7F5',
        default: '#eef1ee'
        // 600: '#C3DBC3',
        // 700: '#86B586',
        // 800: '#569156',
        // 900: '#316E31',
        // 950: '#154715'
      },
      button: {
        // 50: '#FFFCFA',
        // 100: '#FFFAF5',
        // 200: '#FCECE1',
        // 300: '#FADDCF',
        // 400: '#F7BBAD',
        default: '#f18c89',
        hover: '#DB7370'
        // 700: '#B5514E',
        // 800: '#913531',
        // 900: '#6E1E1D',
        // 950: '#470D0C'
      },
      accent: {
        // 50: '#F7FAFC',
        // 100: '#F0F6FC',
        // 200: '#DAE7F7',
        // 300: '#C2D3F2',
        // 400: '#9BACEB',
        // 500: '#727be0',
        // 600: '#5D66C9',
        // 700: '#4047A8',
        // 800: '#2A3087',
        // 900: '#171D66',
        // 950: '#0A0D42'
      }
    }
  },
  plugins: []
}

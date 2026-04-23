import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin'
import { wordpressPlugin, wordpressThemeJson } from '@roots/vite-plugin';

// Set APP_URL if it doesn't exist for Laravel Vite plugin
if (! process.env.APP_URL) {
  process.env.APP_URL = 'http://gobi.local';
}

export default defineConfig({
  base: '/app/themes/gobi/public/build/',
  server: {
    host: 'gobi.local',
    port: 5173,
    strictPort: true,
    origin: 'http://gobi.local:5173',
    cors: true,
    hmr: {
      host: 'gobi.local',
      port: 5173,
      clientPort: 5173,
      protocol: 'ws',
    },
  },
  plugins: [
    tailwindcss(),
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/editor.css',
        'resources/js/editor.js',
      ],
      refresh: true,
      assets: ['resources/images/**', 'resources/fonts/**'],
    }),

    wordpressPlugin(),

    // Generate the theme.json file in the public/build/assets directory
    // based on the Tailwind config and the theme.json file from base theme folder
    wordpressThemeJson({
      disableTailwindColors: false,
      disableTailwindFonts: false,
      disableTailwindFontSizes: false,
      disableTailwindBorderRadius: false,
    }),
  ],
  resolve: {
    alias: {
      '@scripts': '/resources/js',
      '@styles': '/resources/css',
      '@fonts': '/resources/fonts',
      '@images': '/resources/images',
    },
  },
})

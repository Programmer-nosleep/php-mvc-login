import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  root: 'public',
  plugins: [
    tailwindcss(),
  ],
  server: {
    port: 5173,
    proxy: {
      // semua request selain /js dan /scss dilempar ke PHP backend
      '^/(?!js|scss|node_modules|@vite)(.*)': {
        target: 'http://localhost:8080',
        changeOrigin: true,
      },
    },
  },
  build: {
    outDir: '../public/dist',
    emptyOutDir: true,
  },
})
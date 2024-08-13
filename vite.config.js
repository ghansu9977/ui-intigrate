// vite.config.js
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import path from 'path';

export default defineConfig({
  plugins: [react()],
  build: {
    outDir: path.resolve(__dirname, 'web/js'),
    emptyOutDir: true,
  },
  server: {
    watch: {
      usePolling: true,
    },
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'web/react'),
    },
    extensions: ['.js', '.jsx', '.ts', '.tsx'], // Include TypeScript extensions
  },
});

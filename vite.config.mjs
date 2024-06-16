import { defineConfig } from "vite";
import path from "path";

export default defineConfig({
  root: path.resolve(__dirname, "assets", "src"),
  build: {
    outDir: "../dist/js",
    emptyOutDir: true,
    minify: true,
    rollupOptions: {
      input: {
        index: path.resolve(__dirname, "assets", "src", "index.js"),
      },
      output: {
        entryFileNames: `[name].js`,
        chunkFileNames: `[name].js`,
        assetFileNames: `[name].[ext]`,
      },
      watch: {
        include: path.resolve(__dirname, "assets", "src", "index.js"),
      }
    },
  }
});

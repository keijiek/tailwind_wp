/** @type {import('tailwindcss').Config} */
export default {
  content: ["./templates/**/*.php"],
  theme: {
    extend: {},
  },
  future: {
    hoverOnlyWhenSupported: true,
  },
  corePlugins: {
    // aspect-ratio プラグインを使う場合、バニラの aspectRatio 機能を停める。
    aspectRatio: false,
  },
  plugins: [
    // インストールしなかったものは消す。
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
  ],
}

# WordPress + Tailwind

## 前提

- インストールされたばかりの正常に動いているワードプレス。
- そこに、Tailwind を用いた自作テーマの基礎部分を作っていく。

### なぜ tailwind を使うのか

- 単純には「費用v.s.効果」を考えた結果。
- Bootstrap は、用意されたコンポーネントを並べるだけで作れるデザインなら良い選択肢だが、そうでないなら導入時と導入後のコストの大きさがデメリット。
  - Bootstrap をカスタマイズするには、vite, postcss, autoprefixer 等のツールの知識が必要。Tailwind は tailwindcss を入れるだけで使える。カスタマイズはコンフィグファイルに書く。
  - 不足するスタイルの追加を、手書きの css に依存するなら、css設計の知識が必須。そうでない場合、手書きcssのクソさ加減により保守コストが増大。Tailwind は手書き css に依存せずにすむ。
  - プラグインにより Bootstrap のコンポーネントのような利便性も獲得できる。

---

## Tailwind css の導入

```bash
npm init -y

# 本体 + 4×公式プラグイン。
npm i -D tailwindcss @tailwindcss/typography @tailwindcss/forms @tailwindcss/aspect-ratio @tailwindcss/line-clamp

# tailwind.config.js 生成
npx tailwindcss init --esm
```

### tailwind.config.js を編集

```javascript
/** @type {import('tailwindcss').Config} */
default export {
  // tailwind は、下記のパスのファイルに書かれたクラス名を収集して本番用の css ファイルをビルドする。
  // 下記の場合、templates ディレクトリ内の php ファイルに限定。プロジェクト全体の php ファイルを対象にすることは避けてみた。
  content: [
    "./templates/**/*.php"
  ],
  theme: {
    extend: {},
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
```

### エントリーポイントとなる css ファイルの作成

- このプロジェクトの場合、`./assets/src/index.css`。
- 下記を記入して保存

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### package.json の scripts オブジェクトにスクリプトを追加

```json
{
  "scripts": {
    "tw": "tailwindcss -m -i ./assets/src/index.css -o ./assets/dist/css/tailwind.css --watch",
  },
}
```

- `-m` : minify させるための引数。bootstrap と違い、コード中で使われたクラス名だけが出力されるので、可読性に意味は無い。
- `-i` : インプットファイルのパス。
- `-o` : ビルドファイルの出力先
- `--watch` : 監視モード有効。config ファイルの`content`で設定したファイル群を監視し、それらが保存されたるたびビルドを実行する。

下記コマンドの実行で、そのシェルは tailwind のための監視を継続する。

```bash
npm run tw
```

### .vscode/sftp.json の記述

- vscode の sftp 拡張を使って開発する場合、tailwind がファイルをビルドした瞬間に、出力されたファイルをアップロードする設定を書いておくと便利。
- 下記は ftp(21) の場合の設定。

1. VSCpde の `CTRL + SHIFT + P` に `SFTP:Config` を入力。
1. 設定項目の意味は[公式リポジトリ](https://github.com/Natizyskunk/vscode-sftp)を参照。
1. とりわけ、`watcher` オブジェクトの設定が、ファイルの出力を監視してアップロードする機能の挙動。

```json
{
    "name": "any_name_as_you_wish",
    "host": "hoge.com",
    "protocol": "ftp",
    "port": 21,
    "username": "ftpuser@hoge.com",
    "password": "password",
    "remotePath": "/path/to/theme_dir/",
    "uploadOnSave": true,
    "useTempFile": false,
    "openSsh": false,
    "syncOption": {
        "delete": true,
        "skipCreate": true,
        "ignoreExisting": false,
        "update": false
    },
    "watcher": {
        "files": "assets/dist/**/*",
        "autoUpload": true,
        "autoDelete": false
    },
    "ignore": [
        ".vscode",
        ".git",
        ".DS_Store"
    ]
}

```

ここまでの設定により、指定された範囲下の php ファイルを編集して保存するだけで、本番用の css ファイルがビルドされ、また、自動アップロードもされるようになる。

---

## prism.js の導入

コードブロックのシンタックスハイライト機能をウェブサイトに追加するため。

[prism.js](https://prismjs.com/) の「Download」ページで求める機能を設定し、js と css ファイルをダウンロード。

ダウンロードしたファイルを任意の場所に置き、wordpres に enqueue させる。その際、js ファイルは `</body>`直前に置くので、wp_enqueue_script の第五引数を true に。

設定を変えたい場合、設定とダウンロードをやりなおす。

---

## js をバンドルする方法(vite.js)の導入(optional)

- wordpress に tailwind css を導入する、という観点からは必須の工程ではない。
- 使いたい node パッケージを import するため。(今回は alpine.js を import するため)


# WordPress + Tailwind

## 前提

- インストールされたばかりの正常に動いているワードプレス。
- そこに自作テーマを作っていく。

## Tailwind css の導入

```bash
npm init -y
# 本体 + 4×公式プラグイン
npm i -D tailwindcss @tailwindcss/typography @tailwindcss/forms @tailwindcss/aspect-ratio @tailwindcss/line-clamp
# tailwind.config.js 生成
npx tailwindcss init
```

### tailwind.config.js を編集

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  // tailwind は、下記のパスのファイルに書かれたクラス名を収集して本番用の css ファイルをビルドする。
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
- 下記は ftp(21) の場合の設定。詳しくは[公式リポジトリ](https://github.com/Natizyskunk/vscode-sftp)を参照。

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
    // この watcher オブジェクトが重要。
    "watcher": {
        "files": "assets/dist/**/*",// 監視対象。このパスで生成されるファイルが対象となる。
        "autoUpload": true, // 上記ファイルを自動アップロードする機能。もちろん true
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

[prism.js](https://prismjs.com/) の「Download」ページで求める機能を設定し、js と css ファイルをダウンロード。

ダウンロードしたファイルを任意の場所に置き、wordpres に enqueue させる。

設定を変えたい場合、設定とダウンロードをやりなおす。

---

## js をバンドルする方法(vite.js)の導入(optional)

- wordpress に tailwind css を導入する、という観点からは必須の工程ではない。
- 使いたい node パッケージを import するため。(今回は alpine.js を import するため)


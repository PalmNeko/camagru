

# 設定ファイル

phpのdocker imageの公式ドキュメントより、以下のように設定する。

## php-fpm

 - `$PHP_INI_DIR/php-fpm.conf` 以下に設定ファイルを置いてオーバーライドする。
 - 辞書順で読み込まれる。
 - 読み込まれる順番は、`docker.conf`, `www.conf`, `you file`, `zz-docker.conf`とする必要があるので、
 `z-*.conf`のようなファイル名を使うことをお勧めする。

## php
 - `$PHP_INI_DIR/conf.d/` 以下のディレクトリに設定ファイルを置いてオーバーライドする。
 - 辞書順で読み込まれる。

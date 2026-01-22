
# docker-compose.ymlについて
　configsは設定ファイルを指定しております。このdocker-compose.ymlは、以下のように別のdocker-compose.ymlから使用されることを想定しています。
```yml
# docker-compose.yml
services:
  new-nginx-service:
    extends:
      file: nginx/docker-compose.yml
      service: nginx

configs:
  app_nginx_conf:
    file: YOUR_nginx.conf
  app_nginx_templates:
    file: YOUR_templates/
```
```ini
# .env
NGINX_CONF=app_nginx_conf
NGINX_TEMPLATES=app_nginx_templates
```

> ここで、`.env`と`docker-compose.yml`の config が連携していることに注意してください。
> NGINX_CONFおよびNGINX_TEMPLATESは、`nginx/docker-compose.yml`と密結合しています。

 templatesは、envsubstを使って環境変数で展開されることが想定されています。
 以下の環境変数は、展開されるときの各種設定です。
 - NGINX_ENVSUBST_TEMPLATE_DIR
 - NGINX_ENVSUBST_TEMPLATE_SUFFIX
 - NGINX_ENVSUBST_OUTPUT_DIR
 詳しくは、nginxの公式イメージドキュメントをご覧ください。

ref: https://hub.docker.com/_/nginx

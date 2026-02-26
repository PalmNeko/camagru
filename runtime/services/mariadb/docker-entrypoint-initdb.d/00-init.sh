#!/bin/bash
set -e

echo -e '\e[34m === INIT SCRIPT 00-init.sh === \e[m';

for f in /docker-entrypoint-initdb.d/40-schemes/*.sql; do
  mariadb -u "$MARIADB_USER" --password="$MARIADB_PASSWORD" "$MARIADB_DATABASE" < "$f"
done

if [ "$LOAD_DATA" = "true" ]; then
  for f in /docker-entrypoint-initdb.d/50-data/*.sql; do
    mariadb -u "$MARIADB_USER" --password="$MARIADB_PASSWORD" "$MARIADB_DATABASE" < "$f"
  done
fi

echo -e '[END] \e[34m === INIT SCRIPT 00-init.sh === \e[m';

#!/bin/bash

echo 'title: === mariadbサーバーの代わりにbashを起動します ==='

e_msg() { echo "ERROR:" "$@" > /dev/stderr; }
i_msg() { echo "INFO :" "$@"; }
s_print() { for msg in "$@"; do printf "\"%s\" " "$msg"; done }
dry_run() { i_msg "run => "; s_print "$@"; echo; }
i_run() { dry_run "$@"; "$@"; }

if [ -z "$LOCAL_WORKSPACE_FOLDER" ]; then
    i_msg 'LOCAL_WORKSPACE_FOLDER変数が設定されていないため、設定します。'
    i_msg 'LOCAL_WORKSPACE_FOLDER=/workspace'
    LOCAL_WORKSPACE_FOLDER=/workspace
fi

MOUNT_CONFIGS=(
    "$LOCAL_WORKSPACE_FOLDER/runtime/services/mariadb/datadir:/var/lib/mysql"
    "$LOCAL_WORKSPACE_FOLDER/runtime/services/mariadb/docker-entrypoint-initdb.d:/docker-entrypoint-initdb.d/"
)

mount_opt=()
for mount_config in "${MOUNT_CONFIGS[@]}"; do
    mount_opt+=("-v")
    mount_opt+=("$mount_config")
done

dry_run docker run --rm -it "${mount_opt[@]}" --entrypoint "bash" mariadb

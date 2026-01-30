#!/bin/bash

docker inspect $(docker compose ps -q) | jq -r '
  .[] |
  .Name as $name |
  .NetworkSettings.Ports
  | to_entries[]
  | .value[]?
  | select(.HostPort != "0" and .HostIp=="0.0.0.0")
  | "\($name | ltrimstr("/")) http://localhost:\(.HostPort)"
'

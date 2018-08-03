#!/bin/bash
set -e

sleep 1

# First arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
    set -- apache2-foreground "$@"
fi

/etc/init.d/supervisor start

exec $@

#! /bin/bash

SCRIPT_PATH="`( cd \"$MY_PATH\" && pwd )`"

cd
cd .ssh

ssh-keygen -q -b 1024 -t rsa -N "" -f ./bookcrossing_rsa

ssh-copy-id -i ./bookcrossing_rsa 127.0.0.1

composer install

ln -s $SCRIPT_PATH/vendor/bin/envoy $SCRIPT_PATH/envoy


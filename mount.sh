#!/usr/bin/env bash

APP_NAME=library

# node_modules
[ ! -d ~/mount/${APP_NAME}/node_modules ] && mkdir -p ~/mount/${APP_NAME}/node_modules
[ ! -d ./node_modules ] && mkdir -p ./node_modules
sudo mount --bind ~/mount/${APP_NAME}/node_modules ./node_modules

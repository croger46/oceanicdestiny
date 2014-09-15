#!/bin/bash

# document your project and put everything into a docs/ folder
php ~/phpDocumentor.phar -d app/ -d lib/ -t dev/docs/ --title "Oceanic Destiny Documentation"

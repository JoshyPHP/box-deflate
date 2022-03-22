#!/bin/bash

if [ ! -f "box.phar" ];
then
	curl -Lo box.phar https://github.com/box-project/box/releases/latest/download/box.phar
fi

php -d auto_prepend_file=deflate.php box.phar compile
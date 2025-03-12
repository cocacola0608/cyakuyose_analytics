#!/bin/bash

# PHPのパスを指定
PHP_PATH=/usr/local/php/8.1/bin/php

# Laravelプロジェクトのパスを指定
PROJECT_PATH=/home/xs055278/analytics.cyakuyose.com

# Artisanコマンドを実行
cd $PROJECT_PATH
$PHP_PATH artisan data:insert >> storage/logs/batch.log 2>&1 
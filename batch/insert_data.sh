#!/bin/bash

# PHPのパスを指定
PHP_PATH=/usr/bin/php7.2

# Laravelプロジェクトのパスを指定
PROJECT_PATH=/home/xs055278/cyakuyose.com/public_html/analytics.cyakuyose.com

# Artisanコマンドを実行
cd $PROJECT_PATH
$PHP_PATH artisan data:insert >> storage/logs/batch.log 2>&1 
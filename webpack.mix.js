const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

mix.js('resources/js/app.js', 'public/js')
   .vue()
   .styles([
       'resources/css/app.css'
   ], 'public/css/app.css');

// 開発時のソースマップを無効化
mix.sourceMaps(false);

// バージョニングを無効化（必要に応じて）
mix.disableNotifications();

let mix = require('laravel-mix');
/*mix.options({
    chainWebpack: config => {
        // add the new one
        config.module.rule('svg')
          .test(/\.js$/)
          .use
            .loader('babel-loader?cacheDirectory')
            .include({
              name: "vue2-datatable-component"
            })

      }
});*/
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix
   .js('resources/assets/js/modules/system/method/create.js','public/js/system/method/')
   //.js('resources/assets/js/modules/incidence/solicitudes.js', 'public/js/incidence/')
   .js('resources/assets/js/modules/system/module/create.js','public/js/system/module/');

   //

// /* ----------------------------------------------------------------------------------
// node_modulesに格納されている各プラグインを読み込む
// ---------------------------------------------------------------------------------- */
const gulp = require('gulp');
const browsersync = require("browser-sync").create();
const sass = require('gulp-dart-sass');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const cleanCSS = require('gulp-clean-css');
const postcss = require('gulp-postcss');
const autoprefixer = require("autoprefixer");
const mqpacker = require('css-mqpacker');
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const webpackConfig = require('./webpack.config.js');
const ts = require('gulp-typescript');
const tailwindcss = require('tailwindcss')
const AUTOPREFIXER_BROWSERS = [
  'last 2 version',
  'iOS >= 7',
  'Android >= 4.4',
];

gulp.task('build-server', function (done) {
  browsersync.init({
    server: {
      baseDir: './public/'
    },
  });
  done();
});
gulp.task('browser-reload', function (done) {
  browsersync.reload();
  done();
});

gulp.task('buildScss', function (done) {
  var processors = [
    tailwindcss('./tailwind.config.js'), // TailwindCSSをPostCSSに追加
    autoprefixer({overrideBrowserslist: AUTOPREFIXER_BROWSERS,grid: 'autoplace',}),
    mqpacker(),
  ];
  gulp
    .src("src/scss/style.scss", {sourcemaps: true,})
    .pipe(plumber({errorHandler: notify.onError("<%= error.message %>"),}))
    .pipe(sass({outputStyle: "expanded",}))
    .pipe(postcss(processors)) // メディアクエリ一括化
    .pipe(cleanCSS())
    .pipe(gulp.dest("public/css", {sourcemaps: "./maps",}));
  done();
});

gulp.task('buildWebpack', function (done) {
  gulp
    .src("src/ts/**/*.ts")
    .pipe(plumber({errorHandler: notify.onError("<%= error.message %>"),}))
    .pipe(webpackStream(webpackConfig, webpack))
    .pipe(gulp.dest("public/js/"));
  done();
});

gulp.task('scssFilesSeries',
  gulp.series(
    'buildScss',
    'browser-reload'
  )
);

gulp.task('jsFilesSeries',
  gulp.series(
    'buildWebpack',
    'browser-reload'
  )
);

gulp.task('watchFiles', function (done) {
  gulp.watch("**/*.{html,php}", gulp.series('scssFilesSeries')); // PHPファイルの変更を監視し、SCSSのコンパイルを実行
  gulp.watch("**/*.{html,php}", gulp.task('browser-reload'));
  gulp.watch("images/**/*.{jpg,jpeg,png,svg,gif}", gulp.task('browser-reload'));

  gulp.watch("src/scss/**/*.scss", gulp.series('scssFilesSeries'));
  gulp.watch("src/ts/**/*.ts", gulp.series('jsFilesSeries'));
  done();
});

gulp.task('default', gulp.series('build-server', 'watchFiles', function (done) {
  done();
}));

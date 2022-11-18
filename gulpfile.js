const { src, dest,  watch} = require("gulp");
const compileSass = require('gulp-sass')(require('node-sass'));
const minifyCSS = require('gulp-clean-css');
const sourceMaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const bundleSass = () => {
    return src('./src/scss-css/scss/*.scss')
        .pipe(sourceMaps.init())
        .pipe(compileSass().on('error', compileSass.logError))
        .pipe(minifyCSS())
        .pipe(sourceMaps.write())
        .pipe(dest('./src/scss-css/css'));
}
const bundleJs = () => {
    return src('./src/js/*.js')
        .pipe(sourceMaps.init())
        .pipe(babel({
            plugins: ['@babel/transform-runtime'],
            presets: ['@babel/env']
        }))
        .pipe(sourceMaps.write())
        .pipe(dest('dist'))

}
const devWatch = () => {
    watch('./src/scss-css/scss/*.scss', bundleSass);
    watch('./src/js/*.js', bundleJs);
}
exports.default = bundleSass;
exports.bundlejs = bundleJs;
exports.devWatch = devWatch;


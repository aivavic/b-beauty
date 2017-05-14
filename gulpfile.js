var gulp = require('gulp');
var sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
var minifyCSS = require('gulp-csso');
const autoprefixer = require('gulp-autoprefixer');
//const imagemin = require('gulp-imagemin');

gulp.task('css', function(){
    return gulp.src('./scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        //.pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], {cascade: true})) // Создаем префиксы
        .pipe(minifyCSS())

        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('build/css'))
});

//gulp.task('image', function(){
//    return gulp.src('src/images/*')
//        .pipe(imagemin())
//        .pipe(gulp.dest('images'))
//});

gulp.task('default', [ 'css' ]);
gulp.task('watch', function () {
    gulp.watch('./scss/**/*.scss', ['css']);
});
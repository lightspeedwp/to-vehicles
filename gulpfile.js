var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sort = require('gulp-sort');
var wppot = require('gulp-wp-pot');

gulp.task('default', function() {	 
	console.log('Use the following commands');
	console.log('--------------------------');
	console.log('gulp js				to compile the to-vehicles.js to to-vehicles.min.js');
	console.log('gulp compile-js		to compile both JS files above');
	console.log('gulp watch				to continue watching all files for changes, and build when changed');
	console.log('gulp wordpress-pot		to compile the lsx-mega-menus.pot');
	console.log('gulp reload-node-js	Copy over the .js files from teh various node modules');
});

gulp.task('js', function (done) {
	return gulp.src('assets/js/to-vehicles.js')
		.pipe(concat('to-vehicles.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js')),
		done();
});

gulp.task('compile-js', gulp.series( ['js'] , function(done) {
	done();
}));

gulp.task('watch-js', function (done) {
	done();
	return gulp.watch('assets/js/to-vehicles.js', gulp.series('compile-js'));
});

gulp.task('watch', gulp.series( ['watch-js'] , function(done) {
	done();
}));

gulp.task('wordpress-pot', function (done) {
	return gulp.src('**/*.php')
		.pipe(sort())
		.pipe(wppot({
			domain: 'to-vehicles',
			destFile: 'to-vehicles.pot',
			package: 'to-vehicles',
			bugReport: 'https://www.lsdev.biz/product/tour-operator-vehicles/issues',
			team: 'LightSpeed <webmaster@lsdev.biz>'
		}))
		.pipe(gulp.dest('languages')),
		done();
});
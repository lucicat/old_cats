let gulp = require('gulp'),
		sass = require('gulp-sass'),
		sourcemaps = require('gulp-sourcemaps'),
		concat = require('gulp-concat'),
		babel = require('gulp-babel'),
		sync = require('browser-sync').create(),
		reload = sync.reload;

gulp.task('babel', () => {
	return gulp.src('./js/*.js')
	.pipe(sourcemaps.init())
	.pipe(babel({
		minified:true,
		comments:false
	}))
	.pipe(concat('all.js'))
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('./jsmin/'));
});


//////////////////////
//sass translaters 
//for home
gulp.task('home', () => {
	return gulp.src('./scss/home/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/home/'))
	.pipe(sync.stream());
});

// for cats  
gulp.task('cats', () => {
	return gulp.src('./scss/cats/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/cats/'))
	.pipe(sync.stream());
});

// full cats 
gulp.task('fullcat', () => {
	return gulp.src('./scss/fullcat/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/fullcat/'))
	.pipe(sync.stream());
});

//for thankreg
gulp.task('thankreg', () => {
	return gulp.src('./scss/thankreg/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/thankreg/'))
	.pipe(sync.stream());
});

// for select conversation 
gulp.task('selectconversation', () => {
	return gulp.src('./scss/selectconversation/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/selectconversation/'))
	.pipe(sync.stream());
});

// for select conversation 
gulp.task('conversation', () => {
	return gulp.src('./scss/conversation/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/conversation/'))
	.pipe(sync.stream());
});

// for registration 
gulp.task('registration', () => {
	return gulp.src('./scss/registration/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/registration/'))
	.pipe(sync.stream());
});

// for news 
gulp.task('news', () => {
	return gulp.src('./scss/news/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/news/'))
	.pipe(sync.stream());
});

// for fullnews 
gulp.task('fullnews', () => {
	return gulp.src('./scss/fullnews/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/fullnews/'))
	.pipe(sync.stream());
});

// for contacts 
gulp.task('contacts', () => {
	return gulp.src('./scss/contacts/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/contacts/'))
	.pipe(sync.stream());
});

// for common 
gulp.task('common', () => {
	return gulp.src('./scss/common/**/*.scss')
	.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
	.pipe(gulp.dest('./css/common/'))
	.pipe(sync.stream());
});

// end task for scss 
///////////////////////


gulp.task('watch', () => {
	sync.init({
		server: {
			baseDir: "./"
		}
	});

	gulp.watch('./*.html').on('change', reload);
	gulp.watch('./**/*.html').on('change', reload);

	gulp.watch('./js/**/*.js', ['babel']).on("change", reload);
	
	gulp.watch('./scss/contacts/**/*.scss', 					['contacts']).on('change', reload);
	gulp.watch('./scss/cats/**/*.scss', 							['cats']).on('change', reload);
	gulp.watch('./scss/home/**/*.scss', 							['home']).on('change', reload);
	gulp.watch('./scss/conversation/**/*.scss', 			['conversation']).on('change', reload);
	gulp.watch('./scss/fullcat/**/*.scss', 						['fullcat']).on('change', reload);
	gulp.watch('./scss/fullnews/**/*.scss', 					['fullnews']).on('change', reload);
	gulp.watch('./scss/news/**/*.scss', 							['news']).on('change', reload);
	gulp.watch('./scss/registration/**/*.scss', 			['registration']).on('change', reload);
	gulp.watch('./scss/selectconversation/**/*.scss', ['selectconversation']).on('change', reload);
	gulp.watch('./scss/thankreg/**/*.scss', 					['thankreg']).on('change', reload);
	gulp.watch('./scss/common/**/*.scss', 						['common']).on('change', reload);

});

gulp.task('default', ['watch']); 	

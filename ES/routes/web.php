<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::post('/login/checklogin','LoginController@checklogin')->middleware('access');
Route::post('/login/checklogin','LoginController@checklogin');
Route::get('/logout', 'LoginController@logout');

Auth::routes();

Route::group(['middleware' => 'admin'], function() {
    
    Route::get('/', function () { return view('dashboard'); });
    Route::get('/dashboard', 'DashboardController@index');
    
    Route::get('/404', function () { return view('404'); });

    Route::resource('students', 'StudentController');
    Route::post('students/update', 'StudentController@update')->name('students.update');
    Route::get('students/destroy/{id}','StudentController@destroy');
    Route::get('/studentPdf/pdf','StudentController@pdf');
    
    Route::get('/faculty', 'FacultyController@index')->name('faculty.index');
    Route::post('/faculty/store', 'FacultyController@store')->name('faculty.store');
    Route::get('faculty/destroy/{id}','FacultyController@destroy');
    Route::get('faculty/edit/{id}','FacultyController@edit');
    Route::post('/faculty/update', 'FacultyController@update')->name('faculty.update');

    
    Route::get('/setting/position', 'AdminController@position')->name('setting.position');
    Route::post('/setting/position/store/', 'AdminController@storeposition')->name('setting.storeposition');
    Route::get('/setting/position/destroy/{id}','AdminController@destroyposition');
    
    Route::get('/setting/question', 'AdminController@question')->name('setting.question');
    Route::get('/setting/question/active', 'AdminController@active')->name('question.active');
    Route::post('/setting/question/store/', 'AdminController@storequestion')->name('setting.storequestion');
    Route::get('setting/question/set/{id}','AdminController@set');
    Route::post('/setting/position/setnumber/', 'AdminController@setnumber')->name('question.setnumber');
    Route::get('/setting/question/edit/{id}','AdminController@editquestion');
    Route::post('/setting/question/update/', 'AdminController@updatequestion')->name('setting.updatequestion');
    Route::get('/setting/question/destroy/{id}','AdminController@destroyquestion');

    Route::get('/setting', 'AdminController@admin')->name('setting.admin');
    Route::post('/admin/store', 'AdminController@store')->name('admin.store');
    Route::post('/admin/update', 'AdminController@update')->name('admin.update');
    Route::get('admin/edit/{id}','AdminController@edit');
    Route::get('admin/destroy/{id}','AdminController@destroy');
    Route::get('admin/deactivate/{id}','AdminController@deactivate');
    Route::get('admin/activate/{id}','AdminController@activate');

    Route::get('/course', 'CourseController@index')->name('course.index');
    Route::post('/course/store', 'CourseController@store')->name('course.store');
    Route::get('course/destroy/{id}','CourseController@destroy');
    Route::get('course/edit/{id}','CourseController@edit');
    Route::post('/course/update', 'CourseController@update')->name('course.update');

    Route::get('/subject', 'SubjectController@index')->name('subject.index');
    Route::post('/subject/store', 'SubjectController@store')->name('subject.store');
    Route::get('subject/destroy/{id}','SubjectController@destroy');
    Route::get('subject/edit/{id}','SubjectController@edit');
    Route::post('/subject/update', 'SubjectController@update')->name('subject.update');

    Route::get('/schedule', 'ScheduleController@index')->name('schedule.index');
    Route::post('/schedule/store', 'ScheduleController@store')->name('schedule.store');
    Route::get('/schedule/edit/{id}','ScheduleController@edit');
    Route::post('/schedule/update', 'ScheduleController@update')->name('schedule.update');
    Route::get('/schedule/destroy/{id}','ScheduleController@destroy');

    Route::get('/adminprofile', 'AdminProfileController@index')->name('index');

    Route::get('report', 'ReportController@index')->name('report.index');
    Route::get('report/preview', 'ReportController@preview')->name('report.preview');

});

Route::group(['middleware' => 'student'], function() {
    Route::get('/profile', 'ProfileController@index')->name('index');
    Route::get('/evaluate', 'EvaluateController@index')->name('evaluate.index');
    Route::get('/evaluate/rate/{id}','EvaluateController@rate');
    Route::get('/evaluate/score', 'EvaluateController@score')->name('evaluate.score');
});

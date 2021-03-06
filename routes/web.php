<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*


/* Route::get('/{any}', function() {
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*'); */
//Route::get('/admin', function () {
//    return view('welcome');
//});
Route::get('/', function() {
    return view('welcome');
});
//Routes for the admin page.
Route::get('admin/login', 'App\Http\Controllers\AdminController@login');
Route::get('admin', 'App\Http\Controllers\AdminController@index');
Route::post('admin/checkLogin', 'App\Http\Controllers\AdminController@checkLogin');
Route::get('admin/logout', 'App\Http\Controllers\AdminController@logout');
Route::get('admin/register', 'App\Http\Controllers\AdminController@teacherRegister');
Route::post('admin', 'App\Http\Controllers\AdminController@store');
Route::get('admin/teachers', 'App\Http\Controllers\AdminController@getAllTeacher');
Route::delete('admin/teacher/{id}', 'App\Http\Controllers\AdminController@deleteTeacherById');

Route::get('admin/student/register', 'App\Http\Controllers\AdminController@studentRegister');
Route::post('admin/student/store', 'App\Http\Controllers\AdminController@storeStudent');
Route::get('admin/student', 'App\Http\Controllers\AdminController@getAllStudent');
Route::post('admin/student/update', 'App\Http\Controllers\AdminController@updateCourseAndTicket');
Route::get('admin/student/{id}/history', 'App\Http\Controllers\AdminController@getStudentHistoryById');
Route::delete('admin/student/{id}', 'App\Http\Controllers\AdminController@deleteStudentById');

//Routes for the teacher page.
Route::get('teacher', 'App\Http\Controllers\TeacherController@index');
Route::get('teacher/login', 'App\Http\Controllers\TeacherController@login');
Route::post('teacher/checklogin', 'App\Http\Controllers\TeacherController@checkLogin');
Route::get('teacher/logout', 'App\Http\Controllers\TeacherController@logout');
Route::get('teacher/edit/{id}', 'App\Http\Controllers\TeacherController@edit');
Route::post('teacher/update', 'App\Http\Controllers\TeacherController@update');
Route::get('teacher/booking', 'App\Http\Controllers\TeacherController@availableSlot');
Route::get('teacher/slot/{id}/{date}', 'App\Http\Controllers\TeacherController@slotDetailDate');
Route::get('teacher/slot/edit/{id}/{date}', 'App\Http\Controllers\TeacherController@editDetailDate');
Route::post('teacher/status/update', 'App\Http\Controllers\TeacherController@statusUpdate');
Route::delete('teacher/removeImage/{id}', 'App\Http\Controllers\TeacherController@removeImage');
//Route for the student page.
Route::post('student/checklogin', 'App\Http\Controllers\StudentController@checkLogin');
Route::get('student/logout', 'App\Http\Controllers\StudentController@logout');
Route::get('student/login', 'App\Http\Controllers\StudentController@login');
Route::get('student', 'App\Http\Controllers\StudentController@index');
Route::get('student/slot', 'App\Http\Controllers\StudentController@availableSlot');
Route::get('student/teacherlist', 'App\Http\Controllers\StudentController@getAllTeacher');
Route::get('student/edit/{id}', 'App\Http\Controllers\TeacherController@edit');
Route::post('student/update', 'App\Http\Controllers\StudentController@update');
Route::get('student/teacher/detail/{id}', 'App\Http\Controllers\StudentController@getTeacherDetail');
Route::get('student/history', 'App\Http\Controllers\StudentController@getStudentHistory');
Route::get('student/profile', 'App\Http\Controllers\StudentController@getStudentInfoById');
Route::get('student/slot/{date}', 'App\Http\Controllers\StudentController@availableSlotDetailDate');
Route::get('student/slot/detail/{id}/{date}', 'App\Http\Controllers\StudentController@slotDetailDate');
Route::get('student/contact/{id}/{date}/{time}/{status}', 'App\Http\Controllers\StudentController@contactDetail');
Route::post('student/booked', 'App\Http\Controllers\StudentController@storeBooked');
//utility routes
Route::post('multiple-image/store', 'App\Http\Controllers\CompanyImagesController@multipleImageStore')->name('multiple.image.store');
Route::get('calendar-event', 'App\Http\Controllers\CalenderController@index');
Route::post('calendar-crud-ajax', 'App\Http\Controllers\CalenderController@calendarEvents');
//hidden routes
/* Route::delete('admin/company/{id}', 'App\Http\Controllers\CompanyController@deleteCompanyById');
Route::get('company/details/{id}', 'App\Http\Controllers\CompanyController@getCompanyById');
Route::patch('company/{id}', 'App\Http\Controllers\CompanyController@update'); */


/* Route::get('care-taxi', 'App\Http\Controllers\CareTaxiController@index');
Route::get('care-taxi/login', 'App\Http\Controllers\CareTaxiController@login');
Route::get('care-taxi/booking', 'App\Http\Controllers\CareTaxiController@availableSlot');

Route::post('care-taxi/status/update', 'App\Http\Controllers\CareTaxiController@statusUpdate');
Route::get('care-taxi/company/edit/{id}', 'App\Http\Controllers\CareTaxiController@edit');
Route::post('care-taxi/company/update', 'App\Http\Controllers\CareTaxiController@update');

Route::post('care-taxi/checklogin', 'App\Http\Controllers\CareTaxiController@checkLogin');
Route::get('care-taxi/logout', 'App\Http\Controllers\CareTaxiController@logout'); */

Route::get('care-taxi/slot/{id}/{date}', 'App\Http\Controllers\CareTaxiController@slotDetailDate');
Route::get('care-taxi/slot/edit/{id}/{date}', 'App\Http\Controllers\CareTaxiController@editDetailDate');
Route::delete('care-taxi/removeImage/{id}', 'App\Http\Controllers\CompanyImagesController@removeImage');



Route::get('user', 'App\Http\Controllers\UserController@index');
Route::get('user/companylist', 'App\Http\Controllers\UserController@getAllCompany');
Route::get('user/company/detail/{id}', 'App\Http\Controllers\UserController@getCompanyDetail');
Route::get('user/slot/detail/{id}/{date}', 'App\Http\Controllers\UserController@slotDetailDate');
Route::get('user/slot/{date}', 'App\Http\Controllers\UserController@availableSlotDetailDate');
Route::get('user/slot', 'App\Http\Controllers\UserController@availableSlot');
Route::get('user/contact/{id}/{date}/{time}/{status}', 'App\Http\Controllers\UserController@contactDetail');

Route::post('user/checklogin', 'App\Http\Controllers\UserController@checkLogin');
Route::get('user/logout', 'App\Http\Controllers\UserController@logout');
Route::get('user/login', 'App\Http\Controllers\UserController@login');
//Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'UserController@pagenotfound']);
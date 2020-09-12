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
*/

Route::get('/','LoginController@index');
Route::post('/login','LoginController@store')->name('pasok');
Route::get('/logout','LoginController@logout')->name('gawas');
Route::get('/change-password/{id}','ChangepasswordController@change_password');
Route::post('/change-password/{id}','ChangepasswordController@post_change_password');

Route::get('/adjustment/delete/{id}','AdjustmentController@delete');
Route::resource('adjustments','AdjustmentController');

Route::get('/employee/other-info/{id}','EmployeeController@other_info');
Route::get('/employee/delete-dependent/{id}','EmployeeController@delete_dependent');
Route::get('/employee/delete-education/{id}','EmployeeController@delete_education');
Route::get('/employee/delete-work/{id}','EmployeeController@delete_work');
Route::get('/employee/delete-seminar/{id}','EmployeeController@delete_seminar');

Route::post('/employee/add-dependent/{id}','EmployeeController@store_dependent');
Route::patch('/employee/update-dependent/{id}','EmployeeController@update_dependent');
Route::post('/employee/add-education/{id}','EmployeeController@store_education');
Route::patch('/employee/update-education/{id}','EmployeeController@update_education');
Route::post('/employee/add-work/{id}','EmployeeController@store_work');
Route::patch('/employee/update-work/{id}','EmployeeController@update_work');
Route::post('/employee/add-seminar/{id}','EmployeeController@store_seminar');
Route::patch('/employee/update-seminar/{id}','EmployeeController@update_seminar');
Route::resource('employees','EmployeeController');

Route::resource('banks','BankController');
Route::resource('campuses','CampusController');
Route::resource('deductions','DeductionController');

Route::get('/employee-leave/delete/{id}','EmployeeleaveController@delete');
Route::get('/employee-leave/delete-leave-date/{id}','EmployeeleaveController@delete_leave_date');
Route::resource('employee-leaves','EmployeeleaveController');

Route::get('/employee-loan/delete/{id}','EmployeeloanController@delete');
Route::resource('employee-loans','EmployeeloanController');

Route::get('/employee-offense/delete/{id}','EmployeeoffenseController@delete');
Route::resource('employee-offenses','EmployeeoffenseController');

Route::get('/employee-overtime/delete/{id}','EmployeeovertimeController@delete');
Route::resource('employee-overtimes','EmployeeovertimeController');

Route::get('/holiday/delete/{id}','HolidayController@delete');
Route::resource('holidays','HolidayController');

Route::resource('leaves','LeaveController');
Route::resource('loans','LoanController');

Route::resource('requirements','RequirementController');
Route::resource('sanctions','SanctionController');

Route::get('/schedule-deduction/delete/{id}','ScheduledeductionController@delete');
Route::resource('schedule-deductions','ScheduledeductionController');

Route::resource('violations','ViolationController');

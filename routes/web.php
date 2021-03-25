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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projectSummary', 'ProjectSummaryController@index');
Route::get('/projectSummary/export', 'ProjectSummaryController@exportProjectSummary');
Route::get('/picSummary', 'ProjectSummaryController@picSummary');
Route::get('/gantt-Chart', 'ProjectSummaryController@ganttChart');
Route::get('/picDuration','ProjectSummaryController@picDuration');
Route::get('/picDurations/{id?}','ProjectSummaryController@picDurationJson');
Route::get('/getDataTooltip/{id_tasks?}', 'ProjectSummaryController@GetDataTooltip');
Route::get('/picSummary/export', 'ProjectSummaryController@exportPicSummary');
Route::get('/login','Auth\LoginController@login');
Route::get('/logoff','Auth\LoginController@logOff');
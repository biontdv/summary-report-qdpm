<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/pivotSummaryProjectApi', 'Api\PivotSummaryProjectController@pivotSummaryProject');
Route::get('/pivotPicSummaryApi', 'Api\PivotPicSummaryController@pivotPicSummary');
Route::get('/queryOpenTaskPicSummaryApi', 'Api\QueryOpenTaskPicSummaryController@queryOpenTaskPicSummary');
Route::get('/queryOpenTaskProjectSummaryApi', 'Api\QueryOpenTaskProjectSummaryController@queryOpenTaskProjectSummary');
Route::get('/projectSummaryApi', 'Api\ProjectSummaryController@projectSummary');
Route::get('/picSummaryApi', 'Api\PicSummaryController@picSummary');
Route::get('/projectApi', 'Api\ProjectController@project');
Route::get('/picIdle','Api\picDurationController@picDuration');
Route::get('/picIdleDetail','Api\PicIdleDetailController@picIdleDetail');
Route::get('/taskApi', 'Api\TaskController@task');
Route::get('/loginApi', 'Api\LoginController@login');
Route::get('/getDataUserApi', 'Api\GetUserNameController@getDataUser');
Route::get('/getDataTester', 'Api\TesterController@tester');
Route::get('/taskApiPic','Api\TaskPicController@taskPic');
Route::get('/totalTicketApi','Api\TotalTicketController@totalTicket');
Route::get('/detailTicketApi','Api\DetailTicketController@detailTicket');

Route::get('/UatDate','Api\UatDatesController@uatDate');

Route::get('/group','Api\GroupController@group');
Route::get('/groupSummary','Api\GroupDetailController@groupSummary');
Route::get('/pivotGroupSummaryApi','Api\pivotSummaryGroupController@pivotSummaryGroup');
Route::get('/latestPicTask','Api\LatestTaskPicController@getLatestTaskPic');

Route::get('/taskMoreDetail', 'Api\TaskController@taskMoreDetail');
Route::get('/taskMoreDetailByUser', 'Api\TaskController@taskMoreDetailByUser');
Route::get('/taskOpenCount', 'Api\TaskController@taskOpenCount');
Route::get('/taskOpenSummary', 'Api\TaskController@taskOpenSummary');
Route::get('/taskUpdateByBA', 'Api\TaskController@taskUpdateByBA');
Route::get('/taskUpdateByBADetail', 'Api\TaskController@taskUpdateByBADetail');
Route::get('/taskOpenPIC', 'Api\TaskController@taskOpenPIC');
Route::get('/tasksCompletedCount', 'Api\TaskController@tasksCompletedCount'); 
Route::get('/tasksCompletedSummary', 'Api\TaskController@tasksCompletedSummary');
Route::get('/taskCompletedDate', 'Api\TaskController@taskCompletedDate');

//add new

Route::get('/userlist','Api\UserController@list');
Route::get('/taskproject', 'Api\TaskController@taskProject');
Route::get('/TaskAttachFile', 'Api\TaskController@TaskAttachmentFile');
Route::get('/projectOverview','Api\DashboardMobileController@getProjectOverview');

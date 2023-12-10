<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'StaticController@index');
Route::post('/news/{slug}', 'StaticController@news');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', 'UserController@index');

    Route::post('/seen-all', 'UserController@seenAll');
    Route::post('/get-new-messages', 'UserController@getNewMessages');

    Route::get('/users/{slug?}', 'UserController@users');
    Route::post('/user', 'UserController@editUser');
    Route::post('/delete-user', 'AdminController@deleteUser');

    Route::get('/tasks/sub_task/{slug?}', 'UserController@subTask');
    Route::post('/sub_task', 'UserController@editSubTask');
    Route::post('/delete-sub-task', 'UserController@deleteSubTask');

    Route::get('/tasks/{slug?}/{subslug?}', 'UserController@tasks');
    Route::post('/task', 'UserController@editTask');
    Route::post('/delete-task', 'UserController@deleteTask');

    Route::get('/customers/{slug?}', 'UserController@customers');
    Route::post('/customer', 'UserController@editCustomer');
    Route::post('/delete-customer', 'AdminController@deleteCustomer');

    Route::get('/banks/{slug?}', 'UserController@banks');
    Route::post('/bank', 'UserController@editBank');
    Route::post('/delete-bank', 'UserController@deleteBank');

    Route::get('/bills/{slug?}', 'UserController@bills');
    Route::post('/bill', 'UserController@editBill');
    Route::post('/delete-bill', 'UserController@deleteBill');

    Route::post('/get-bill-value', 'UserController@getBillsValue');
    Route::post('/get-convention-number', 'UserController@getConventionNumber');

    Route::get('/print-doc/{slug}', 'UserController@printDoc');

    Route::get('/statistics/{slug?}', 'AdminController@statistics');

    Route::get('/seo', 'AdminController@seo');
    Route::post('/seo', 'AdminController@editSeo');

    Route::get('/settings', 'AdminController@settings');
    Route::post('/settings', 'AdminController@editSettings');

    Route::get('/chapters/news/{slug?}', 'AdminController@news');
    Route::post('/news/{slug?}', 'AdminController@editNews');
    Route::post('/delete-news', 'AdminController@deleteNews');

    Route::get('/chapters/{slug?}/{subSlug?}', 'AdminController@chapters');
    Route::post('/chapter', 'AdminController@editChapter');

    Route::post('/work', 'AdminController@editWork');
    Route::post('/delete-work', 'AdminController@deleteWork');

    Route::get('/questions/{slug?}', 'AdminController@questions');
    Route::post('/question', 'AdminController@editQuestion');
    Route::post('/delete-question', 'AdminController@deleteQuestion');

    Route::get('/sent-emails', 'AdminController@sentEmails');
    Route::post('/delete-sent-email', 'AdminController@deleteSentEmail');

    Route::get('/messages', 'UserController@messages');
    Route::post('/delete-message', 'UserController@deleteMessage');

//    Route::get('/checking-tasks', 'StaticController@checkingTasks');
//    Route::get('/anti-vir', 'StaticController@antiVir');
});
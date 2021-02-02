<?php

// เคลียร์แคช
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

// ลงทะเบียนแอดมิน
Route::get('/register','Auth\RegisterController@ShowRegisterForm');
Route::post('/register','Auth\RegisterController@register');

// ลงทะเบียนสมาชิก
Route::get('/register-member','AuthMember\RegisterController@ShowRegisterFormMember');
Route::post('/register-member','AuthMember\RegisterController@registerMember');

// เว็บไซต์ www.ptk888.com
Route::group(['prefix' => 'ptk888'], function(){
    Route::get('/', 'Frontend\PtkController@index');
});

// แอดมิน
Route::group(['prefix' => 'admin'], function(){
    // เข้าสู่ระบบแอดมิน
    Route::get('/login','Auth\LoginController@ShowLoginForm')->name('admin.login');
    Route::post('/login','Auth\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
    // ลงทะเบียนพนักงานขาย
    Route::get('/register-seller','AuthSeller\RegisterController@ShowRegisterFormSeller');
    Route::post('/register-seller','AuthSeller\RegisterController@registerSeller');
    // ลงทะเบียนสมาชิกร้านค้า
    Route::get('/register-store','AuthStore\RegisterController@ShowRegisterFormStore');
    Route::post('/register-store','AuthStore\RegisterController@registerStore');

    Route::get('/', 'Backend\AdminController@index')->name('admin.home');
});

// พนักงานขาย
Route::group(['prefix' => 'seller'], function(){
    // เข้าสู่ระบบพนักงานขาย
    Route::get('/login','AuthSeller\LoginController@ShowLoginForm')->name('seller.login');
    Route::post('/login','AuthSeller\LoginController@login')->name('seller.login.submit');
    Route::post('/logout', 'AuthSeller\LoginController@logout')->name('seller.logout');

    Route::get('/', 'Backend\SellerController@index')->name('seller.home');
});

// สมาชิกร้านค้า
Route::group(['prefix' => 'store'], function(){
    // เข้าสู่ระบบสมาชิกร้านค้า
    Route::get('/login','AuthStore\LoginController@ShowLoginForm')->name('store.login');
    Route::post('/login','AuthStore\LoginController@login')->name('store.login.submit');
    Route::post('/logout', 'AuthStore\LoginController@logout')->name('store.logout');

    Route::get('/', 'Backend\StoreController@index')->name('store.home');
});

// ลูกค้า
Route::group(['prefix' => 'member'], function(){
    // เข้าสู่ระบบสมาชิกร้านค้า
    Route::get('/login','AuthMember\LoginController@ShowLoginForm')->name('member.login');
    Route::post('/login','AuthMember\LoginController@login')->name('member.login.submit');
    Route::post('/logout', 'AuthMember\LoginController@logout')->name('member.logout');

    Route::get('/', 'Frontend\MemberController@index')->name('member.home');
});
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
Route::group(['prefix' => '/'], function(){
    Route::get('/', 'Frontend\PtkController@index');
    Route::get('/contact-us', 'Frontend\PtkController@contactUs');
    Route::get('/about-us', 'Frontend\PtkController@aboutUs');
    Route::get('/faq', 'Frontend\PtkController@faq');
    Route::get('/howto-install', 'Frontend\PtkController@howtoInstall');
    Route::get('/warranty-information', 'Frontend\PtkController@warrantyInformation');
    Route::get('/dealer-shop', 'Frontend\PtkController@dealerShop');
    Route::get('/category/{category}','Frontend\PtkController@category');
    Route::get('/brand/{brand}','Frontend\PtkController@brand');
});

// แอดมิน
Route::group(['prefix' => 'admin'], function(){
    // เข้าสู่ระบบแอดมิน
    Route::get('/login','Auth\LoginController@ShowLoginForm')->name('admin.login');
    Route::post('/login','Auth\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
    // หน้าเว็บหลักของแอดมิน
    Route::get('/data-of-customer', 'Backend\AdminController@dataOfCustomer')->name('admin.home');
    // ลงทะเบียนพนักงานขาย
    Route::get('/manage-seller','AuthSeller\RegisterController@manageSeller');
    Route::post('/register-seller','AuthSeller\RegisterController@registerSeller');
    // ลงทะเบียนสมาชิกร้านค้า
    Route::get('/manage-member-store','AuthStore\RegisterController@manageMemberStore');
    Route::post('/register-store','AuthStore\RegisterController@registerStore');
    // จัดการรุปภาพหน้าเว็บไซต์
    Route::get('/manage-image-website', 'Backend\AdminController@manageImageWebsite');
    Route::post('/upload-image-website', 'Backend\AdminController@UploadImageWebsite');
    // จัดการประเภทผลิตภัณฑ์
    Route::get('/manage-category', 'Backend\AdminController@manageCategory');
    Route::post('/upload-category', 'Backend\AdminController@UploadCategory');
    // จัดการยี่ห้อผลิตภัณฑ์
    Route::get('/manage-brand', 'Backend\AdminController@manageBrand');
    Route::post('/upload-brand', 'Backend\AdminController@UploadBrand');
    // จัดการคลังสินค้า
    Route::get('/upload-product-form', 'Backend\AdminController@uploadProductForm');
    Route::post('/upload-product', 'Backend\AdminController@uploadProduct');
    Route::get('/list-product', 'Backend\AdminController@listProduct');

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
    // ลงทะเบียนรับประกันฟิล์ม
    Route::get('/register-warranty', 'Backend\MemberController@registerWarranty');
});
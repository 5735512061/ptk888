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
    Route::get('/promotion','Frontend\PtkController@promotion');
});

// แอดมิน
Route::group(['prefix' => 'admin'], function(){
    // เข้าสู่ระบบแอดมิน
    Route::get('/login','Auth\LoginController@ShowLoginForm')->name('admin.login');
    Route::post('/login','Auth\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
    // ตรวจสอบการลงทะเบียนของลูกค้า และจัดการข้อมูลลูกค้า
    Route::get('/member-check','Backend\AdminController@memberCheck');
    Route::get('/manage-member-customer/{id}','Backend\AdminController@manageMemberCustomer');
    Route::post('/member-customer-confirm','Backend\AdminController@memberCustomerComfirm');
    Route::get('/data-of-customer', 'Backend\AdminController@dataOfCustomer')->name('admin.home');
    Route::get('/delete-member-customer/{id}', 'Backend\AdminController@deleteMemberCustomer');
    Route::get('/edit-member-customer/{id}', 'Backend\AdminController@editMemberCustomer');
    Route::post('/update-member-customer', 'Backend\AdminController@updateMemberCustomer');
    // ลงทะเบียนพนักงานขาย และจัดการข้อมูลพนักงานขาย
    Route::get('/manage-seller','AuthSeller\RegisterController@manageSeller');
    Route::post('/register-seller','AuthSeller\RegisterController@registerSeller');
    Route::get('/delete-seller/{id}', 'Backend\AdminController@deleteSeller');
    Route::get('/edit-seller/{id}', 'Backend\AdminController@editSeller');
    Route::post('/update-seller', 'Backend\AdminController@updateSeller');
    // ลงทะเบียนสมาชิกร้านค้า และจัดการข้อมูลสมาชิกร้านค้า
    Route::get('/manage-member-store','AuthStore\RegisterController@manageMemberStore');
    Route::post('/register-store','AuthStore\RegisterController@registerStore');
    Route::get('/delete-member-store/{id}', 'Backend\AdminController@deleteMemberStore');
    Route::get('/edit-member-store/{id}', 'Backend\AdminController@editMemberStore');
    Route::post('/update-member-store', 'Backend\AdminController@updateMemberStore');
    // จัดการรูปภาพหน้าเว็บไซต์ โปรโมชั่น และจัดการข้อมูลรูปภาพ
    Route::get('/manage-image-website', 'Backend\AdminController@manageImageWebsite');
    Route::post('/upload-image-website', 'Backend\AdminController@UploadImageWebsite');
    Route::get('/delete-image-website/{id}', 'Backend\AdminController@deleteImageWebsite');
    Route::get('/edit-image-website/{id}', 'Backend\AdminController@editImageWebsite');
    Route::post('/update-image-website', 'Backend\AdminController@updateImagewebsite');

    Route::get('/manage-promotion', 'Backend\AdminController@managePromotion');
    Route::post('/upload-promotion', 'Backend\AdminController@UploadPromotion');
    Route::get('/delete-promotion/{id}', 'Backend\AdminController@deletePromotion');
    Route::get('/edit-promotion/{id}', 'Backend\AdminController@editPromotion');
    Route::post('/update-promotion', 'Backend\AdminController@updatePromotion');

    Route::get('/manage-image-ProductRecommend', 'Backend\AdminController@manageImageProductRecommend');
    Route::post('/upload-image-ProductRecommend', 'Backend\AdminController@UploadImageProductRecommend');
    Route::get('/delete-image-ProductRecommend/{id}', 'Backend\AdminController@deleteImageProductRecommend');
    Route::get('/edit-image-ProductRecommend/{id}', 'Backend\AdminController@editImageProductRecommend');
    Route::post('/update-image-ProductRecommend', 'Backend\AdminController@updateImageProductRecommend');
    // จัดการประเภทผลิตภัณฑ์
    Route::get('/manage-category', 'Backend\AdminController@manageCategory');
    Route::post('/upload-category', 'Backend\AdminController@UploadCategory');
    Route::get('/delete-category/{id}', 'Backend\AdminController@deleteCategory');
    Route::get('/edit-category/{id}', 'Backend\AdminController@editCategory');
    Route::post('/update-category', 'Backend\AdminController@updateCategory');
    // จัดการยี่ห้อผลิตภัณฑ์
    Route::get('/manage-brand', 'Backend\AdminController@manageBrand');
    Route::post('/upload-brand', 'Backend\AdminController@UploadBrand');
    Route::get('/delete-brand/{id}', 'Backend\AdminController@deleteBrand');
    Route::get('/edit-brand/{id}', 'Backend\AdminController@editBrand');
    Route::post('/update-brand', 'Backend\AdminController@updateBrand');
    // จัดการคลังสินค้า
    Route::get('/upload-product-form', 'Backend\AdminController@uploadProductForm');
    Route::post('/upload-product', 'Backend\AdminController@uploadProduct');
    Route::get('/list-product', 'Backend\AdminController@listProduct');
    Route::get('/delete-product/{id}', 'Backend\AdminController@deleteProduct');
    Route::get('/edit-product/{id}', 'Backend\AdminController@editProduct');
    Route::post('/update-product', 'Backend\AdminController@updateProduct');
    // การสอบถามของลูกค้า
    Route::get('/message-customer', 'Backend\AdminController@MessageCustomer');

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

    Route::post('/send-message', 'Backend\MemberController@SendMessage');
});
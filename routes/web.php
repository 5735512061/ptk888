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
    Route::get('/', 'Frontend\PtkController@index')->name('member.home');
    Route::get('/contact-us', 'Frontend\PtkController@contactUs');
    Route::get('/about-us', 'Frontend\PtkController@aboutUs');
    Route::get('/faq', 'Frontend\PtkController@faq');
    Route::get('/howto-install', 'Frontend\PtkController@howtoInstall');
    Route::get('/warranty-information', 'Frontend\PtkController@warrantyInformation');
    Route::get('/dealer-shop', 'Frontend\PtkController@dealerShop');
    Route::get('/category/{category}','Frontend\PtkController@category');
    Route::get('/brand/{brand}','Frontend\PtkController@brand');
    Route::get('/product/{brand}/{model}','Frontend\PtkController@productByPhoneModel');
    Route::get('/product/{brand}/{model}/detail/{id}','Frontend\PtkController@productByPhoneModelDetail');
    Route::get('/promotion','Frontend\PtkController@promotion');
});

// แอดมิน
Route::group(['prefix' => 'admin'], function(){
    Route::get('/ajax-brand','Backend\AjaxController@ajax_brand');
    // เข้าสู่ระบบแอดมิน
    Route::get('/login','Auth\LoginController@ShowLoginForm')->name('admin.login');
    Route::post('/login','Auth\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
    // จัดการข้อมูลลูกค้า
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
    // จัดการรูปภาพหน้าเว็บไซต์ โปรโมชั่น จัดการข้อมูลรูปภาพ และจัดการข้อมูลคุณสมบัติของสินค้า
    Route::get('/manage-image-website', 'Backend\AdminController@manageImageWebsite');
    Route::post('/upload-image-website', 'Backend\AdminController@UploadImageWebsite');
    Route::get('/delete-image-website/{id}', 'Backend\AdminController@deleteImageWebsite');
    Route::get('/edit-image-website/{id}', 'Backend\AdminController@editImageWebsite');
    Route::post('/update-image-website', 'Backend\AdminController@updateImagewebsite');

    Route::get('/manage-promotion', 'Backend\AdminController@managePromotion');
    Route::post('/upload-promotion', 'Backend\AdminController@UploadPromotion');
    // Route::get('/delete-promotion/{id}', 'Backend\AdminController@deletePromotion');
    // Route::get('/edit-promotion/{id}', 'Backend\AdminController@editPromotion');
    // Route::post('/update-promotion', 'Backend\AdminController@updatePromotion');

    Route::get('/manage-film-information', 'Backend\AdminController@manageFilmInformation');
    Route::post('/upload-film-information', 'Backend\AdminController@UploadFilmInformation');
    Route::get('/delete-film-information/{id}', 'Backend\AdminController@deleteFilmInformation');
    Route::get('/edit-film-information/{id}', 'Backend\AdminController@editFilmInformation');
    Route::post('/update-film-information', 'Backend\AdminController@updateFilmInformation');
    // จัดการประเภทผลิตภัณฑ์ และประเภทฟิล์ม
    Route::get('/manage-category', 'Backend\AdminController@manageCategory');
    Route::post('/upload-category', 'Backend\AdminController@UploadCategory');
    Route::get('/delete-category/{id}', 'Backend\AdminController@deleteCategory');
    Route::get('/edit-category/{id}', 'Backend\AdminController@editCategory');
    Route::post('/update-category', 'Backend\AdminController@updateCategory');

    Route::get('/manage-film-type', 'Backend\AdminController@manageFilmType');
    Route::post('/upload-film-type', 'Backend\AdminController@UploadFilmType');
    Route::get('/delete-film-type/{id}', 'Backend\AdminController@deleteFilmType');
    Route::get('/edit-film-type/{id}', 'Backend\AdminController@editFilmType');
    Route::post('/update-film-type', 'Backend\AdminController@updateFilmType');
    // จัดการยี่ห้อโทรศัพท์ และรุ่นโทรศัพท์
    Route::get('/manage-brand', 'Backend\AdminController@manageBrand');
    Route::post('/upload-brand', 'Backend\AdminController@UploadBrand');
    Route::get('/delete-brand/{id}', 'Backend\AdminController@deleteBrand');
    Route::get('/edit-brand/{id}', 'Backend\AdminController@editBrand');
    Route::post('/update-brand', 'Backend\AdminController@updateBrand');    

    Route::get('/manage-phone-model', 'Backend\AdminController@managePhoneModel');
    Route::post('/upload-phone-model', 'Backend\AdminController@UploadPhoneModel');
    Route::get('/delete-phone-model/{id}', 'Backend\AdminController@deletePhoneModel');
    Route::get('/edit-phone-model/{id}', 'Backend\AdminController@editPhoneModel');
    Route::post('/update-phone-model', 'Backend\AdminController@updatePhoneModel');
    // จัดการคลังสินค้า
    Route::get('/upload-product-form', 'Backend\AdminController@uploadProductForm');
    Route::post('/upload-product', 'Backend\AdminController@uploadProduct');
    Route::get('/list-product', 'Backend\AdminController@listProduct');
    Route::get('/delete-product/{id}', 'Backend\AdminController@deleteProduct');
    Route::get('/edit-product/{id}', 'Backend\AdminController@editProduct');
    Route::post('/update-product', 'Backend\AdminController@updateProduct');

    Route::get('/list-product-price', 'Backend\AdminController@listProductPrice');
    Route::get('/edit-product-price/{id}', 'Backend\AdminController@editProductPrice');
    Route::post('/update-product-price', 'Backend\AdminController@updateProductPrice');
    Route::get('/product-price-detail/{id}', 'Backend\AdminController@ProductPriceDetail');
    Route::get('/delete-product-price-detail/{id}', 'Backend\AdminController@deleteProductPriceDetail');
    // จัดการสต๊อกสินค้า
    Route::get('/manage-film-stock', 'Backend\AdminController@manageFilmStock');
    Route::get('/delete-stock-film/{id}', 'Backend\AdminController@deleteStockFilm');
    Route::post('/film-stock-out', 'Backend\AdminController@filmStockOut');
    Route::post('/film-stock-add', 'Backend\AdminController@filmStockAdd');
    // การสอบถามของลูกค้า และร้านค้า
    Route::get('/message-customer', 'Backend\AdminController@MessageCustomer');
    Route::get('/delete-message-customer/{id}', 'Backend\AdminController@deleteMessageCustomer');

    Route::get('/message-store', 'Backend\AdminController@MessageStore');
    //  สร้าง serialnumber บาร์โค้ด
    Route::get('/serialnumber', 'Backend\AdminController@serialnumber');
    Route::post('/serialnumber', 'Backend\AdminController@serialnumberPost');
    Route::get('/delete-serialnumber/{id}', 'Backend\AdminController@deleteSerialnumber');
    Route::get('/edit-serialnumber/{id}', 'Backend\AdminController@editSerialnumber');
    Route::post('/update-serialnumber', 'Backend\AdminController@updateSerialnumber');
    // จัดการออเดอร์ การสั่งซื้อ รายการสินค้าออก
    Route::get('/product-out', 'Backend\AdminController@productOut');
    Route::post('/product-out', 'Backend\AdminController@productOutPost');
    Route::get('/delete-product-out/{id}', 'Backend\AdminController@deleteProductOut');

    Route::get('/order-customer', 'Backend\AdminController@orderCustomer');
    Route::get('/order-customer-detail/{id}', 'Backend\AdminController@orderCustomerDetail');
    Route::post('/update-order-customer-status', 'Backend\AdminController@updateOrderCustomerStatus');
    // ข้อมูลการลงทะเบียน และข้อมูลการเคลมสินค้า
    Route::get('/data-warranty', 'Backend\AdminController@dataWarranty');
    Route::get('/delete-data-warranty/{id}', 'Backend\AdminController@deleteDataWarranty');
    Route::get('/edit-data-warranty/{id}', 'Backend\AdminController@editDataWarranty');
    Route::post('/update-data-warranty', 'Backend\AdminController@updateDataWarranty');
    Route::get('/claim-product', 'Backend\AdminController@claimProduct');
    Route::get('/edit-claim-status/{id}', 'Backend\AdminController@editClaimStatus');
});

// พนักงานขาย
Route::group(['prefix' => 'seller'], function(){
    // เข้าสู่ระบบพนักงานขาย
    Route::get('/login','AuthSeller\LoginController@ShowLoginForm')->name('seller.login');
    Route::post('/login','AuthSeller\LoginController@login')->name('seller.login.submit');
    Route::post('/logout', 'AuthSeller\LoginController@logout')->name('seller.logout');

    // จัดการคลังสินค้า
    Route::get('/list-product', 'Backend\SellerController@listProduct')->name('seller.home');

    Route::get('/list-product-price', 'Backend\SellerController@listProductPrice');
    Route::get('/edit-product-price/{id}', 'Backend\SellerController@editProductPrice');
    Route::post('/update-product-price', 'Backend\SellerController@updateProductPrice');
    Route::get('/product-price-detail/{id}', 'Backend\SellerController@ProductPriceDetail');
    // จัดการสต๊อกสินค้า
    Route::get('/manage-film-stock', 'Backend\SellerController@manageFilmStock');
    Route::post('/film-stock-out', 'Backend\SellerController@filmStockOut');
    Route::post('/film-stock-add', 'Backend\SellerController@filmStockAdd');
    // จัดการออเดอร์ การสั่งซื้อ รายการสินค้าออก
    Route::get('/product-out', 'Backend\SellerController@productOut');
    Route::post('/product-out', 'Backend\SellerController@productOutPost');
    Route::get('/delete-product-out/{id}', 'Backend\SellerController@deleteProductOut');

    Route::get('/order-customer', 'Backend\SellerController@orderCustomer');
    Route::get('/order-customer-detail/{id}', 'Backend\SellerController@orderCustomerDetail');
    Route::post('/update-order-customer-status', 'Backend\SellerController@updateOrderCustomerStatus');
    // ข้อมูลการลงทะเบียน และข้อมูลการเคลมสินค้า
    Route::get('/data-warranty', 'Backend\SellerController@dataWarranty');
    Route::get('/delete-data-warranty/{id}', 'Backend\SellerController@deleteDataWarranty');
    Route::get('/edit-data-warranty/{id}', 'Backend\SellerController@editDataWarranty');
    Route::post('/update-data-warranty', 'Backend\SellerController@updateDataWarranty');
    Route::get('/claim-product', 'Backend\SellerController@claimProduct');
    Route::get('/edit-claim-status/{id}', 'Backend\SellerController@editClaimStatus');
});

// สมาชิกร้านค้า
Route::group(['prefix' => 'store'], function(){
    // เข้าสู่ระบบสมาชิกร้านค้า
    Route::get('/login','AuthStore\LoginController@ShowLoginForm')->name('store.login');
    Route::post('/login','AuthStore\LoginController@login')->name('store.login.submit');
    Route::post('/logout', 'AuthStore\LoginController@logout')->name('store.logout');
    // รายการสินค้าออก
    Route::get('/product-out', 'Backend\StoreController@productOut')->name('store.home');
    Route::post('/product-out', 'Backend\StoreController@productOutPost');
    // ติดต่อสอบถาม
    Route::get('/contact-us', 'Backend\StoreController@contactUs');
    Route::post('/send-message', 'Backend\StoreController@sendMessage');
    Route::get('/message-history', 'Backend\StoreController@messageHistory');
});

// ลูกค้า
Route::group(['prefix' => 'member'], function(){
    // เข้าสู่ระบบลูกค้า
    Route::get('/login','AuthMember\LoginController@ShowLoginForm')->name('member.login');
    Route::post('/login','AuthMember\LoginController@login')->name('member.login.submit');
    Route::post('/logout', 'AuthMember\LoginController@logout')->name('member.logout');
    // เปลี่ยนรหัสผ่าน
    Route::get('/change-password', 'AuthMember\ChangePasswordController@index')->name('password.change');
    Route::post('/change-password', 'AuthMember\ChangePasswordController@changePassword')->name('password.update');
    // ตะกร้าสินค้า
    Route::get('addToCart/{id}','Frontend\\CartController@getAddToCart');
    Route::get('/shopping-cart','Frontend\\CartController@getCart')->name('cart.index');
    Route::get('checkout','Frontend\\CartController@getCheckout')->name('checkout');
    Route::get('remove/{id}','Frontend\\CartController@getRemoveItem')->name('remove');
    // การชำระเงิน
    Route::post('/payment-checkout-customer','Frontend\\CartController@paymentCheckoutCustomer');
    // ลงทะเบียนรับประกันฟิล์ม และเคลมสินค้า
    Route::get('/register-warranty', 'Backend\MemberController@registerWarranty');
    Route::post('/register-warranty', 'Backend\MemberController@registerWarrantyPost');

    Route::get('/claim-product', 'Backend\MemberController@claimProduct');
    Route::post('/claim-product-confirm', 'Backend\MemberController@claimProductConfirm');
    Route::get('/claim-product-form/{id}', 'Backend\MemberController@claimProductForm');
    Route::post('/claim-product', 'Backend\MemberController@claimProductPost');
    // ส่งข้อความ
    Route::post('/send-message', 'Backend\MemberController@SendMessage');
    // โปรไฟล์ลูกค้า
    Route::get('/profile', 'Backend\MemberController@profile');
    Route::get('/edit-profile/{id}', 'Backend\MemberController@editProfile');
    Route::post('/update-profile', 'Backend\MemberController@updateProfile');
    // ประวัติการสั่งซื้อสินค้า
    Route::get('/order-history', 'Backend\MemberController@orderHistory');

});
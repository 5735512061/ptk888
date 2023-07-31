<?php

// เคลียร์แคช
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';    
    // 
});

Route::get('locale/{locale}',function($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
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
    Route::get('/all-brand','Frontend\PtkController@allBrand');
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
    // เปลี่ยนรหัสผ่าน
    Route::get('/change-password', 'Auth\ChangePasswordController@index')->name('admin.password.change');
    Route::post('/change-password', 'Auth\ChangePasswordController@changePassword')->name('admin.password.update');
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
    Route::get('/delete-promotion/{id}', 'Backend\AdminController@deletePromotion');
    Route::get('/edit-promotion/{id}', 'Backend\AdminController@editPromotion');
    Route::post('/update-promotion', 'Backend\AdminController@updatePromotion');

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

    Route::get('/list-product-promotion-price', 'Backend\AdminController@listProductPromotionPrice');
    Route::get('/edit-product-promotion-price/{id}', 'Backend\AdminController@editProductPromotionPrice');
    Route::post('/update-product-promotion-price', 'Backend\AdminController@updateProductPromotionPrice');
    Route::get('/product-promotion-price-detail/{id}', 'Backend\AdminController@ProductPromotionPriceDetail');
    Route::get('/delete-product-promotion-price-detail/{id}', 'Backend\AdminController@deleteProductPromotionPriceDetail');
    // จัดการสต๊อกสินค้า
    Route::get('/manage-film-stock', 'Backend\AdminController@manageFilmStock');
    Route::get('/delete-stock-film/{id}', 'Backend\AdminController@deleteStockFilm');
    Route::post('/film-stock-out', 'Backend\AdminController@filmStockOut');
    Route::post('/film-stock-add', 'Backend\AdminController@filmStockAdd');
    Route::get('/edit-stock-film/{id}', 'Backend\AdminController@editStockFilm');
    Route::post('/update-stock-film', 'Backend\AdminController@updateStockFilm');
    // การสอบถามของลูกค้า และร้านค้า
    Route::get('/message-customer', 'Backend\AdminController@MessageCustomer');
    Route::post('/answer-message-customer', 'Backend\AdminController@answerMessageCustomer');

    Route::get('/message-store', 'Backend\AdminController@MessageStore');
    Route::post('/answer-message-store', 'Backend\AdminController@answerMessageStore');
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
    Route::get('/delete-order-customer/{id}', 'Backend\AdminController@deleteOrderCustomer');
    Route::post('/update-address-customer', 'Backend\AdminController@updateAddressCustomer');

    Route::get('/order-store', 'Backend\AdminController@orderStore');
    Route::get('/order-store-detail/{id}', 'Backend\AdminController@orderStoreDetail');
    Route::post('/update-order-store-status', 'Backend\AdminController@updateOrderStoreStatus');
    Route::get('/delete-order-store/{id}', 'Backend\AdminController@deleteOrderStore');
    Route::post('/update-address-store', 'Backend\AdminController@updateAddressStore');

    Route::get('/order-store/film-brand', 'Backend\AdminController@orderStoreFilmBrand');
    Route::get('/order-store-detail/film-brand/{id}', 'Backend\AdminController@orderStoreDetailFilmBrand');
    Route::post('/update-order-store-status/film-brand', 'Backend\AdminController@updateOrderStoreStatusFilmBrand');
    Route::get('/delete-order-store-film-brand/{id}', 'Backend\AdminController@deleteOrderStoreFilmBrand');
    Route::post('/update-address-store-film-brand', 'Backend\AdminController@updateAddressStoreFilmBrand');
    
    // ข้อมูลการลงทะเบียน และข้อมูลการเคลมสินค้า
    Route::get('/data-warranty', 'Backend\AdminController@dataWarranty');
    Route::get('/delete-data-warranty/{id}', 'Backend\AdminController@deleteDataWarranty');
    Route::get('/edit-data-warranty/{id}', 'Backend\AdminController@editDataWarranty');
    Route::post('/update-data-warranty', 'Backend\AdminController@updateDataWarranty');
    Route::get('/claim-product', 'Backend\AdminController@claimProduct');
    Route::get('/edit-claim-status/{id}', 'Backend\AdminController@editClaimStatus');
    Route::get('/delete-claim-warranty/{id}', 'Backend\AdminController@deleteClaimWarranty');
    // จัดการราคาของร้านค้า
    Route::get('/list-product-price-store', 'Backend\AdminController@listProductPriceStore');
    Route::get('/edit-product-price-store/{id}', 'Backend\AdminController@editProductPriceStore');
    Route::post('/update-product-price-store', 'Backend\AdminController@updateProductPriceStore');
    Route::get('/product-price-detail-store/{id}', 'Backend\AdminController@ProductPriceDetailStore');
    Route::get('/delete-product-price-detail-store/{id}', 'Backend\AdminController@deleteProductPriceDetailStore');

    Route::get('/list-product-price-store-film-brand', 'Backend\AdminController@listProductPriceStoreFilmBrand');
    Route::get('/edit-product-price-store-film-brand/{id}', 'Backend\AdminController@editProductPriceStoreFilmBrand');
    Route::post('/update-product-price-store-film-brand', 'Backend\AdminController@updateProductPriceStoreFilmBrand');
    Route::get('/product-price-detail-store-film-brand/{id}', 'Backend\AdminController@ProductPriceDetailStoreFilmBrand');
    Route::get('/delete-product-price-detail-store-film-brand/{id}', 'Backend\AdminController@deleteProductPriceDetailStoreFilmBrand');
    // ค้นหาข้อมูล
    Route::post('/search-customer', 'Backend\AdminSearchController@searchCustomer');
    Route::post('/search-store', 'Backend\AdminSearchController@searchStore');
    Route::post('/search-seller', 'Backend\AdminSearchController@searchSeller');
    Route::post('/search-data-warranty', 'Backend\AdminSearchController@searchDataWarranty');
    Route::post('/search-claim-product', 'Backend\AdminSearchController@searchClaimProduct');
    Route::post('/search-list-product', 'Backend\AdminSearchController@searchListProduct');
    Route::post('/search-list-product-price', 'Backend\AdminSearchController@searchListProductPrice');
    Route::post('/search-list-product-promotion-price', 'Backend\AdminSearchController@searchListProductPromotionPrice');
    Route::post('/search-phone-model', 'Backend\AdminSearchController@searchPhoneModel');
    Route::post('/search-serialnumber', 'Backend\AdminSearchController@searchSerialnumber');
    Route::post('/search-product-out', 'Backend\AdminSearchController@searchProductOut');
    Route::post('/search-order-customer', 'Backend\AdminSearchController@searchOrderCustomer');
    Route::post('/search-order-store', 'Backend\AdminSearchController@searchOrderStore');
    Route::post('/search-order-store-film-brand', 'Backend\AdminSearchController@searchOrderStoreFilmBrand');
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

    Route::get('/list-product-promotion-price', 'Backend\SellerController@listProductPromotionPrice');
    Route::get('/edit-product-promotion-price/{id}', 'Backend\SellerController@editProductPromotionPrice');
    Route::post('/update-product-promotion-price', 'Backend\SellerController@updateProductPromotionPrice');
    Route::get('/product-promotion-price-detail/{id}', 'Backend\SellerController@ProductPromotionPriceDetail');
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
    Route::get('/delete-order-customer/{id}', 'Backend\SellerController@deleteOrderCustomer');
    Route::post('/update-address-customer', 'Backend\SellerController@updateAddressCustomer');

    Route::get('/order-store', 'Backend\SellerController@orderStore');
    Route::get('/order-store-detail/{id}', 'Backend\SellerController@orderStoreDetail');
    Route::post('/update-order-store-status', 'Backend\SellerController@updateOrderStoreStatus');
    Route::get('/delete-order-store/{id}', 'Backend\SellerController@deleteOrderStore');
    Route::post('/update-address-store', 'Backend\SellerController@updateAddressStore');

    Route::get('/order-store/film-brand', 'Backend\SellerController@orderStoreFilmBrand');
    Route::get('/order-store-detail/film-brand/{id}', 'Backend\SellerController@orderStoreDetailFilmBrand');
    Route::post('/update-order-store-status/film-brand', 'Backend\SellerController@updateOrderStoreStatusFilmBrand');
    Route::get('/delete-order-store-film-brand/{id}', 'Backend\SellerController@deleteOrderStoreFilmBrand');
    Route::post('/update-address-store-film-brand', 'Backend\SellerController@updateAddressStoreFilmBrand');
    // ข้อมูลการลงทะเบียน และข้อมูลการเคลมสินค้า
    Route::get('/data-warranty', 'Backend\SellerController@dataWarranty');
    Route::get('/delete-data-warranty/{id}', 'Backend\SellerController@deleteDataWarranty');
    Route::get('/edit-data-warranty/{id}', 'Backend\SellerController@editDataWarranty');
    Route::post('/update-data-warranty', 'Backend\SellerController@updateDataWarranty');
    Route::get('/claim-product', 'Backend\SellerController@claimProduct');
    Route::get('/edit-claim-status/{id}', 'Backend\SellerController@editClaimStatus');
    // จัดการราคาของร้านค้า
    Route::get('/list-product-price-store', 'Backend\SellerController@listProductPriceStore');
    Route::get('/edit-product-price-store/{id}', 'Backend\SellerController@editProductPriceStore');
    Route::post('/update-product-price-store', 'Backend\SellerController@updateProductPriceStore');
    Route::get('/product-price-detail-store/{id}', 'Backend\SellerController@ProductPriceDetailStore');

    Route::get('/list-product-price-store-film-brand', 'Backend\SellerController@listProductPriceStoreFilmBrand');
    Route::get('/edit-product-price-store-film-brand/{id}', 'Backend\SellerController@editProductPriceStoreFilmBrand');
    Route::post('/update-product-price-store-film-brand', 'Backend\SellerController@updateProductPriceStoreFilmBrand');
    Route::get('/product-price-detail-store-film-brand/{id}', 'Backend\SellerController@ProductPriceDetailStoreFilmBrand');

    // ค้นหาข้อมูล
    Route::post('/search-data-warranty', 'Backend\SellerSearchController@searchDataWarranty');
    Route::post('/search-claim-product', 'Backend\SellerSearchController@searchClaimProduct');
    Route::post('/search-list-product', 'Backend\SellerSearchController@searchListProduct');
    Route::post('/search-list-product-price', 'Backend\SellerSearchController@searchListProductPrice');
    Route::post('/search-list-product-promotion-price', 'Backend\SellerSearchController@searchListProductPromotionPrice');
    Route::post('/search-product-out', 'Backend\SellerSearchController@searchProductOut');
    Route::post('/search-order-customer', 'Backend\SellerSearchController@searchOrderCustomer');
    Route::post('/search-order-store', 'Backend\SellerSearchController@searchOrderStore');
    Route::post('/search-order-store-film-brand', 'Backend\SellerSearchController@searchOrderStoreFilmBrand');
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
    // สั่งซื้อสินค้า
    Route::get('/order-product', 'Backend\StoreController@orderProduct');
    Route::post('/add-to-cart','Backend\\StoreController@getAddToCart');
    Route::get('/shopping-cart','Backend\\StoreController@getCart');
    Route::get('/remove-shopping-cart/{id}','Backend\\StoreController@removeShoppingCart');
    Route::get('/checkout','Backend\\StoreController@getCheckout');
    // สั่งซื้อสินค้าพร้อมแพ็คเกจ
    Route::get('/order-product/film-brand', 'Backend\StoreController@orderProductFilmBrand');
    Route::post('/add-to-cart/film-brand','Backend\\StoreController@getAddToCartFilmBrand');
    Route::get('/shopping-cart/film-brand','Backend\\StoreController@getCartFilmBrand');
    Route::get('/remove-shopping-cart/film-brand/{id}','Backend\\StoreController@removeShoppingCartFilmBrand');
    Route::get('/checkout/film-brand','Backend\\StoreController@getCheckoutFilmBrand');
    // การชำระเงิน
    Route::post('/payment-checkout-store','Backend\\StoreController@paymentCheckoutStore');
    Route::post('/payment-checkout-store/film-brand','Backend\\StoreController@paymentCheckoutStoreFilmBrand');
    // ประวัติการสั่งซื้อสินค้า
    Route::get('/order-history', 'Backend\StoreController@orderHistory');
    Route::get('/order-history-detail/{id}', 'Backend\StoreController@orderHistoryDetail');
    Route::get('/order-history/film-brand', 'Backend\StoreController@orderHistoryFilmBrand');
    Route::get('/order-history-detail/film-brand/{id}', 'Backend\StoreController@orderHistoryDetailFilmBrand');
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
    // ลืมรหัสผ่าน
    Route::get('/ForgetPassword', 'AuthMember\ForgetPasswordController@index')->name('password.forget');
    Route::post('/ForgetPasswordForm', 'AuthMember\ForgetPasswordController@forgetForm')->name('password.forget.form');
    Route::post('/Password-Confirm', 'AuthMember\ForgetPasswordController@confirm')->name('password.confirm');
    Route::post('/ForgetPassword', 'AuthMember\ForgetPasswordController@UpdatePassword')->name('password.updateForget');

    // ตะกร้าสินค้า
    Route::get('addToCart/{id}/{qty}','Frontend\\CartController@getAddToCart');
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
    // ประวัติการติดต่อสอบถาม ส่งข้อความ
    Route::post('/send-message', 'Backend\MemberController@sendMessage');
    Route::get('/answer-message', 'Backend\MemberController@answerMessage');
    // โปรไฟล์ลูกค้า
    Route::get('/profile', 'Backend\MemberController@profile');
    Route::get('/edit-profile/{id}', 'Backend\MemberController@editProfile');
    Route::post('/update-profile', 'Backend\MemberController@updateProfile');
    // ประวัติการสั่งซื้อสินค้า
    Route::get('/order-history', 'Backend\MemberController@orderHistory');
    Route::get('/order-history-detail/{id}', 'Backend\MemberController@orderHistoryDetail');

});
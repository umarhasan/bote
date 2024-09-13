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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

Route::middleware(['permission:users,user.list'])->group(function () {

    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
});
Route::middleware(['permission:approve_users,approve.user.list'])->group(function () {

    Route::get('/users/approved', [App\Http\Controllers\UserController::class, 'index'])->name('users.approve');
});
Route::middleware(['permission:pending_users,pending.user.list'])->group(function () {

    Route::get('/users/pending', [App\Http\Controllers\UserController::class, 'index'])->name('users.pending');
});
Route::middleware(['permission:users,user.edit'])->group(function () {

    Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
});

Route::get('/users/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');

Route::post('/users/profile/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.profile.update');

Route::middleware(['permission:users,user.view'])->group(function () {
    Route::get('/users/view/{id}', [App\Http\Controllers\UserController::class, 'view'])->name('users.view');
});

Route::middleware(['permission:tax,tax.list'])->group(function () {

    Route::get('/tax', [App\Http\Controllers\TaxController::class, 'index'])->name('tax');
});
Route::middleware(['permission:tax,tax.edit'])->group(function () {

    Route::get('/tax/edit/{id}', [App\Http\Controllers\TaxController::class, 'edit'])->name('tax.edit');
});
Route::middleware(['permission:tax,tax.create'])->group(function () {

    Route::get('/tax/create', [App\Http\Controllers\TaxController::class, 'create'])->name('tax.create');
});

Route::middleware(['permission:currency,currency.list'])->group(function () {

    Route::get('/currency', [App\Http\Controllers\CurrencyController::class, 'index'])->name('currency');
});
Route::middleware(['permission:currency,currency.edit'])->group(function () {

    Route::get('/currency/edit/{id}', [App\Http\Controllers\CurrencyController::class, 'edit'])->name('currency.edit');
});
Route::middleware(['permission:currency,currency.create'])->group(function () {

    Route::get('/currency/create', [App\Http\Controllers\CurrencyController::class, 'create'])->name('currency.create');
});

Route::middleware(['permission:vehicle-type,vehicle.type.list'])->group(function () {

    Route::get('/vehicle-type', [App\Http\Controllers\VehicleTypeController::class, 'index'])->name('vehicle-type');
});
Route::middleware(['permission:vehicle-type,vehicle.type.edit'])->group(function () {

    Route::get('/vehicle-type/edit/{id}', [App\Http\Controllers\VehicleTypeController::class, 'edit'])->name('vehicle-type.edit');
});
Route::middleware(['permission:vehicle-type,vehicle.type.create'])->group(function () {

    Route::get('/vehicle-type/create', [App\Http\Controllers\VehicleTypeController::class, 'create'])->name('vehicle-type.create');
});

Route::middleware(['permission:documents,document.list'])->group(function () {

    Route::get('/documents', [App\Http\Controllers\DocumentsController::class, 'index'])->name('documents');
});

Route::middleware(['permission:documents,document.' . ((str_contains(Request::url(), 'save/')) ? ((explode("save/", Request::url())[1]) == 0 ? "create" : "edit") : Request::url())])->group(function () {

    Route::get('/documents/save/{id}', [App\Http\Controllers\DocumentsController::class, 'save'])->name('documents.save');
});

Route::middleware(['permission:ride_order,order.list'])->group(function () {

    Route::get('/rides', [App\Http\Controllers\RidesController::class, 'index'])->name('rides');
});
Route::middleware(['permission:ride_order,order.view'])->group(function () {

    Route::get('/rides/show/{id}', [App\Http\Controllers\RidesController::class, 'show'])->name('rides.show');
});

Route::middleware(['permission:reports,' . ((str_contains(Request::url(), 'reports/')) ? explode("reports/", Request::url())[1] : Request::url()) . '.report'])->group(function () {

    Route::get('/reports/{type}', [App\Http\Controllers\ReportController::class, 'reportGenerate'])->name('reports');
});

Route::middleware(['permission:cms,cms.list'])->group(function () {

    Route::get('cms', [App\Http\Controllers\CmsController::class, 'index'])->name('cms');
});
Route::middleware(['permission:cms,cms.edit'])->group(function () {

    Route::get('/cms/edit/{id}', [App\Http\Controllers\CmsController::class, 'edit'])->name('cms.edit');
});
Route::middleware(['permission:cms,cms.create'])->group(function () {

    Route::get('/cms/create', [App\Http\Controllers\CmsController::class, 'create'])->name('cms.create');
});

Route::middleware(['permission:on-board,onboard.list'])->group(function () {

    Route::get('/on-board', [App\Http\Controllers\OnBoardController::class, 'index'])->name('on-board');
});

Route::middleware(['permission:on-board,onboard.edit'])->group(function () {

    Route::get('/on-board/save/{id}', [App\Http\Controllers\OnBoardController::class, 'show'])->name('on-board.save');
});
Route::middleware(['permission:payout-request,payout-request'])->group(function () {

    Route::get('/payoutRequest', [App\Http\Controllers\PayoutRequestController::class, 'index'])->name('payoutRequest.index');
});
Route::middleware(['permission:users-wallet-transaction,user.wallet.list'])->group(function () {

    Route::get('/walletTransaction/user', [App\Http\Controllers\TransactionController::class, 'userWalletTransaction'])->name('walletTransaction.user');
});

Route::middleware(['permission:faq,faq.list'])->group(function () {

    Route::get('/faq', [App\Http\Controllers\FAQController::class, 'index'])->name('faq');
});
Route::middleware(['permission:faq,faq.' . ((str_contains(Request::url(), 'save')) ? (explode("save", Request::url())[1] ? "edit" : "create") : Request::url())])->group(function () {

    Route::get('/faq/save/{id?}', [App\Http\Controllers\FAQController::class, 'save'])->name('faq.save');
});

Route::post('send-notification', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->name('send-notification');

Route::prefix('settings')->group(function () {
    Route::middleware(['permission:global-setting,global-setting'])->group(function () {

        Route::get('globals', [App\Http\Controllers\SettingsController::class, 'globals'])->name('settings.globals');
    });
    Route::middleware(['permission:admin-commission,admin-commision'])->group(function () {

        Route::get('adminCommission', [App\Http\Controllers\SettingsController::class, 'adminCommission'])->name('settings.adminCommission');
    });
    Route::middleware(['permission:notification-setting,notification-setting'])->group(function () {

        Route::get('notificationSettings', [App\Http\Controllers\SettingsController::class, 'notificationSettings'])->name('settings.notificationSettings');
    });
    Route::middleware(['permission:payment-method,payment-method'])->group(function () {

        Route::get('payments/stripe', [App\Http\Controllers\SettingsController::class, 'stripe'])->name('settings.payments.stripe');
        Route::get('payments/applepay', [App\Http\Controllers\SettingsController::class, 'applepay'])->name('settings.payments.applepay');
        Route::get('payments/razorpay', [App\Http\Controllers\SettingsController::class, 'razorpay'])->name('settings.payments.razorpay');
        Route::get('payments/cod', [App\Http\Controllers\SettingsController::class, 'cod'])->name('settings.payments.cod');
        Route::get('payments/paypal', [App\Http\Controllers\SettingsController::class, 'paypal'])->name('settings.payments.paypal');
        Route::get('payments/paytm', [App\Http\Controllers\SettingsController::class, 'paytm'])->name('settings.payments.paytm');
        Route::get('payments/wallet', [App\Http\Controllers\SettingsController::class, 'wallet'])->name('settings.payments.wallet');
        Route::get('payments/payfast', [App\Http\Controllers\SettingsController::class, 'payfast'])->name('settings.payments.payfast');
        Route::get('payments/paystack', [App\Http\Controllers\SettingsController::class, 'paystack'])->name('settings.payments.paystack');
        Route::get('payments/flutterwave', [App\Http\Controllers\SettingsController::class, 'flutterwave'])->name('settings.payments.flutterwave');
        Route::get('payments/mercadopago', [App\Http\Controllers\SettingsController::class, 'mercadopago'])->name('settings.payments.mercadopago');
        Route::get('payments/yappy', [App\Http\Controllers\SettingsController::class, 'yappy'])->name('settings.payments.yappy');
    });

    Route::middleware(['permission:homepageTemplate,home-page'])->group(function () {

        Route::get('/landingPageTemplate', [App\Http\Controllers\SettingsController::class, 'landingPageTemplate'])->name('settings.landingPageTemplate');

    });
    Route::middleware(['permission:header-template,header'])->group(function () {

        Route::get('/headerTemplate', [App\Http\Controllers\SettingsController::class, 'headerTemplate'])->name('settings.headerTemplate');
    });
    Route::middleware(['permission:footer-template,footer'])->group(function () {

        Route::get('/footerTemplate', [App\Http\Controllers\SettingsController::class, 'footerTemplate'])->name('settings.footerTemplate');
    });
    Route::middleware(['permission:privacy,privacy'])->group(function () {

        Route::get('/privacyPolicy', [App\Http\Controllers\SettingsController::class, 'privacyPolicy'])->name('settings.privacyPolicy');
    });
    Route::middleware(['permission:terms,terms'])->group(function () {

        Route::get('/termsAndConditions', [App\Http\Controllers\SettingsController::class, 'termsAndConditions'])->name('settings.termsAndConditions');
    });

    Route::middleware(['permission:language,language.list'])->group(function () {

        Route::get('/languages', [App\Http\Controllers\SettingsController::class, 'languages'])->name('settings.languages');
    });
    Route::middleware(['permission:language,language.' . ((str_contains(Request::url(), 'save')) ? (explode("save", Request::url())[1] ? "edit" : "create") : Request::url())])->group(function () {


        Route::get('/languages/save/{id?}', [App\Http\Controllers\SettingsController::class, 'saveLanguage'])->name('settings.languages.save');
    });

    Route::middleware(['permission:deleted-language,language.delete.list'])->group(function () {

        Route::get('/languages/deleted', [App\Http\Controllers\SettingsController::class, 'deletedLang'])->name('settings.languages.deleted');
    });
});

Route::middleware(['permission:admins,admin.list'])->group(function () {

    Route::get('admin-users', [App\Http\Controllers\AdminUsersController::class, 'index'])->name('admin.users.index');
});
Route::middleware(['permission:admins,admin.create'])->group(function () {

    Route::get('admin-users/create', [App\Http\Controllers\AdminUsersController::class, 'create'])->name('admin.users.create');
});

Route::middleware(['permission:admins,admin.store'])->group(function () {

    Route::post('admin-users/store', [App\Http\Controllers\AdminUsersController::class, 'store'])->name('admin.users.store');
});
Route::middleware(['permission:admins,admin.edit'])->group(function () {

    Route::get('admin-users/edit/{id}', [App\Http\Controllers\AdminUsersController::class, 'edit'])->name('admin.users.edit');
});
Route::middleware(['permission:admins,admin.update'])->group(function () {

    Route::post('admin-users/update/{id}', [App\Http\Controllers\AdminUsersController::class, 'update'])->name('admin.users.update');
});
Route::middleware(['permission:admins,admin.delete'])->group(function () {

    Route::get('admin-users/delete/{userid}', [App\Http\Controllers\AdminUsersController::class, 'delete'])->name('admin.users.delete');
});

Route::middleware(['permission:roles,roles.list'])->group(function () {

    Route::get('role', [App\Http\Controllers\RolesController::class, 'index'])->name('role.index');
});
Route::middleware(['permission:roles,roles.create'])->group(function () {

    Route::get('role/create', [App\Http\Controllers\RolesController::class, 'create'])->name('role.create');
});
Route::middleware(['permission:roles,roles.store'])->group(function () {

    Route::post('role/store', [App\Http\Controllers\RolesController::class, 'store'])->name('role.store');
});
Route::middleware(['permission:roles,roles.edit'])->group(function () {

    Route::get('role/edit/{id}', [App\Http\Controllers\RolesController::class, 'edit'])->name('role.edit');
});
Route::middleware(['permission:roles,roles.update'])->group(function () {

    Route::post('role/update/{id}', [App\Http\Controllers\RolesController::class, 'update'])->name('role.update');
});
Route::middleware(['permission:roles,roles.delete'])->group(function () {

    Route::get('role/delete/{userid}', [App\Http\Controllers\RolesController::class, 'delete'])->name('role.delete');
});

//API Url for app
Route::post('payments/getpaytmchecksum', [App\Http\Controllers\PaymentController::class, 'getPaytmChecksum']);
Route::post('payments/validatechecksum', [App\Http\Controllers\PaymentController::class, 'validateChecksum']);
Route::post('payments/initiatepaytmpayment', [App\Http\Controllers\PaymentController::class, 'initiatePaytmPayment']);
Route::get('payments/paytmpaymentcallback', [App\Http\Controllers\PaymentController::class, 'paytmPaymentcallback']);
Route::post('payments/paypalclientid', [App\Http\Controllers\PaymentController::class, 'getPaypalClienttoken']);
Route::post('payments/paypaltransaction', [App\Http\Controllers\PaymentController::class, 'createBraintreePayment']);
Route::post('payments/stripepaymentintent', [App\Http\Controllers\PaymentController::class, 'createStripePaymentIntent']);
Route::get('payment/success', [App\Http\Controllers\PaymentController::class, 'paymentsuccess'])->name('payment.success');
Route::get('payment/failed', [App\Http\Controllers\PaymentController::class, 'paymentfailed'])->name('payment.failed');
Route::get('payment/pending', [App\Http\Controllers\PaymentController::class, 'paymentpending'])->name('payment.pending');

Route::middleware(['permission:vehicle-brand,vehicle.brand.list'])->group(function () {
    Route::get('/vehicle-brand', [App\Http\Controllers\VehicleBrandController::class, 'index'])->name('vehicle-brand');
});
Route::middleware(['permission:vehicle-brand,vehicle.brand.edit'])->group(function () {

    Route::get('/vehicle-brand/edit/{id}', [App\Http\Controllers\VehicleBrandController::class, 'edit'])->name('vehicle-brand.edit');
});
Route::middleware(['permission:vehicle-brand,vehicle.brand.create'])->group(function () {

    Route::get('/vehicle-brand/create', [App\Http\Controllers\VehicleBrandController::class, 'create'])->name('vehicle-brand.create');
});
Route::middleware(['permission:vehicle-model,vehicle.model.list'])->group(function () {

    Route::get('/vehicle-model', [App\Http\Controllers\VehicleModelController::class, 'index'])->name('vehicle-model');
});
Route::middleware(['permission:vehicle-model,vehicle.model.edit'])->group(function () {

    Route::get('/vehicle-model/edit/{id}', [App\Http\Controllers\VehicleModelController::class, 'edit'])->name('vehicle-model.edit');
});
Route::middleware(['permission:vehicle-model,vehicle.model.create'])->group(function () {

    Route::get('/vehicle-model/create', [App\Http\Controllers\VehicleModelController::class, 'create'])->name('vehicle-model.create');
});
Route::middleware(['permission:document-list,user.document.list'])->group(function () {
    Route::get('users/document-list/{id}', [App\Http\Controllers\UserController::class, 'DocumentList'])->name('users.document');
});
Route::middleware(['permission:document-upload,user.document.upload'])->group(function () {
    Route::get('/users/document/upload/{userId}/{id}', [App\Http\Controllers\UserController::class, 'DocumentUpload'])->name('users.document.upload');
});
Route::middleware(['permission:complaint-subject,complaint.subject.list'])->group(function () {
    Route::get('complaint-subject', [App\Http\Controllers\ComplaintSubjectController::class, 'index'])->name('complaint.subject.index');
});
Route::middleware(['permission:complaint-subject,complaint.subject.create'])->group(function () {
    Route::get('complaint-subject/create', [App\Http\Controllers\ComplaintSubjectController::class, 'create'])->name('complaint.subject.create');
});
Route::middleware(['permission:complaint-subject,complaint.subject.edit'])->group(function () {
    Route::get('complaint-subject/edit/{type}/{id}', [App\Http\Controllers\ComplaintSubjectController::class, 'edit'])->name('complaint.subject.edit');
});
Route::middleware(['permission:dynamic-notification,dynamic.notification.list'])->group(function () {
    Route::get('dynamic-notification', [App\Http\Controllers\DynamicNotificationController::class, 'index'])->name('dynamic-notification.index');
});
Route::middleware(['permission:dynamic-notification,dynamic.notification.edit'])->group(function () {
    Route::get('dynamic-notification/save/{id?}', [App\Http\Controllers\DynamicNotificationController::class, 'save'])->name('dynamic-notification.save');
});
Route::middleware(['permission:complaints,complaints.list'])->group(function () {
    Route::get('complaints', [App\Http\Controllers\ComplaintController::class, 'index'])->name('complaint.index');
});
Route::middleware(['permission:user-ride-detail,user.ride.detail'])->group(function () {
    Route::get('rides/show/{rideId}/{userId}', [App\Http\Controllers\RidesController::class, 'userRideDetail'])->name('ride.user.detail');
});
Route::middleware(['permission:email-template,email.template.index'])->group(function () {
    Route::get('email-templates', [App\Http\Controllers\SettingsController::class, 'emailTemplatesIndex'])->name('email-templates.index');
});
Route::middleware(['permission:email-template,email.template.save'])->group(function () {
    Route::get('email-templates/save/{id?}', [App\Http\Controllers\SettingsController::class, 'emailTemplatesSave'])->name('email-templates.save');
});

Route::post('/delete-user/{id}', [App\Http\Controllers\DeleteUserAuthenticationController::class, 'deleteUser'])->name('delete-user');
Route::post('store-firebase-service', [App\Http\Controllers\HomeController::class,'storeFirebaseService'])->name('store-firebase-service');

Route::post('pay-to-user', [App\Http\Controllers\UserController::class,'payToUser'])->name('pay.user');
Route::post('check-payout-status', [App\Http\Controllers\UserController::class,'checkPayoutStatus'])->name('check.payout.status');
Route::post('send-email', [App\Http\Controllers\SendEmailController::class, 'sendMail'])->name('sendMail');

// Payment/initiate
Route::post('/payments/initiate', [App\Http\Controllers\PaymentsController::class, 'initiatePayment']);
Route::get('/payments/callback', [App\Http\Controllers\PaymentsController::class, 'paymentCallback'])->name('payments.callback');

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


/**
 * Menu principal
 */
Route::controller(\App\Http\Controllers\HomeController::class)->middleware("setLang")->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index')->name('home');
});



Route::get('locale/{locale}', function ($locale) {

    // Check if the passed locale is available in our configuration
    if (in_array($locale, array_values(config('app.available_locales')))) {

        // If valid, store the locale in the session
        Session::put('locale', $locale);
    }
    // Redirect back to the previous page
    return redirect()->back();
});



/**
 * Menu de Connection
 */
Route::prefix('/connect')->controller(\App\Http\Controllers\ConnectController::class)->middleware("setLang")->group(function () {
    Route::get('/', 'index')->name('connect');
    Route::post('/login', 'login');
    Route::post('/register', 'register');

    Route::get('/check_email', 'email_check_page')->name("connect.check_email");
    Route::post('/check_email', 'email_checker');

    Route::get('/email_sender', 'email_send_page')->name("connect.ask_check_email");
    Route::post('/email_sender', 'email_sender');

    Route::get("/logout", "logout")->name("connect.logout");
});


/**
 * API de discussion
 */
Route::prefix('api')->middleware('auth')->middleware("setLang")->group(function () {

    Route::controller(\App\Http\Controllers\ApiMainController::class)->group(function () {
        Route::get('/group-list', 'getGroupList');
        Route::get('/block-list', 'getBlockList');
        Route::get('/invite-list', 'getInviteList');
        Route::post('/create-group', 'createGroup')->name("api.create_group");

        Route::post('/block', 'blockUser');
        Route::post('/unblock', 'unblockUser');
        Route::post('/kick-user', 'kickUser');
    });

    Route::prefix('/channels/{id}')->controller(\App\Http\Controllers\ApiChannelController::class)->group(function () {
        Route::middleware('auth.channel')->group(function () {
            Route::get('/get-all-messages', 'getAllMessages')->name('channels.messages.all');
            Route::get('/get-new-messages', 'getNewMessages')->name('channels.messages.new');
            Route::get('/get-members', 'getMembers')->name('channels.members');

            Route::post('/send-message', 'sendMessage')->name('channels.send');
            Route::post('/delete-message', 'deleteMessage')->name('channels.delete');
            Route::post('/quit-confirm-channel', 'quitConfirmChannel')->name('channels.quitconfirm');
            Route::post('/add-member', 'sendInvite')->name('channels.add');
        });
        Route::post('/accept-invite', 'acceptInvitation');
        Route::post('/reject-invite', 'rejectInvitation');
    });


    Route::prefix('connect')->controller(\App\Http\Controllers\ApiConnectController::class)->group(function () {
        Route::post('/login', 'login')->name('api.login');
        Route::post('/logout', 'logout')->name('api.logout');  // corrigé ici
    });

});



/**
 * Menu de discussions
 */
Route::prefix('/channels')->middleware('auth.basic')->middleware("setLang")->controller(\App\Http\Controllers\ChannelsController::class)->group(function () {
    Route::get('/', 'index')->name('channels.index');

    Route::prefix('/{id}')->name("channels.id")->middleware("auth.channel")->group(function () {
        Route::get('/quit-channel', 'showQuitChannel')->name('channels.quit');
        Route::get('/group-member', 'showGroupMember')->name('channels.list');
        Route::get('/add-member', 'showAddMember')->name('channels.add');
    });

});


/**
 * Menu d'options du compte
 */
Route::prefix('/account')->middleware("setLang")->controller(App\Http\Controllers\AccountController::class)->group(function () {
    Route::get('/', 'index');
});


/**
 * Menu d'administration
 */
Route::prefix('/admin')->middleware("auth.admin")->middleware("setLang")->controller(\App\Http\Controllers\AdminController::class)->group(function () {
    Route::get('/', 'index');
});


/**
 * Menu à propos
 */
Route::prefix('/about')->middleware("setLang")->controller(\App\Http\Controllers\AboutController::class)->group(function () {
    Route::get('/', 'index');
});


/**
 * Menu de contacts
 */
Route::prefix('/contact')->middleware("setLang")->controller(\App\Http\Controllers\ContactController::class)->group(function () {
    Route::get('/', 'index');
});

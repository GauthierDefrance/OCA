<?php

use Illuminate\Support\Facades\Route;


/**
 * Menu principal
 */
Route::prefix('/')->controller(\App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index')->name('home');

});


/**
 * Menu de Connection
 */
Route::prefix('/connect')->controller(\App\Http\Controllers\ConnectController::class)->group(function () {
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
Route::prefix('api')->middleware('auth')->group(function () {

    Route::controller(\App\Http\Controllers\ApiMainController::class)->group(function () {
        Route::get('/group-list', 'getGroupList');
        Route::get('/block-list', 'getBlockList');
        Route::get('/invite-list', 'getInviteList');
        Route::post('/create-group', 'createGroup')->name("api.create_group");
    });

    Route::prefix('channels/{id}')->controller(\App\Http\Controllers\ApiChannelController::class)
        ->middleware('auth.channel')->group(function () {
            Route::get('/get-all-messages', 'getAllMessages')->name('channels.messages.all');
            Route::get('/get-new-messages', 'getNewMessages')->name('channels.messages.new');
            Route::get('/get-members', 'getMembers')->name('channels.members');

            Route::post('/send-message', 'sendMessage')->name('channels.send');
            Route::post('/delete-message', 'deleteMessage')->name('channels.delete');
            Route::post('/quit-confirm-channel', 'quitConfirmChannel')->name('channels.quitconfirm');
        });

    Route::prefix('connect')->controller(\App\Http\Controllers\ApiConnectController::class)->group(function () {
        Route::post('/login', 'login')->name('api.login');
        Route::post('/logout', 'logout')->name('api.logout');  // corrigé ici
    });

});



/**
 * Menu de discussions
 */
Route::prefix('/channels')->middleware('auth.basic')->controller(\App\Http\Controllers\ChannelsController::class)->group(function () {
    Route::get('/', 'index');


    Route::prefix('/{id}')->name("channels.id")->group(function () {
        Route::get('/quit-channel', 'quitChannel')->name('channels.quit');
        Route::get('/group-member', 'quitChannel')->name('channels.quit');
        Route::get('/add-member', 'quitChannel')->name('channels.quit');
    });


    Route::prefix('/channel-create')->group(function () {
        Route::get('/', 'create')->name('channels.create');
    });

    Route::prefix('/block')->group(function () {
        Route::get('/', 'show')->name('channels.show');
    });

    Route::prefix('/invite')->group(function () {
        Route::get('/', 'show')->name('channels.show');
    });





});


/**
 * Menu d'options du compte
 */
Route::prefix('/account')->controller(App\Http\Controllers\AccountController::class)->group(function () {
    Route::get('/', 'index');
});


/**
 * Menu d'administration
 */
Route::prefix('/admin')->middleware("auth.admin")->controller(\App\Http\Controllers\AdminController::class)->group(function () {
    Route::get('/', 'index');
});


/**
 * Menu à propos
 */
Route::prefix('/about')->controller(\App\Http\Controllers\AboutController::class)->group(function () {
    Route::get('/', 'index');
});


/**
 * Menu de contacts
 */
Route::prefix('/contact')->controller(\App\Http\Controllers\ContactController::class)->group(function () {
    Route::get('/', 'index');
});

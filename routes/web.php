<?php

use App\Livewire\Event\EventSignup;
use App\Livewire\Events\CreateEvent;
use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\ManageUser;
use App\Http\Livewire\PhotoFrame;

use Illuminate\Support\Facades\Artisan;
// use App\Models\Event;
use App\Http\Controllers\HomeController;
// use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\BkashTokenizePaymentController;
use App\Livewire\Event\ShowSignup;
use App\Livewire\Event\SignupsTable;
use App\Livewire\Event\ManageSignup;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeController::class)->name('home');

// Route::get('/users', ManageUser::class)->name('users');


Route::prefix('events')->middleware(['auth'])->group(function () {
    Route::get('/create', CreateEvent::class)->name('event.create');

    Route::get('/', function () {
        return view('livewire.events.index');
    })->name('events');
});




Route::prefix('bkash')->middleware(['auth', 'role:admin'])->group(function () {

    //search payment
    Route::get('/search/{trxID}', [BkashTokenizePaymentController::class, 'searchTnx'])->name('bkash-search');

    //refund payment routes
    Route::post('/refund', [BkashTokenizePaymentController::class, 'refund'])->name('bkash.refund');
    Route::post('/refund/status', [BkashTokenizePaymentController::class, 'refundStatus'])->name('bkash-refund-status');
});

Route::prefix('bkash')->middleware(['auth'])->group(function () {

    Route::get('/payment', [BkashTokenizePaymentController::class, 'index'])->name('bkash.index');
    Route::get('/callback', [BkashTokenizePaymentController::class, 'callBack'])->name('bkash-callBack');
    Route::post('/create-payment', [BkashTokenizePaymentController::class, 'createPayment'])->name('bkash-create-payment');
    // Route::post('/execute-payment', [BkashTokenizePaymentController::class, 'executePayment'])->name('bkash.executePayment');
    // Route::post('/query-payment', [BkashTokenizePaymentController::class, 'queryPayment'])->name('bkash.queryPayment');
});


Route::prefix("{event:slug}")->middleware(['auth'])->group(function () {

    Route::get('/signup', EventSignup::class)
        ->name('signup');

    // Route::get('/signuplist', SignupsTable::class)
    //     ->name('signups.index');

    // Route::get('/signuplist/manage', ManageSignup::class)->name('manage-signups');
});

// Route::get('/{event:slug}/signup', EventSignup::class)
//     ->middleware(['auth'])
//     ->name('signup');

Route::get('/{eventSlug}/signup/browse', SignupsTable::class)
    ->middleware(['auth'])
    ->name('signups.index');

Route::get('/{eventSlug}/signup/manage', ManageSignup::class)->name('manage-signups');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/{event:slug}/signuplist', SignupsTable::class)->name('signups.index');
// });






// Route::get('/registrations', function () { return view('pages.signup-list-public');})->name('signups-public');
// Route::get('/reg/contacts', function () { return view('pages.signup-list-contact');})->name('signups-contacts');
// Route::get('/{event:slug}/reg/payments', function () { return view('pages.signup-list-payments');})->name('signups-payments');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/paymentmethod', function () {
    return view('regfee');
})->name('paymentmethod');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/bkash-payment/{amount}', function ($amount) {
    return view('bkash.payment', compact('amount'));
})->name('bkash.payment');


Route::get('/frame', function () {
    return view('pages.photo-frame-page');
})->name('frame');

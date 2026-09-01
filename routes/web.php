<?php

use App\Http\Controllers\Admin\ClearCacheController;
use Illuminate\Support\Facades\Route;
use App\Models\Settings;
use App\Http\Controllers\RecoveryController;
use App\Http\Controllers\ClaimRegistrationController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use App\Http\Controllers\AutoTaskController;
use App\Http\Controllers\HomePageController;
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

require __DIR__ . '/admin/web.php';
require __DIR__ . '/user/web.php';
require __DIR__ . '/botman.php';

//activate and deactivate Online Trader
Route::any('/activate', function () {
	return view('activate.index', [
		'settings' => Settings::where('id', '1')->first(),
	]);
})->middleware(['isadmin']);

// Route::get('register-license', [ClearCacheController::class, 'saveLicense']);

// Route::any('/revoke', function () {
// 	return view('revoke.index');
// });

// Route::post('/reset-password', [NewPasswordController::class, 'store'])
// 	->middleware(['guest:' . config('fortify.guard')])
// 	->name('password.update');

//cron url — protected with secret token (set CRON_SECRET in .env)
Route::get('/cron', [AutoTaskController::class, 'autotopup'])->name('cron');

// CSRF token refresh endpoint
Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
})->name('csrf.refresh');
//Front Pages Route
Route::get('/', [RecoveryController::class, 'home'])->name('recovery.home');
Route::get('/services', [RecoveryController::class, 'services'])->name('recovery.services');
Route::get('/services/{slug}', [RecoveryController::class, 'serviceDetail'])->name('recovery.service');
Route::get('/contact', [RecoveryController::class, 'contact'])->name('recovery.contact');
Route::get('/start-your-claim', [RecoveryController::class, 'claim'])->name('recovery.claim');
Route::get('/testimonials', [RecoveryController::class, 'testimonials'])->name('recovery.testimonials');
Route::get('/our-company', [RecoveryController::class, 'about'])->name('recovery.about');
Route::get('/page/{slug}', [RecoveryController::class, 'page'])->name('recovery.page');
Route::get('/category/{slug}', [RecoveryController::class, 'category'])->name('recovery.category');
Route::post('/start-your-claim', [ClaimRegistrationController::class, 'submitClaimWithRegistration'])->name('recovery.claim.submit');
Route::post('/contact', [RecoveryController::class, 'submitContact'])->name('recovery.contact.submit');

Route::post('sendcontact', 'App\Http\Controllers\User\UsersController@sendcontact')->name('enquiry');

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

Route::get('/', function () {
    return view('index');
});

Route::fallback(function () {
    /** This will check for the 404 view page unders /resources/views/errors/404 route */
    return view('not-found-page');
});

use App\Http\Controllers\inscription as ControllersInscription;
Route::post('/inscription', [ControllersInscription::class, 'DoIt'])->name('inscription');


Route::get('/entreprise', function () {
    return view('entreprise');
});

Route::get('/offres', function () {
    return view('offres');
});

Route::get('/reseau', function(){
    return view('accounts');
})->name('accounts');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -----------------------ROADS TO THE RIGHT DISPLAY-----------------------------------------------------

use App\Http\Controllers\rightdisplay;
Route::get('/index/getRightItem', function() {
   return view('offres');
});

Route::get('/offres/getRightItem', [rightdisplay::class, 'offres']);
Route::get('/accounts/getRightItem', [rightdisplay::class, 'account']);
Route::get('/entreprise/getRightItem', [rightdisplay::class, 'company']);

// -----------------------MODIFICATION DU COMPTE-----------------------------------------------------

use App\Http\Controllers\ChangeInfo as ControllersChangeInfo;
Route::post('/ChangeInfo', [ControllersChangeInfo::class, 'ChangeInfo'])->name('ChangeInfo');

// -----------------------OFFRE-----------------------------------------------------

use App\Http\Controllers\offer as Controllersoffer;
Route::post('/createoffer', [Controllersoffer::class, 'create'])->name('createoffer');

Route::post('/offres/delete', [Controllersoffer::class, 'delete'])->name('deleteOffers');

Route::post('/offres/updateOffers', [Controllersoffer::class, 'update'])->name('updateOffers');

// -----------------------ROADS TO THE QUICK SEARCH-----------------------------------------------------

use App\Http\Controllers\quicksearch;

Route::get('/offres/index/OffersQuick', function() {
    return view('offres');
 });

Route::get('/Index/OffersQuick', [quicksearch::class, 'offres_index'])->name('OffersQuickIndex');
Route::get('/CompanysQuick', [quicksearch::class, 'companys'])->name('CompanyQuick');

// -----------------------POSTULER-----------------------------------------------------

use App\Http\Controllers\apply as Controllersapply;
Route::post('/apply', [Controllersapply::class, 'applysend'])->name('apply');

// -----------------------ENTREPRISE-----------------------------------------------------

use App\Http\Controllers\company as Controllerscompany;
Route::post('/company/createcompany', [Controllerscompany::class, 'create'])->name('createcompany');
Route::post('/company/updatecompany', [Controllerscompany::class, 'update'])->name('updatecompany');
Route::post('/company/deletecompany', [Controllerscompany::class, 'delete'])->name('deletecompany');
Route::post('/company/ratecompany', [Controllerscompany::class, 'rate'])->name('ratecompany');
Route::get('/company/hide', [Controllerscompany::class, 'hide'])->name('hide');

// -----------------------WishList----------------------------------------------------
use App\Http\Controllers\leftlist as ControllerLeftList;
Route::get('/wishlist/{id?}',  [ControllerLeftList::class, 'wishlist'])->name('wish');

use App\Http\Controllers\wishlist as WishListController;
Route::post('/wishlist/add', [WishListController::class, 'add'])->name('addwish');
Route::post('/wishlist/delete', [WishListController::class, 'delete'])->name('deletewish');


// -----------------------Account----------------------------------------------------

use App\Http\Controllers\account as ControllerAccount;

Route::post('/reseau/delete', [ControllerAccount::class, 'delete'])->name('deleteaccount');


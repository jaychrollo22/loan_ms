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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Loans
Route::get('loans', 'LoanController@index');
Route::get('create-loan', 'LoanController@create');
Route::post('new-loan', 'LoanController@store');
Route::get('edit-loan/{id}', 'LoanController@edit');
Route::post('update-loan/{id}', 'LoanController@update');

//Settings > Loan Terms
Route::get('loan-terms', 'LoanTermController@index');
Route::post('new-loan-term', 'LoanTermController@store');
Route::get('edit-loan-term/{id}', 'LoanTermController@edit');
Route::post('update-loan-term/{id}', 'LoanTermController@update');

//Settings > Loan Types
Route::get('loan-types', 'LoanTypeController@index');
Route::post('new-loan-type', 'LoanTypeController@store');
Route::get('edit-loan-type/{id}', 'LoanTypeController@edit');
Route::post('update-loan-type/{id}', 'LoanTypeController@update');

//Settings > Loan Interests
Route::get('loan-interests', 'LoanInterestController@index');
Route::post('new-loan-interest', 'LoanInterestController@store');
Route::get('edit-loan-interest/{id}', 'LoanInterestController@edit');
Route::post('update-loan-interest/{id}', 'LoanInterestController@update');

Route::group(['prefix' => 'borrower-types'], function () {
    Route::get('/lists', 'BorrowerTypeController@lists');
});

Route::group(['prefix' => 'countries'], function () {
    Route::get('/lists', 'CountryController@lists');
});

Route::group(['prefix' => 'regions'], function () {
    Route::get('/lists/{country_id}', 'RegionController@lists');
});

Route::group(['prefix' => 'counties'], function () {
    Route::get('/lists/{region_id}', 'CountyController@lists');
});

Route::group(['prefix' => 'townships'], function () {
    Route::get('/lists/{region_id}/{county_id}', 'TownshipController@lists');
});

Route::group(['prefix' => 'civil-statuses'], function () {
    Route::get('/lists', 'CivilStatusController@lists');
});

Route::group(['prefix' => 'valid-id-types'], function () {
    Route::get('/lists', 'ValidIdTypeController@lists');
});

Route::group(['prefix' => 'nature-of-businesses'], function () {
    Route::get('/lists', 'NatureOfBusinessController@lists');
});

Route::group(['prefix' => 'property-types'], function () {
    Route::get('/lists', 'PropertyTypeController@lists');
});

Route::group(['prefix' => 'borrowers'], function () {
    Route::get('/main', 'BorrowerController@index')->name('borrowers');
    Route::get('/lists', 'BorrowerController@lists');
    Route::get('/create', 'BorrowerController@create');
    Route::post('/store', 'BorrowerController@store');
    Route::delete('/delete/{borrower}', 'BorrowerController@destroy');
});
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

//Settings > Loan Terms
Route::get('loan-terms', 'LoanTermController@index');
Route::post('new-loan-term', 'LoanTermController@store');
Route::get('edit-loan-term/{id}', 'LoanTermController@edit');
Route::post('update-loan-term/{id}', 'LoanTermController@update');

Route::group(['prefix' => 'borrowers'], function () {
    Route::get('/main', 'BorrowerController@index')->name('borrowers');
    Route::get('/lists', 'BorrowerController@lists');
    Route::get('/create', 'BorrowerController@create');
    Route::post('/store', 'BorrowerController@store');
    Route::delete('/delete/{borrower}', 'BorrowerController@destroy');
});
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/* Authentification */

/*Route::post('/login', [
   'as' => 'signIn',
   'uses' => 'ControllerLogin@signIn'
]);*/

Route::post('/getConnexion', 'ControllerLogin@signIn')->middleware('cors');

Route::prefix('frais')->group(function () {
    Route::get('listeFrais/{id}', 'ControllerFrais@getListeFicheFrais')->middleware('cors');
    Route::get('listeFraisMontant/{v1}/{v2}', 'ControllerFrais@getListeFicheFraisMontant')->middleware('cors');
   Route::get('listeFraisMontantQuery','ControllerFrais@getListeFicheFraisMontantQuery')->middleware('cors');

    Route::get('getVisiteurFraisMax','ControllerFrais@getVisiteurFraisMax');

   Route::get('getListeFraisVisiteur/{seuil}','ControllerFrais@getListeFraisVisiteur')->middleware('cors');
   Route::get('listeFraisPeriode/{id}', 'ControllerFrais@getListeFraisPeriode');
    Route::get('getUnFrais/{id}', 'ControllerFrais@getUnFrais')->middleware('cors');
    Route::post('updateFicheFrais', 'ControllerFrais@updateFicheFrais')->middleware('cors');
    Route::post('addFicheFrais', 'ControllerFrais@addFicheFrais')->middleware('cors');
    Route::post('deleteFicheFrais', 'ControllerFrais@suppressionFrais')->middleware('cors');


});

Route::prefix('visiteur')->group(function () {
    Route::get('liste', 'ControllerVisiteur@getTousLesVisiteurs');
    Route::get('recherche/{id}', 'ControllerVisiteur@affiche');
    Route::post('ajout', 'ControllerVisiteur@ajout');
    Route::put('update/{id}', 'ControllerVisiteur@update');
    Route::delete('supprime/{id}', 'ControllerVisiteur@delete');

});
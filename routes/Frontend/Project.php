<?php

/**
 * Frontend Project Controllers
 * All route names are prefixed with 'frontend.projects'.
 */
Route::group(['namespace' => 'Project'], function () {

    /*
     * These routes require the user to be logged in
     */
    Route::group(['middleware' => 'auth'], function () {
    	//
    });

    /*
     * These routes require no user to be logged in
     */
    Route::group(['middleware' => 'guest'], function () {

    	Route::get('projects/{uuid}', 'ProjectController@check')->name('projects.check');

    });
});

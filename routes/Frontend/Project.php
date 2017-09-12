<?php

/**
 * Frontend Project Controllers
 * All route names are prefixed with 'frontend.projects'.
 */
Route::group(['namespace' => 'Project'], function () {

	Route::get('projects/{uuid}', 'ProjectController@check')->name('projects.check');
	Route::post('projects/{project}', 'ProjectController@verify')->name('projects.verify');
	Route::get('projects/{project}/report', 'ProjectController@report')->name('projects.report');

});

<?php

Route::group([
    'namespace'  => 'Project',
    'middleware' => 'access.routeNeedsPermission:view-backend;manage-project',
], function() {

	// Approval
    Route::get('projects/{project}/approve', 'ProjectController@approve')->name('projects.approve');
    Route::get('projects/{project}/unapprove', 'ProjectController@unapprove')->name('projects.unapprove');
    Route::resource('projects', 'ProjectController');
});

<?php

Route::group([
    'namespace'  => 'Project',
    'middleware' => 'access.routeNeedsPermission:view-backend;manage-project',
], function() {

    Route::resource('projects', 'ProjectController');
});

<?php

Route::group([
    'namespace'  => 'Report',
], function() {

    Route::resource('reports', 'ReportController');
});

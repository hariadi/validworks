<?php

Route::group([
    'namespace'  => 'Report',
], function() {

	Route::get('reports/{report}/solve', 'ReportController@solve')->name('reports.solve');
    Route::get('reports/{report}/unsolve', 'ReportController@unsolve')->name('reports.unsolve');
    Route::resource('reports', 'ReportController');
});

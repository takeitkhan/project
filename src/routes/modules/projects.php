<?php

use Tritiyo\Project\Http\Controllers\ProjectController;

Route::group(['middleware' => ['web','role:1,7']], function () {
    Route::any('projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::any('projects/site/{id}', [ProjectController::class, 'site'])->name('projects.site');

    Route::resources([
        'projects' => ProjectController::class,
    ]);
});

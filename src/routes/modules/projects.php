<?php

use Tritiyo\Project\Http\Controllers\ProjectController;

Route::group(['middleware' => ['web','role:1,7']], function () {
    Route::any('projects/search', [ProjectController::class, 'search'])->name('projects.search');

    Route::resources([
        'projects' => ProjectController::class,
    ]);
});

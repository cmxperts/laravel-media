<?php

use Illuminate\Support\Facades\Route;
use CmXperts\MediaManager\Http\Controllers\UploadController;

Route::group([
    'namespace' => '\CmXperts\MediaManager\Http\Controllers',
    'middleware' => config('cmx_media.middleware'),
    'prefix' => config('cmx_media.route_prefix')
], function () {
    Route::resource('/', UploadController::class)->except(['destroy', 'show', 'edit'])
        ->names([
            'index' => 'cmx-media.index',
            'store' => 'cmx-media.store',
            'update' => 'cmx-media.update',
            'create' => 'cmx-media.create',
        ]);

    Route::controller(UploadController::class)->group(function () {
        Route::get('/destroy/{id}', 'destroy')->name('cmx-media.destroy');
        Route::any('/file-info', 'file_info')->name('cmx-media.file-info');

        Route::post('/show-uploader', 'show_uploader')->name('cmx-media.uploader');
        Route::post('/upload', 'upload')->name('cmx-media.upload');
        Route::get('/get_uploaded_files', 'get_uploaded_files')->name('cmx-media.get_uploaded_files');
        Route::post('/get_file_by_ids', 'get_preview_files')->name('cmx-media.get_preview_files');
        Route::get('/download/{id}', 'attachment_download')->name('cmx-media.download_attachment');
    });
});

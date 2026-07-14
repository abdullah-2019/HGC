<?php

use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Contact Submissions
    Route::get('/contacts/submissions', [ContactController::class, 'submissions'])
        ->name('contacts.submissions');
    Route::get('/contacts/submissions/{submission}', [ContactController::class, 'showSubmission'])
        ->name('contacts.submissions.show');
    Route::patch('/contacts/submissions/{submission}', [ContactController::class, 'updateSubmission'])
        ->name('contacts.submissions.update');
    Route::post('/contacts/submissions/{submission}/mark-read', [ContactController::class, 'markAsRead'])
        ->name('contacts.submissions.mark-read');

    // Contact Info (edit only, no create/delete)
    Route::get('/contacts/info', [ContactController::class, 'info'])
        ->name('contacts.info');
    Route::put('/contacts/info', [ContactController::class, 'updateInfo'])
        ->name('contacts.info.update');
});

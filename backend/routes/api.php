<?php

use App\Presentation\Api\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['cors', 'api_key'])->group(function () {
    Route::prefix('v1/forms')->group(function () {
        // Get All Forms
        Route::get('/', [FormController::class, 'getForms']);

        // Get Form By Type
        Route::get('/{formType}', [FormController::class, 'getFormByType'])
            ->where('formType', 'kejadian|kerugian');
            
        // Submit Form 
        Route::post('/{formType}/submit', [FormController::class, 'submitForm'])
            ->where('formType', 'kejadian|kerugian');

    });

    Route::prefix('v1/submissions')->group(function () {
        // Get Submissions
        Route::get('/', [FormController::class, 'getFormSubmissions']);
    });
});

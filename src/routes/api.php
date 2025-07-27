<?php
 
use Illuminate\Support\Facades\Route; 

Route::get("/testpackage", function(){
    return response("Package Api Working...");//->json(["status" => 200, "message" => "Package Api Working..."]);
});

Route::prefix('neo-nep-location')->group(function () {
    Route::apiResource('state', StateApiController::class);
    Route::apiResource('district', DistrictApiController::class);
    Route::apiResource('administrative-area-type', AdministrativeAreaTypeApiController::class);
    Route::apiResource('administrative-area-name', AdministrativeAreaApiController::class);
});



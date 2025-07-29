<?php
 
use Illuminate\Support\Facades\Route;
use Neo\NepLocation\Http\Controller;
use Neo\NepLocation\Http\Modules\AdministrativeAreas\AdministrativeAreaApiController;
use Neo\NepLocation\Http\Modules\AdministrativeAreaTypes\AdministrativeAreaTypeApiController;
use Neo\NepLocation\Http\Modules\Districts\DistrictApiController;
use Neo\NepLocation\Http\Modules\States\StateApiController;

Route::prefix('neo-nep-location')->group(function () {
    Route::apiResource('state', StateApiController::class);
    Route::apiResource('district', DistrictApiController::class);
    Route::apiResource('administrative-area-type', AdministrativeAreaTypeApiController::class);
    Route::apiResource('administrative-area-name', AdministrativeAreaApiController::class);
});
Route::get('neo-nep-location/feed-data', [Controller::class, 'feedData']);



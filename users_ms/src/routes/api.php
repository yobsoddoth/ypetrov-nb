<?php

use App\Http\Requests\UserRequest;
use App\Jobs\UserStoredNotificationJob;
use Domain\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/_healthcheck', function (Request $request) {
    return response()->json([
        'health' => 'OK',
        'request' => $request->toArray(),
    ]);
});

Route::post('/users', function (UserRequest $request, UserServiceInterface $service) {
    $userData = $request->toArray();

    $service->storeUser($userData);
    UserStoredNotificationJob::dispatch($userData);

    return response()->json($userData, 201);
});

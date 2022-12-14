<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ExpertsController;
use App\Http\Controllers\sessionsController;
use App\Http\Controllers\UsersController;
use App\Models\CalendarDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\CallLike;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

//sessions routes
Route::post('register', [sessionsController::class, 'create']);
Route::post('login', [sessionsController::class, 'login'])->name('login');
Route::post('logout', [sessionsController::class, 'logout']);

//experts routes
Route::get('experts', [ExpertsController::class, 'index']);
Route::prefix('expert')->group(function () {
    Route::post('update', [ExpertsController::class, 'update']);
    Route::post('uploadprofilephoto', [ExpertsController::class, 'upload_profile_photo']);
    Route::get('/', [ExpertsController::class, 'show']);
    Route::post('updaterating', [ExpertsController::class, 'update_rating']);
    Route::get('appointments', [ExpertsController::class, 'appointments']);
    Route::post('updateschedule', [ExpertsController::class, 'update_schedule']);
    Route::get('upcomingcalendar', [CalendarController::class, 'get_availability']);
    Route::post('book', [CalendarController::class, 'reserve']);
});

//chats controller
Route::get('chat', [ChatsController::class, 'get_chat']);

//users routes
Route::prefix('user')->group(function () {
    Route::get('favorites', [UsersController::class, 'favorites']);
    Route::post('changefavorite', [UsersController::class, 'change_favorite_state']);
    Route::post('pay', [UsersController::class, 'pay']);
    Route::post('sendmessage', [UsersController::class, 'send_message']);
    Route::get('chats', [UsersController::class, 'chats']);
});



//TODO:
// list all appointments of an expert "after the search time"
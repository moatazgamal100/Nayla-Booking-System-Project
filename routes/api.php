<?php

use App\Models\HotelImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiHotelController;
use App\Http\Controllers\ApiReviewController;

use App\Http\Controllers\ApiHotelRoomController;
use App\Http\Controllers\ApiHotelDescController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookController;

Route::get('/booking-data', 'App\Http\Controllers\ApiController@getBookingData');

//----------------------- Login &logout-------------------
Route::group(['middleware' => ['api-auth']], function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
});
Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);

Route::get('/profile/{id}', [ProfileController::class, 'show']);
Route::put('/editprofile/{id}', [UserController::class, 'update']);

Route::get('/hotels' , [ApiHotelController::class, 'index']);
Route::get('hotels/{id}', [ApiHotelController::class, "show"]);
Route::put('hotels/{id}', [ApiHotelController::class, "update"]);
Route::post('/hotels', [ApiHotelController::class, 'store']);

// !------ HotelDesc ---------
Route::get('/hoteldesc/{id}', [ApiHotelDescController::class, 'show']);

//add room routes
Route::get('/room/{roomId}', [ApiHotelRoomController::class, 'show']);
Route::post('/addroom' , [ApiHotelRoomController::class, 'store']);


// admin request
Route::get('/request' , [BookController::class, 'index']);
//checkout api
Route::post('/checkout', [BookController::class, 'create']);


// !----- Get & post Review ----------------
Route::post('/reviews', [ApiReviewController::class, 'store']);
Route::get('/reviews/{hotelId}', [ApiReviewController::class, 'getReviewsByHotelId']);
Route::get('/reviews', [ApiReviewController::class, 'index']);

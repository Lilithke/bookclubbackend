<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MemberController;

Route::apiResource('/members', MemberController::class);
Route::post('/members/{id}/pay', [MemberController::class,'pay']);

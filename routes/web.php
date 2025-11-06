<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


if (file_exists(base_path('routes/api.php'))) {
    require base_path('routes/api.php');
}
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    abort(500, 'Unauthorized access');
    // return ['RR Service - Auto Assist' => app()->version()];
});


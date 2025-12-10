<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route simple avec texte
Route::get('/hello', function () {
    return 'Bonjour Laravel!';
});

// Route avec paramètre
Route::get('/user/{name}', function ($name) {
    return "Bonjour, $name!";
});

// Route avec paramètre optionnel
Route::get('/user/{name?}', function ($name = 'Invité') {
    return "Bonjour, $name!";
});

// Route retournant une view
Route::get('/about', function () {
    return view('about');
});

// Route avec données passées à la view
Route::get('/contact', function () {
    $email = 'contact@example.com';
    return view('contact', ['email' => $email]);
});

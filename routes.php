<?php

Route::get('/entree/login', function () {
    \LearnKit\Entree\Classes\Entree::instance()->login();
});
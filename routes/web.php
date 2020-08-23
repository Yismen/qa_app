<?php

use Illuminate\Support\Facades\Route;

Route::prefix('qa_app')
    ->middleware(['web', 'auth'])
    ->namespace('Dainsys\QAApp\Controllers')
    ->group(function () {
        Route::get('admin', 'AdminController')->name('qa_app.dashboards.admin');

        Route::resource('question_type', 'QuestionTypeController')->names('qa_app.question_type');

        Route::resource('question_option', 'QuestionOptionController')->names('qa_app.question_option');

        Route::resource('form', 'FormController')->names('qa_app.form');

        Route::resource('question', 'QuestionController')->names('qa_app.question');
    });

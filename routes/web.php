<?php

use Illuminate\Support\Facades\Route;

Route::prefix('qa_app')
    ->middleware(['web', 'auth'])
    ->namespace('Dainsys\QAApp\Http\Controllers')
    ->group(function () {
        Route::get('/', 'DashboardController@admin')->name('qa_app.dashboard.admin');
        Route::get('dashboard/user/{id}', 'DashboardController@user')->name('qa_app.dashboard.user');

        Route::resource('question_type', 'QuestionTypeController')->except(['create', 'destroy'])->names('qa_app.question_type');

        Route::resource('question_option', 'QuestionOptionController')->except(['create', 'destroy'])->names('qa_app.question_option');

        Route::resource('form', 'FormController')->except(['create', 'destroy'])->names('qa_app.form');

        Route::resource('question', 'QuestionController')->except(['create', 'destroy'])->names('qa_app.question');

        Route::resource('audit', 'AuditController')->except(['create', 'destroy'])->names('qa_app.audit');
        Route::get('audit/create/form/{form_id}/user/{user_id}', 'AuditController@create')->name('qa_app.audit.create');
        Route::post('audit/select', 'AuditController@select')->name('qa_app.audit.select');
    });

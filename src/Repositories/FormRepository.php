<?php

namespace Dainsys\QAApp\Repositories;

use Dainsys\QAApp\Models\Form;

class FormRepository
{
    public static function all()
    {
        return Form::orderBy('name')
            ->with('questions')
            ->get();
    }
}

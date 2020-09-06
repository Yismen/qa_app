<?php

namespace Dainsys\QAApp\Models;

class Form extends BaseModel
{
    protected $table = 'qa_app_forms';

    protected $fillable = ['name', 'goal_percentage'];

    public function questions()
    {
        return $this->hasmany(Question::class);
    }
}

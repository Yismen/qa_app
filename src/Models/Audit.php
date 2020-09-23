<?php

namespace Dainsys\QAApp\Models;

use Dainsys\QAApp\Models\Traits\AuditableTrait;
use Dainsys\QAApp\Repositories\FormRepository;
use Dainsys\QAApp\Repositories\UserRepository;

class Audit extends BaseModel
{
    use AuditableTrait;

    protected $fillable = [
        'form_id',
        'user_id',
        'production_date',
        'max_points',
        'passes',
        'points',
        'data',
    ];

    protected $table = 'qa_app_audits';

    protected $dates = ['production_date'];

    protected $appends = ['points_goal'];

    protected $casts = [
        'passes' => 'boolean'
    ];

    public function getDataAttribute()
    {
        return json_decode($this->attributes['data']);
    }

    public function user()
    {
        return $this->belongsTo(resolve('App\User'));
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}

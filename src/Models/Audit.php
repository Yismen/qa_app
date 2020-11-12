<?php

namespace Dainsys\QAApp\Models;

use App\User;
use Dainsys\QAApp\Models\Traits\AuditableTrait;

class Audit extends BaseModel
{
    use AuditableTrait;

    protected $fillable = [
        'form_id',
        'user_id',
        'production_date',
        'transaction',
        'max_points',
        'points_goal',
        'passes',
        'points',
        'data',
    ];

    protected $table = 'qa_app_audits';

    protected $dates = ['production_date'];

    protected $casts = [
        'passes' => 'boolean'
    ];

    public function getDataAttribute()
    {
        return json_decode($this->attributes['data']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}

<?php

namespace Dainsys\QAApp\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

interface QAAppRepositoryInterface
{
    public static function all(): Collection;

    public static function list(): SupportCollection;
}

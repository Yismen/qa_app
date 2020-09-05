<?php

namespace Dainsys\QAApp\Http\Controllers;

class AdminController extends BaseController
{
    public function __invoke()
    {
        return view('qa_app::dashboards.admin');
    }
}

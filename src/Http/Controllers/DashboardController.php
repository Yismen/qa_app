<?php

namespace Dainsys\QAApp\Http\Controllers;

class DashboardController extends BaseController
{
    public function admin()
    {
        return view('qa_app::dashboards.admin');
    }
    public function user()
    {
        return view('qa_app::dashboards.user');
    }
}

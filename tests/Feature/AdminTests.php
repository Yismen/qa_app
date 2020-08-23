<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\QAApp\Tests\AppTestCase;

class AdminTests extends AppTestCase
{
    /** @test */
    public function guest_are_not_allowed()
    {
        $this->get(route('qa_app.dashboards.admin'))
            ->assertRedirect(route('login'));
    }
    /** @test */
    public function it_shows_damin_dashboard()
    {
        $this->actingAs($this->user());
        $this->get('/qa_app/admin')
            ->assertViewIs('qa_app::dashboards.admin');
    }
}

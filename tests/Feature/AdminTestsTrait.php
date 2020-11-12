<?php

namespace Dainsys\QAApp\Tests\Feature;

trait AdminTestsTrait
{
    /** @test */
    public function guest_are_not_allowed_on_admin()
    {
        $this->get(route('qa_app.dashboard.admin'))
            ->assertRedirect(route('login'));
    }
    /** @test */
    public function it_shows_damin_dashboard()
    {
        $this->actingAs($this->user());
        $this->get(route('qa_app.dashboard.admin'))
            ->assertViewIs('qa_app::dashboards.admin');
    }
}

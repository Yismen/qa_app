<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\Locky\Role;
use Dainsys\QAApp\Models\Audit;

trait AuditTestsTrait
{
    /** @test */
    public function guest_are_not_allowed_to_index_audit()
    {
        $this->get(route('qa_app.audit.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_show_audit()
    {
        $this->get(route('qa_app.audit.show', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_edit_audit()
    {
        $this->get(route('qa_app.audit.edit', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_update_audit()
    {
        $this->put(route('qa_app.audit.update', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    // public function guest_are_not_allowed_to_create_audit()
    // {
    //     $user = $this->user();
    //     $form = $this->create(Form::class);
    //     $this->post(route('qa_app.audit.create', ['form_id' => $form->id, 'user_id' => $user->id]))
    //         ->assertRedirect(route('login'));
    // }

    /** @test */
    public function guest_are_not_allowed_to_store_audit()
    {
        $this->post(route('qa_app.audit.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthorized_users_cant_view_index_audit()
    {
        $this->actingAs($this->user());

        $response = $this->get(route('qa_app.audit.index'));

        $response->assertForbidden();
    }

    /** @test */
    public function unauthorized_users_cant_view_single_audit()
    {
        $this->actingAs($this->user());
        $audit = factory(Audit::class)->create();

        $this->get(route('qa_app.audit.show', $audit->id))
            ->assertForbidden();
    }

    /** @test */
    // public function auauthorized_users_cant_create()
    // {
    //     $this->actingAs($this->user());
    //     $attributes = $this->make(Audit::class);

    //     $this->post(route('qa_app.audit.create'), $attributes)
    //         ->assertForbidden();
    // }

    /** @test */
    // public function auauthorized_users_cant_store_audit()
    // {
    //     $this->actingAs($this->user());
    //     $attributes = $this->make(Audit::class);

    //     $this->post(route('qa_app.audit.store'), $attributes)
    //         ->assertForbidden();
    // }

    /** @test */
    public function unauthorized_users_cant_edit_an_audit()
    {
        $this->actingAs($this->user());
        $audit = $this->create(Audit::class);

        $this->get(route('qa_app.audit.edit', $audit->id))
            ->assertForbidden();
    }

    /** @test */
    // public function ununauthorized_users_cant_update_an_audit()
    // {
    //     $this->actingAs($this->user());

    //     $audit = $this->create(Audit::class);
    //     $attributes = $this->make(Audit::class);

    //     $this->put(route('qa_app.audit.update', $audit->id), $attributes)
    //         ->assertForbidden();
    // }

    /** @test */
    public function it_shows_a_list_of_audits()
    {
        $this->withoutExceptionHandling();
        factory(Role::class)->create(['name' => config('qa_app.roles.user')]);
        $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));
        $this->create(Audit::class, [], 2);

        $audits = Audit::orderBy('production_date', 'DESC')->orderBy('points')
            ->with('user', 'form')
            ->paginate(25);

        $this->get(route('qa_app.audit.index'))
            ->assertViewIs('qa_app::audits.index')
            ->assertViewHas('audits')
            ->assertViewHas('formsList', (new Audit())->formsList)
            ->assertViewHas('usersList', (new Audit())->usersList);
    }

    /** @test */
    // public function it_shows_a_single_audit()
    // {
    //     $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));
    //     $audit = factory(Audit::class)->create();

    //     $this->get(route('qa_app.audit.show', $audit->id))
    //         ->assertViewIs('qa_app::audits.show')
    //         ->assertViewHas('audit', $audit);
    // }

    /** @test */
    // public function it_requires_form_id_and_user_id_to_create_an_audit()
    // {
    //     $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));
    //     $form = $this->create(Form::class);
    //     $user = $this->user();
    //     $attributes = ['user_id' => '', 'form_id' => ''];

    //     $this->get(route('qa_app.audit.create', ['form_id' => $form->id, 'user_id' => $user->id]))
    //         ->assertSessionHasErrors(
    //             'user_id',
    //             'form_id'
    //         );
    // }

    /** @test */
    // public function it_shows_a_form_to_create_an_audit()
    // {
    //     $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));
    //     $user = $this->user();
    //     $form = factory(Form::class)->create();
    //     $questions = $this->create(Question::class, ['form_id' => $form->id], 5);
    //     $attributes = ['user_id' => $user->id, 'form_id' => $form->id];

    //     $this->post(route('qa_app.audit.create'), $attributes)
    //         ->assertViewIs('qa_app::audits.create')
    //         ->assertViewHasAll([
    //             'form' => $form->load('questions.questionType.questionOptions'),
    //             'user' => $user
    //         ]);
    // }

    /** @test */
    // public function it_stores_an_audit()
    // {
    //     $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));
    //     $attributes = $this->make(Audit::class);

    //     $this->post(route('qa_app.audit.store'), $attributes)
    //         ->assertRedirect(route('qa_app.audit.index'));

    //     $this->assertDatabaseHas((new Audit())->getTable(), [
    //         'form_id' => $attributes['form_id'],
    //         'user_id' => $attributes['user_id'],
    //     ]);
    // }

    /** @test */
    // public function it_edits_an_audit()
    // {
    //     $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));
    //     $audit = $this->create(Audit::class);

    //     $this->get(route('qa_app.audit.edit', $audit))
    //         ->assertViewIs('qa_app::audits.edit')
    //         ->assertViewHas('audit', $audit)
    //         ->assertViewHas('formsList', $audit->formsList)
    //         ->assertViewHas('auditTypesList', $audit->auditTypesList);
    // }

    /** @test */
    // public function it_updates_an_audit()
    // {
    //     $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));

    //     $audit = $this->create(Audit::class);
    //     $attributes = $this->make(Audit::class);

    //     $this->put(route('qa_app.audit.update', $audit->id), $attributes)
    //         ->assertRedirect(route('qa_app.audit.index'));

    //     $this->assertDatabaseHas((new Audit)->getTable(), [
    //         'form_id' => $attributes['form_id'],
    //         'user_id' => $attributes['user_id'],
    //     ]);
    // }

    /** @test */
    public function it_validates_fields_are_required()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));
        $attributes = $this->make(Audit::class, ['form_id' => '', 'user_id' => '']);

        $this->post(route('qa_app.audit.store'), $attributes)
            ->assertSessionHasErrors('form_id')
            ->assertSessionHasErrors('user_id');

        $audit = $this->create(Audit::class);
        $this->put(route('qa_app.audit.update', $audit->id), $attributes)
            ->assertSessionHasErrors('form_id')
            ->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function it_validates_fields_exists()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.auditor')));
        $attributes = $this->make(Audit::class, ['form_id' => 444, 'user_id' => 444]);

        $this->post(route('qa_app.audit.store'), $attributes)
            ->assertSessionHasErrors('form_id')
            ->assertSessionHasErrors('user_id');

        $audit = $this->create(Audit::class);
        $this->put(route('qa_app.audit.update', $audit->id), $attributes)
            ->assertSessionHasErrors('form_id')
            ->assertSessionHasErrors('user_id');
    }
}

<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\QAApp\Models\Form;
use Dainsys\QAApp\Repositories\FormRepository;

trait FormTestsTrait
{
    /** @test */
    public function guest_are_not_allowed_to_index_form()
    {
        $this->get(route('qa_app.form.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_show_form()
    {
        $this->get(route('qa_app.form.show', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_edit_form()
    {
        $this->get(route('qa_app.form.edit', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_update_form()
    {
        $this->put(route('qa_app.form.update', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_store_form()
    {
        $this->post(route('qa_app.form.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function it_validates_fields_are_required_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Form::class, ['name' => '', 'goal_percentage' => '']);

        $this->post(route('qa_app.form.store'), $attributes)
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('goal_percentage');

        $form = $this->create(Form::class);
        $this->put(route('qa_app.form.update', $form->id), $attributes)
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('goal_percentage');
    }

    /** @test */
    public function it_validates_fields_must_be_unique_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $form = $this->create(Form::class);
        $second_form = $this->create(Form::class);
        // $attributes = $this->create(Form::class, ['name' => 'Repeated']);

        $this->post(route('qa_app.form.store'), ['name' => $form->name])
            ->assertSessionHasErrors('name');

        $this->put(route('qa_app.form.update', $form->id), ['name' => $second_form->name])
            ->assertSessionHasErrors('name');

        // Except when updating itself
        $this->put(route('qa_app.form.update', $form->id), ['name' => $form->name])
            ->assertSessionDoesntHaveErrors('name');
    }

    /** @test */
    public function it_validates_numeric_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Form::class, ['goal_percentage' => 'Not Numeric']);

        $this->post(route('qa_app.form.store'), $attributes)
            ->assertSessionHasErrors('goal_percentage');

        $form = $this->create(Form::class);
        $this->put(route('qa_app.form.update', $form->id), $attributes)
            ->assertSessionHasErrors('goal_percentage');
    }

    /** @test */
    public function it_validates_min_number_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Form::class, ['goal_percentage' => -0.1]);

        $this->post(route('qa_app.form.store'), $attributes)
            ->assertSessionHasErrors('goal_percentage');

        $form = $this->create(Form::class);
        $this->put(route('qa_app.form.update', $form->id), $attributes)
            ->assertSessionHasErrors('goal_percentage');
    }

    /** @test */
    public function it_validates_max_number_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Form::class, ['goal_percentage' => 100.1]);

        $this->post(route('qa_app.form.store'), $attributes)
            ->assertSessionHasErrors('goal_percentage');

        $form = $this->create(Form::class);
        $this->put(route('qa_app.form.update', $form->id), $attributes)
            ->assertSessionHasErrors('goal_percentage');
    }

    /** @test */
    public function unauthorized_users_cant_view_index_form()
    {
        $this->actingAs($this->user());

        $response = $this->get(route('qa_app.form.index'));

        $response->assertForbidden();
    }

    /** @test */
    public function unauthorized_users_cant_view_single_form()
    {
        $this->actingAs($this->user());
        $form = factory(Form::class)->create();

        $this->get(route('qa_app.form.show', $form->id))
            ->assertForbidden();
    }

    /** @test */
    public function auauthorized_users_cant_store_form()
    {
        $this->actingAs($this->user());
        $attributes = $this->make(Form::class);

        $response = $this->post(route('qa_app.form.store'), $attributes)
            ->assertForbidden();
    }

    /** @test */
    public function auntuahorized_users_cant_edits_a_form()
    {
        $this->actingAs($this->user());
        $form = $this->create(Form::class);

        $this->get(route('qa_app.form.edit', $form))
            ->assertForbidden();
    }

    /** @test */
    public function unauntuahorized_users_cant_updates_a_form()
    {
        $this->actingAs($this->user());

        $form = $this->create(Form::class);
        $attributes = $this->make(Form::class);

        $this->put(route('qa_app.form.update', $form->id), $attributes)
            ->assertForbidden();
    }

    /** @test */
    public function it_shows_a_list_of_forms()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $this->create(Form::class, [], 2);

        $forms = FormRepository::all();

        $this->get(route('qa_app.form.index'))
            ->assertViewIs('qa_app::forms.index')
            ->assertViewHas('forms', $forms);
    }

    /** @test */
    public function it_shows_a_single_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $form = factory(Form::class)->create();

        $this->get(route('qa_app.form.show', $form->id))
            ->assertViewIs('qa_app::forms.show')
            ->assertViewHas('form', $form->load('questions'));
    }

    /** @test */
    public function it_stores_a_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Form::class);

        $this->post(route('qa_app.form.store'), $attributes)
            ->assertRedirect(route('qa_app.form.index'));

        $this->assertDatabaseHas((new Form)->getTable(), $attributes);
    }

    /** @test */
    public function it_edits_a_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $form = $this->create(Form::class);

        $this->get(route('qa_app.form.edit', $form))
            ->assertViewIs('qa_app::forms.edit')
            ->assertViewHas('form', $form);
    }

    /** @test */
    public function it_updates_a_form()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));

        $form = $this->create(Form::class);
        $attributes = $this->make(Form::class, ['name' => 'Update Name']);

        $this->put(route('qa_app.form.update', $form->id), $attributes)
            ->assertRedirect(route('qa_app.form.index'));

        $this->assertDatabaseHas((new Form)->getTable(), $attributes);
    }
}

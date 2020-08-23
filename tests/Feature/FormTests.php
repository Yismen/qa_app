<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\QAApp\Models\Form;
use Dainsys\QAApp\Tests\AppTestCase;

class FormTests extends AppTestCase
{
    /** @test */
    public function guest_are_not_allowed_to_index()
    {
        $this->get(route('qa_app.form.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_show()
    {
        $this->get(route('qa_app.form.show', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_edit()
    {
        $this->get(route('qa_app.form.edit', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_update()
    {
        $this->put(route('qa_app.form.update', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_create()
    {
        $this->get(route('qa_app.form.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_store()
    {
        $this->post(route('qa_app.form.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function it_shows_a_list_of_forms()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user());
        $this->create(Form::class, [], 2);

        $forms = Form::all();

        $this->get(route('qa_app.form.index'))
            ->assertViewIs('qa_app::forms.index')
            ->assertViewHas('forms', $forms);
    }

    /** @test */
    public function it_shows_a_single_form()
    {
        $this->actingAs($this->user());
        $form = factory(Form::class)->create();

        $this->get(route('qa_app.form.show', $form->id))
            ->assertViewIs('qa_app::forms.show')
            ->assertViewHas('form', $form);
    }

    /** @test */
    public function it_creates_a_form()
    {
        $this->actingAs($this->user());

        $this->get(route('qa_app.form.create'))
            ->assertViewIs('qa_app::forms.create');
    }

    /** @test */
    public function it_stores_a_form()
    {
        $this->actingAs($this->user());
        $attributes = $this->make(Form::class);

        $this->post(route('qa_app.form.store', $attributes))
            ->assertRedirect(route('qa_app.form.index'));

        $this->assertDatabaseHas((new Form())->getTable(), $attributes);
    }

    /** @test */
    public function it_edits_a_form()
    {
        $this->actingAs($this->user());
        $form = $this->create(Form::class);

        $this->get(route('qa_app.form.edit', $form))
            ->assertViewIs('qa_app::forms.edit')
            ->assertViewHas('form', $form);
    }

    /** @test */
    public function it_updates_a_form()
    {
        $this->actingAs($this->user());

        $form = $this->create(Form::class);
        $attributes = ['name' => 'Update Name'];

        $this->put(route('qa_app.form.update', $form->id), $attributes)
            ->assertRedirect(route('qa_app.form.index'));

        $this->assertDatabaseHas((new Form())->getTable(), $attributes);
    }
}

<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\QAApp\Models\QuestionOption;
use Dainsys\QAApp\Repositories\QuestionOptionRepository;

trait QuestionOptionTestsTrait
{
    /** @test */
    public function guest_are_not_allowed_to_index_question_option()
    {
        $this->get(route('qa_app.question_option.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_show_question_option()
    {
        $this->get(route('qa_app.question_option.show', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_edit_question_option()
    {
        $this->get(route('qa_app.question_option.edit', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_update_question_option()
    {
        $this->put(route('qa_app.question_option.update', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_store_question_option()
    {
        $this->post(route('qa_app.question_option.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function it_validates_fields_are_required_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(QuestionOption::class, ['name' => '', 'value' => '', 'question_type_id' => '']);

        $this->post(route('qa_app.question_option.store'), $attributes)
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('value')
            ->assertSessionHasErrors('question_type_id');

        $question_option = $this->create(QuestionOption::class);
        $this->put(route('qa_app.question_option.update', $question_option->id), $attributes)
            ->assertSessionHasErrors('name')
            ->assertSessionHasErrors('value')
            ->assertSessionHasErrors('question_type_id');
    }

    /** @test */
    public function it_validates_fields_must_be_unique_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $question_option = $this->create(QuestionOption::class);
        $second_question_option = $this->create(QuestionOption::class);
        // $attributes = $this->create(QuestionOption::class, ['name' => 'Repeated']);

        $this->post(route('qa_app.question_option.store'), ['name' => $question_option->name])
            ->assertSessionHasErrors('name');

        $this->put(route('qa_app.question_option.update', $question_option->id), ['name' => $second_question_option->name])
            ->assertSessionHasErrors('name');

        // Except when updating itself
        $this->put(route('qa_app.question_option.update', $question_option->id), ['name' => $question_option->name])
            ->assertSessionDoesntHaveErrors('name');
    }

    /** @test */
    public function it_validates_fields_exists_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(QuestionOption::class, ['question_type_id' => 444]);

        $this->post(route('qa_app.question_option.store'), $attributes)
            ->assertSessionHasErrors('question_type_id');

        $question_option = $this->create(QuestionOption::class);
        $this->put(route('qa_app.question_option.update', $question_option->id), $attributes)
            ->assertSessionHasErrors('question_type_id');
    }

    /** @test */
    public function it_validates_numeric_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(QuestionOption::class, ['value' => 'Not Numeric']);

        $this->post(route('qa_app.question_option.store'), $attributes)
            ->assertSessionHasErrors('value');

        $question_option = $this->create(QuestionOption::class);
        $this->put(route('qa_app.question_option.update', $question_option->id), $attributes)
            ->assertSessionHasErrors('value');
    }

    /** @test */
    public function it_validates_min_number_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(QuestionOption::class, ['value' => -0.1]);

        $this->post(route('qa_app.question_option.store'), $attributes)
            ->assertSessionHasErrors('value');

        $question_option = $this->create(QuestionOption::class);
        $this->put(route('qa_app.question_option.update', $question_option->id), $attributes)
            ->assertSessionHasErrors('value');
    }

    /** @test */
    public function it_validates_max_number_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(QuestionOption::class, ['value' => 1.1]);

        $this->post(route('qa_app.question_option.store'), $attributes)
            ->assertSessionHasErrors('value');

        $question_option = $this->create(QuestionOption::class);
        $this->put(route('qa_app.question_option.update', $question_option->id), $attributes)
            ->assertSessionHasErrors('value');
    }

    /** @test */
    public function unauthorized_users_cant_view_index_question_option()
    {
        $this->actingAs($this->user());

        $response = $this->get(route('qa_app.question_option.index'));

        $response->assertForbidden();
    }

    /** @test */
    public function unauthorized_users_cant_view_single_question_option()
    {
        $this->actingAs($this->user());
        $question_option = factory(QuestionOption::class)->create();

        $this->get(route('qa_app.question_option.show', $question_option->id))
            ->assertForbidden();
    }

    /** @test */
    public function auauthorized_users_cant_store_question_option()
    {
        $this->actingAs($this->user());
        $attributes = $this->make(QuestionOption::class);

        $this->post(route('qa_app.question_option.store'), $attributes)
            ->assertForbidden();
    }

    /** @test */
    public function auntuahorized_users_cant_edit_a_question_option()
    {
        $this->actingAs($this->user());
        $question_option = $this->create(QuestionOption::class);

        $this->get(route('qa_app.question_option.edit', $question_option->id))
            ->assertForbidden();
    }

    /** @test */
    public function unauntuahorized_users_cant_update_a_question_option()
    {
        $this->actingAs($this->user());

        $question_option = $this->create(QuestionOption::class);
        $attributes = $this->make(QuestionOption::class);

        $this->put(route('qa_app.question_option.update', $question_option->id), $attributes)
            ->assertForbidden();
    }

    /** @test */
    public function it_shows_a_list_of_question_options()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $this->create(QuestionOption::class, [], 2);

        $question_options = QuestionOptionRepository::all();

        $this->get(route('qa_app.question_option.index'))
            ->assertViewIs('qa_app::question_options.index')
            ->assertViewHas('question_options', $question_options)
            ->assertViewHas('questionTypesList', (new QuestionOption())->questionTypesList);
    }

    /** @test */
    public function it_shows_a_single_question_option()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $question_option = factory(QuestionOption::class)->create();

        $this->get(route('qa_app.question_option.show', $question_option->id))
            ->assertViewIs('qa_app::question_options.show')
            ->assertViewHas('question_option', $question_option);
    }

    /** @test */
    public function it_stores_a_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(QuestionOption::class);

        $this->post(route('qa_app.question_option.store'), $attributes)
            ->assertRedirect(route('qa_app.question_option.index'));

        $this->assertDatabaseHas((new QuestionOption)->getTable(), $attributes);
    }

    /** @test */
    public function it_edits_a_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $question_option = $this->create(QuestionOption::class);

        $this->get(route('qa_app.question_option.edit', $question_option))
            ->assertViewIs('qa_app::question_options.edit')
            ->assertViewHas('question_option', $question_option)
            ->assertViewHas('questionTypesList', $question_option->questionTypesList);
    }

    /** @test */
    public function it_updates_a_question_option()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));

        $question_option = $this->create(QuestionOption::class);
        $attributes = $this->make(QuestionOption::class, ['name' => 'Update Name']);

        $this->put(route('qa_app.question_option.update', $question_option->id), $attributes)
            ->assertRedirect(route('qa_app.question_option.index'));

        $this->assertDatabaseHas((new QuestionOption)->getTable(), $attributes);
    }
}

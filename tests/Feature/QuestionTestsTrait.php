<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\QAApp\Models\Question;
use Dainsys\QAApp\Repositories\QuestionRepository;

trait QuestionTestsTrait
{
    /** @test */
    public function guest_are_not_allowed_to_index_question()
    {
        $this->get(route('qa_app.question.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_show_question()
    {
        $this->get(route('qa_app.question.show', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_edit_question()
    {
        $this->get(route('qa_app.question.edit', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_update_question()
    {
        $this->put(route('qa_app.question.update', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_store_question()
    {
        $this->post(route('qa_app.question.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function it_validates_fields_are_required_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Question::class, ['text' => '', 'points' => '', 'form_id' => '', 'question_type_id' => '']);

        $this->post(route('qa_app.question.store'), $attributes)
            ->assertSessionHasErrors('text')
            ->assertSessionHasErrors('points')
            ->assertSessionHasErrors('form_id')
            ->assertSessionHasErrors('question_type_id');

        $question = $this->create(Question::class);
        $this->put(route('qa_app.question.update', $question->id), $attributes)
            ->assertSessionHasErrors('text')
            ->assertSessionHasErrors('points')
            ->assertSessionHasErrors('form_id')
            ->assertSessionHasErrors('question_type_id');
    }

    /** @test */
    public function it_validates_fields_must_be_unique_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $question = $this->create(Question::class);
        $second_question = $this->create(Question::class);
        // $attributes = $this->create(Question::class, ['text' => 'Repeated']);

        $this->post(route('qa_app.question.store'), ['text' => $question->text])
            ->assertSessionHasErrors('text');

        $this->put(route('qa_app.question.update', $question->id), ['text' => $second_question->text])
            ->assertSessionHasErrors('text');

        // Except when updating itself
        $this->put(route('qa_app.question.update', $question->id), ['text' => $question->text])
            ->assertSessionDoesntHaveErrors('text');
    }

    /** @test */
    public function it_validates_fields_exists_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Question::class, ['form_id' => 444, 'question_type_id' => 444]);

        $this->post(route('qa_app.question.store'), $attributes)
            ->assertSessionHasErrors('form_id')
            ->assertSessionHasErrors('question_type_id');

        $question = $this->create(Question::class);
        $this->put(route('qa_app.question.update', $question->id), $attributes)
            ->assertSessionHasErrors('form_id')
            ->assertSessionHasErrors('question_type_id');
    }

    /** @test */
    public function it_validates_numeric_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Question::class, ['points' => 'Not Numeric']);

        $this->post(route('qa_app.question.store'), $attributes)
            ->assertSessionHasErrors('points');

        $question = $this->create(Question::class);
        $this->put(route('qa_app.question.update', $question->id), $attributes)
            ->assertSessionHasErrors('points');
    }

    /** @test */
    public function it_validates_min_number_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Question::class, ['points' => -0.1]);

        $this->post(route('qa_app.question.store'), $attributes)
            ->assertSessionHasErrors('points');

        $question = $this->create(Question::class);
        $this->put(route('qa_app.question.update', $question->id), $attributes)
            ->assertSessionHasErrors('points');
    }

    /** @test */
    public function it_validates_max_number_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Question::class, ['points' => 100.1]);

        $this->post(route('qa_app.question.store'), $attributes)
            ->assertSessionHasErrors('points');

        $question = $this->create(Question::class);
        $this->put(route('qa_app.question.update', $question->id), $attributes)
            ->assertSessionHasErrors('points');
    }

    /** @test */
    public function unauthorized_users_cant_view_index_question()
    {
        $this->actingAs($this->user());

        $response = $this->get(route('qa_app.question.index'));

        $response->assertForbidden();
    }

    /** @test */
    public function unauthorized_users_cant_view_single_question()
    {
        $this->actingAs($this->user());
        $question = factory(Question::class)->create();

        $this->get(route('qa_app.question.show', $question->id))
            ->assertForbidden();
    }

    /** @test */
    public function auauthorized_users_cant_store_question()
    {
        $this->actingAs($this->user());
        $attributes = $this->make(Question::class);

        $this->post(route('qa_app.question.store'), $attributes)
            ->assertForbidden();
    }

    /** @test */
    public function auntuahorized_users_cant_edit_a_question()
    {
        $this->actingAs($this->user());
        $question = $this->create(Question::class);

        $this->get(route('qa_app.question.edit', $question->id))
            ->assertForbidden();
    }

    /** @test */
    public function unauntuahorized_users_cant_update_a_question()
    {
        $this->actingAs($this->user());

        $question = $this->create(Question::class);
        $attributes = $this->make(Question::class);

        $this->put(route('qa_app.question.update', $question->id), $attributes)
            ->assertForbidden();
    }

    /** @test */
    public function it_shows_a_list_of_questions()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $this->create(Question::class, [], 2);

        $questions = QuestionRepository::all();

        $this->get(route('qa_app.question.index'))
            ->assertViewIs('qa_app::questions.index')
            ->assertViewHas('questions', $questions)
            ->assertViewHas('formsList', (new Question())->formsList)
            ->assertViewHas('questionTypesList', (new Question())->questionTypesList);
    }

    /** @test */
    public function it_shows_a_single_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $question = factory(Question::class)->create();

        $this->get(route('qa_app.question.show', $question->id))
            ->assertViewIs('qa_app::questions.show')
            ->assertViewHas('question', $question);
    }

    /** @test */
    public function it_stores_a_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $attributes = $this->make(Question::class);

        $this->post(route('qa_app.question.store'), $attributes)
            ->assertRedirect(route('qa_app.question.index'));

        $this->assertDatabaseHas((new Question)->getTable(), $attributes);
    }

    /** @test */
    public function it_edits_a_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));
        $question = $this->create(Question::class);

        $this->get(route('qa_app.question.edit', $question))
            ->assertViewIs('qa_app::questions.edit')
            ->assertViewHas('question', $question)
            ->assertViewHas('formsList', $question->formsList)
            ->assertViewHas('questionTypesList', $question->questionTypesList);
    }

    /** @test */
    public function it_updates_a_question()
    {
        $this->actingAs($this->authorizedUser(config('qa_app.roles.admin')));

        $question = $this->create(Question::class);
        $attributes = $this->make(Question::class, ['text' => 'Update Name']);

        $this->put(route('qa_app.question.update', $question->id), $attributes)
            ->assertRedirect(route('qa_app.question.index'));

        $this->assertDatabaseHas((new Question)->getTable(), $attributes);
    }
}

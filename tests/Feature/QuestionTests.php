<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\QAApp\Models\Question;
use Dainsys\QAApp\Tests\AppTestCase;

class QuestionTests extends AppTestCase
{
    /** @test */
    public function guest_are_not_allowed_to_index()
    {
        $this->get(route('qa_app.question.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_show()
    {
        $this->get(route('qa_app.question.show', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_edit()
    {
        $this->get(route('qa_app.question.edit', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_update()
    {
        $this->put(route('qa_app.question.update', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_create()
    {
        $this->get(route('qa_app.question.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_store()
    {
        $this->post(route('qa_app.question.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function it_shows_a_list_of_questions()
    {
        $this->actingAs($this->user());
        $this->create(Question::class);

        $questions = Question::all();

        $this->get(route('qa_app.question.index'))
            ->assertViewIs('qa_app::questions.index')
            ->assertViewHas('questions', $questions);
    }

    /** @test */
    public function it_shows_a_single_question()
    {
        $this->actingAs($this->user());
        $question = factory(Question::class)->create();

        $this->get(route('qa_app.question.show', $question->id))
            ->assertViewIs('qa_app::questions.show')
            ->assertViewHas('question', $question);
    }

    /** @test */
    public function it_creates_a_question()
    {
        $this->actingAs($this->user());

        $this->get(route('qa_app.question.create'))
            ->assertViewIs('qa_app::questions.create');
    }

    /** @test */
    public function it_stores_a_question()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user());
        $attributes = $this->make(Question::class);

        $this->post(route('qa_app.question.store', $attributes))
            ->assertRedirect(route('qa_app.question.index'));

        $this->assertDatabaseHas((new Question())->getTable(), $attributes);
    }

    /** @test */
    public function it_edits_a_question()
    {
        $this->actingAs($this->user());
        $question = $this->create(Question::class);

        $this->get(route('qa_app.question.edit', $question))
            ->assertViewIs('qa_app::questions.edit')
            ->assertViewHas('question', $question);
    }

    /** @test */
    public function it_updates_a_question()
    {
        $this->actingAs($this->user());

        $question = $this->create(Question::class);
        $attributes = ['text' => 'Updated Text'];

        $this->put(route('qa_app.question.update', $question->id), $attributes)
            ->assertRedirect(route('qa_app.question.index'));

        $this->assertDatabaseHas((new Question())->getTable(), $attributes);
    }
}

<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\QAApp\Models\QuestionOption;
use Dainsys\QAApp\Tests\AppTestCase;

class QuestionOptionTests extends AppTestCase
{
    /** @test */
    public function guest_are_not_allowed_to_index()
    {
        $this->get(route('qa_app.question_option.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_show()
    {
        $this->get(route('qa_app.question_option.show', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_edit()
    {
        $this->get(route('qa_app.question_option.edit', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_update()
    {
        $this->put(route('qa_app.question_option.update', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_create()
    {
        $this->get(route('qa_app.question_option.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_store()
    {
        $this->post(route('qa_app.question_option.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function it_shows_a_list_of_question_options()
    {
        $this->actingAs($this->user());
        $this->create(QuestionOption::class);

        $question_options = QuestionOption::all();

        $this->get(route('qa_app.question_option.index'))
            ->assertViewIs('qa_app::question_options.index')
            ->assertViewHas('question_options', $question_options);
    }

    /** @test */
    public function it_shows_a_single_question_option()
    {
        $this->actingAs($this->user());
        $question_option = factory(QuestionOption::class)->create();

        $this->get(route('qa_app.question_option.show', $question_option->id))
            ->assertViewIs('qa_app::question_options.show')
            ->assertViewHas('question_option', $question_option);
    }

    /** @test */
    public function it_creates_a_question_option()
    {
        $this->actingAs($this->user());

        $this->get(route('qa_app.question_option.create'))
            ->assertViewIs('qa_app::question_options.create');
    }

    /** @test */
    public function it_stores_a_question_option()
    {
        $this->actingAs($this->user());
        $attributes = $this->make(QuestionOption::class);

        $this->post(route('qa_app.question_option.store', $attributes))
            ->assertRedirect(route('qa_app.question_option.index'));

        $this->assertDatabaseHas((new QuestionOption())->getTable(), $attributes);
    }

    /** @test */
    public function it_edits_a_question_option()
    {
        $this->actingAs($this->user());
        $question_option = $this->create(QuestionOption::class);

        $this->get(route('qa_app.question_option.edit', $question_option))
            ->assertViewIs('qa_app::question_options.edit')
            ->assertViewHas('question_option', $question_option);
    }

    /** @test */
    public function it_updates_a_question_option()
    {
        $this->actingAs($this->user());

        $question_option = $this->create(QuestionOption::class);
        $attributes = ['name' => 'Update Name'];

        $this->put(route('qa_app.question_option.update', $question_option->id), $attributes)
            ->assertRedirect(route('qa_app.question_option.index'));

        $this->assertDatabaseHas((new QuestionOption())->getTable(), $attributes);
    }
}

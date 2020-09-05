<?php

namespace Dainsys\QAApp\Tests\Feature;

use Dainsys\QAApp\Models\QuestionType;
use Dainsys\QAApp\Repositories\QuestionTypeRepository;
use Dainsys\QAApp\Tests\AppTestCase;

class QuestionTypeTests extends AppTestCase
{
    /** @test */
    public function guest_are_not_allowed_to_index()
    {
        $this->get(route('qa_app.question_type.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_show()
    {
        $this->get(route('qa_app.question_type.show', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_edit()
    {
        $this->get(route('qa_app.question_type.edit', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_update()
    {
        $this->put(route('qa_app.question_type.update', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_are_not_allowed_to_store()
    {
        $this->post(route('qa_app.question_type.store'))
            ->assertRedirect(route('login'));
    }
    /** @test */
    public function it_shows_a_list_of_question_types()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user());
        $this->create(QuestionType::class, [], 2);

        $question_types = QuestionTypeRepository::all();

        $this->get(route('qa_app.question_type.index'))
            ->assertViewIs('qa_app::question_types.index')
            ->assertViewHas('question_types', $question_types);
    }

    /** @test */
    public function it_shows_a_single_question_type()
    {
        $this->actingAs($this->user());
        $question_type = factory(QuestionType::class)->create();

        $this->get(route('qa_app.question_type.show', $question_type->id))
            ->assertViewIs('qa_app::question_types.show')
            ->assertViewHas('question_type', $question_type);
    }

    /** @test */
    public function it_stores_a_question_type()
    {
        $this->actingAs($this->user());
        $attributes = $this->make(QuestionType::class);

        $this->post(route('qa_app.question_type.store', $attributes))
            ->assertRedirect(route('qa_app.question_type.index'));

        $this->assertDatabaseHas((new QuestionType)->getTable(), $attributes);
    }

    /** @test */
    public function it_edits_a_question_type()
    {
        $this->actingAs($this->user());
        $question_type = $this->create(QuestionType::class);

        $this->get(route('qa_app.question_type.edit', $question_type))
            ->assertViewIs('qa_app::question_types.edit')
            ->assertViewHas('question_type', $question_type);
    }

    /** @test */
    public function it_updates_a_question_type()
    {
        $this->actingAs($this->user());

        $question_type = $this->create(QuestionType::class);
        $attributes = ['name' => 'Update Name'];

        $this->put(route('qa_app.question_type.update', $question_type->id), $attributes)
            ->assertRedirect(route('qa_app.question_type.index'));

        $this->assertDatabaseHas((new QuestionType)->getTable(), $attributes);
    }
}

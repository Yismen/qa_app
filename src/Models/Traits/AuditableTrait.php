<?php

namespace Dainsys\QAApp\Models\Traits;

use Dainsys\QAApp\Models\Form;
use Dainsys\QAApp\Models\Question;
use Dainsys\QAApp\Models\QuestionOption;
use Dainsys\QAApp\Repositories\FormRepository;
use Dainsys\QAApp\Repositories\UserRepository;
use Illuminate\Http\Request;

trait AuditableTrait
{

    public function getFormsListAttribute()
    {
        return Form::orderBy('name')
            ->whereHas('questions')
            ->with('questions')
            ->pluck('name', 'id');
    }

    public function getUsersListAttribute()
    {
        return UserRepository::list();
    }

    public function getPointsGoalAttribute()
    {
        return  $this->max_points * optional($this->form)->goal_percentage;
    }

    public static function getAdditionalFields(Request $request): array
    {
        $questions = Question::whereIn('id', array_keys((array) $request->answers))->with('questionType')->get();
        $form = Form::findOrFail($request->form_id);
        $points = self::getTotalPoints($request, $questions);
        $max_points = $questions->sum('points');
        $points_goal = $max_points * $form->goal_percentage;

        return [
            'max_points' => $max_points,
            'points' => $points,
            'points_goal' => $points_goal,
            'passes' => $points >=  $points_goal,
            'data' => self::getAnswersData((array)$request->answers),
        ];
    }

    private static function getAnswersData(array $answers)
    {
        $response = [];
        $i = 0;
        // question id => question.id, answer => questionOption.id, question value => question.points, points => questionOption.value * question.points
        foreach ($answers as $question_id => $answer_id) {
            $question = Question::findOrFail($question_id);
            $answer = QuestionOption::findOrFail($answer_id);

            $response[$i]['question'] = $question->append('questionOptionsList');
            $response[$i]['answer'] = $answer;
            $response[$i]['question_value'] = $question->points;
            $response[$i]['answer_value'] = $answer->value;
            $response[$i]['result'] = $question->points * $answer->value;

            $i++;
        }

        return json_encode($response);
    }

    protected static function getTotalPoints(Request $request, $questions)
    {
        return $questions->sum(function ($question) use ($request) {
            $answer =  QuestionOption::findOrFail($request->answers[$question->id]);
            return $question->points * $answer->value;
        });
    }
}

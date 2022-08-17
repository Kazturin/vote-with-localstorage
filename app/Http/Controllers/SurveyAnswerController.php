<?php


namespace App\Http\Controllers;


use App\Http\Resources\SurveyAnswerResource;
use Illuminate\Http\Request;
use App\Models\SurveyAnswer;


class SurveyAnswerController extends Controller
{
    public function update(Request $request, SurveyAnswer $surveyAnswer){

//        $data = $request->validate([
//            'survey_id' => 'required',
//            'count' => 'required | numeric',
//        ]);

        $surveyAnswer->count++;
        $surveyAnswer->save();

        return new SurveyAnswerResource($surveyAnswer);
    }
}

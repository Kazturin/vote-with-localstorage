<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveyAnswerRequest;
use App\Http\Resources\SurveyResource;
use App\Models\Survey;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Models\SurveyAnswer;
use App\Models\Participant;
use App\Models\SurveyQuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return SurveyResource::collection(Survey::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(6));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSurveyRequest $request
     * @return SurveyResource
     */
    public function store(StoreSurveyRequest $request)
    {
        $data = $request->validated();

        // Check if image was given and save on local file system
        if (isset($data['image'])) {
            $relativePath  = $this->saveImage($data['image']);
            $data['image'] = $relativePath;
        }

        $survey = Survey::create($data);

        // Create new questions
        foreach ($data['answers'] as $answer) {
            $answer['survey_id'] = $survey->id;
            $this->addAnswer($answer);
        }

        return new SurveyResource($survey);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Survey $survey
     * @return SurveyResource
     */
    public function show(Request $request)
    {
//        $user = $request->user();
//        if ($user->id !== $survey->user_id) {
//            return abort(403, 'Unauthorized action.');
//        }

        return new SurveyResource(Survey::find($request->id));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Survey $survey
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function showForGuest(Request $request)
    {
        if ($request->category_id){
            return SurveyResource::collection(
                Survey::where('category_id',$request->category_id)->where(function($query) {
                     $query->whereDate('expire_date','>=',date('Ymd'))
                           ->orWhere('status', 1);
                         })->orderBy('created_at', 'DESC')->paginate(6));
        }
        return SurveyResource::collection(Survey::whereDate('expire_date','>=',date('Ymd'))
            ->orWhere('status', 1)->orderBy('created_at', 'DESC')->paginate(6));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSurveyRequest $request
     * @param \App\Models\Survey                     $survey
     * @return SurveyResource
     */
    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $data = $request->validated();

        // Check if image was given and save on local file system
        if (isset($data['image'])) {
            $relativePath = $this->saveImage($data['image']);
            $data['image'] = $relativePath;

            // If there is an old image, delete it
            if ($survey->image) {
                $absolutePath = public_path($survey->image);
                File::delete($absolutePath);
            }
        }

        // Update survey in the database
        $survey->update($data);

        return new SurveyResource($survey);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $survey->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        $survey->delete();

        // If there is an old image, delete it
        if ($survey->image) {
            $absolutePath = public_path($survey->image);
            File::delete($absolutePath);
        }

        return response('', 204);
    }

    /**
     * Create a question and return
     *
     * @param $data
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     */
    private function addAnswer($data)
    {
        $validator = Validator::make($data, [
            'answer' => 'required|string',
            'survey_id' => 'exists:App\Models\Survey,id',
            'count' => 'nullable|integer',
        ]);

        return SurveyAnswer::create($validator->validated());
    }

    /**
     * Save image in local file system and return saved image path
     *
     * @param $image
     * @throws \Exception
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     */
    private function saveImage($image)
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}

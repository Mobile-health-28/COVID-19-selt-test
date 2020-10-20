<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\ChoiceRequest;
use App\Models\Question;
use App\Models\Choice;

class CovidTestQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  /**
 * @OA\Get(
 * path="/api/question",
 * summary="Get questions",
 * description="Get questions",
 * operationId="questions",
 * tags={"Questions"},
 * security={ {"bearer": {} }},
 * * @OA\Response(
 *    response=422,
 *    description="No User founded",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Not founded")
 *        )
 *     )
 * )
 */
    public function index(Request $request)
    {
        return Question::with("choices")->get();
    }
      /**
 * @OA\Get(
 * path="/api/questions/{id}",
 * summary="Get question by id",
 * description="Get question by id ",
 * operationId="questionGetById",
 * tags={"Questions"},
 *  @OA\Parameter(
 *    required=true,
 *    name="id",
 *    in="path",
 *    description="Question id",
 * ),
 * security={ {"bearer": {} }},
 * * @OA\Response(
 *    response=422,
 *    description="No User founded",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Not founded")
 *        )
 *     )
 * )
 */
public function getByQuestionId(Request $request,$id)
{
    return Question::with("choices")->find($id);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

 /**
 * @OA\Post(
 * path="/api/question",
 * summary="create a question",
 * description="create a question",
 * operationId="question",
 * tags={"Questions"},
 * @OA\RequestBody(
 *    required=true,
 *    description="create a question",
 *    @OA\JsonContent(
 *       required={"short_description","long_description"},
 *       @OA\Property(property="short_description", type="string"),
 *       @OA\Property(property="long_description", type="string"),
 *
 *    ),
 * ),
 * 
 * @OA\Response(
 *    response=422,
 *    description="Bad request",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Bad request")
 *        )
 *     )
 * )
 */
    public function store(QuestionRequest $request)
    {
      // return $request->all();
        if($request->validated())
        $data=["short_description"=>$request->short_description,
        "long_description"=>$request->short_description,
        "type"=>1
    ];
       return Question::create($data);

    }

    /**
 * @OA\Post(
 * path="/api/questions/{id}/choices",
 * summary="Add choices to a question",
 * description="Add choices to a question",
 * operationId="Questions",
 * tags={"Questions"},
 *  @OA\Parameter(
 *    required=true,
 *    name="id",
 *    in="path",
 *    description="Question id",
 * ),
 * @OA\RequestBody(
 *    required=true,
 *    description="Add choices to a question",
 *    @OA\JsonContent(
 *       required={"label"},
 *       @OA\Property(property="label", type="string"),
 *       @OA\Property(property="is_correct", type="integer"),
 *       @OA\Property(property="comment", type="string"),
 *
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Bad request",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Bad request")
 *        )
 *     )
 * )
 */
public function addChoices(ChoiceRequest $request, $id)
{
    $question=Question::find($id);
 
    if(!$question)
    return response()->json(["message"=>"No Question founded with such id"],404);
    if(count($question->choices)>=5)
    return response()->json(["message"=>"Enought choice for this question", "question"=>Question::with("choices")->find($id)],200);
    $request["question_id"]=$id;
    if($request->validated())
    $data=["label"=>$request->label,
    "question_id"=>$request->question_id,
    "weght"=>isset($request->weight)?$request->weight:0,
    "comment"=>isset($request->comment)?$request->comment:'',

];
Choice::create($data);
   return Question::with("choices")->find($id);

}
    /**
 * @OA\Post(
 * path="/api/questions/create",
 * summary="Create questions and choices",
 * description="Create questions and choices ",
 * operationId="question",
 * tags={"Questions"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Create questions with choices",
 *    @OA\JsonContent(
 *       required={"data"},
 *       @OA\Property(property="data", type="json", example="REPLACE BY a valide json array of QUESTION(short_description, long_description,typ). EACH QUESTION Contains array of CHOICES(label,weignt,comment)")
 *
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Bad request",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Bad request")
 *        )
 *     )
 * )
 */
public function loaFromJson(Request $request)
{

    return $request->data;
    foreach($request->data as $question)
    {
        $question_data=[
            "short_description"=>$question["short_description"],
            "long_description"=>$question["long_description"],
            "type"=>$question["type"],
        ];
        $question=Question::create($question_data);
        foreach($question["choices"] as $choice){
            $choice_data=[
            "label"=>$choice["label"],
            "weight"=>$choice["weight"],
            "question_id"=>$question->id,
            "comment"=>$choice["comment"],
        
        ];
        Choice::create($choice_data);
        }
    }

   return Question::with("choices")->get();


}

    /**
     * Start a new self test session
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

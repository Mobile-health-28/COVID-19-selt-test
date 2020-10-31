<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSession;
use App\Models\Question;
use App\Models\UserChoice;
use Carbon\Carbon;
class CovidTestController extends Controller
{
    /**
     *Start new self test session
     *
     * @return \Illuminate\Http\Response
     */
  /**
 * @OA\Get(
 * path="/api/selftest",
 * summary="Start new self test session",
 * description="Start new self test session",
 * operationId="selftestSession",
 * tags={"Self-Test Session"},
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
        
        
        $session_data=["user_id"=>auth('api')->user()->id,
        "started_at"=>Carbon::now()];
        $test=TestSession::create($session_data);
        return response()->json(["session"=>$test,"questions"=>Question::with("choices")->get() ],200);
    }

    /**
     * Init and start new session test.
     * @arg 
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
    }
 /**
 * @OA\Post(
 * path="/api/questions/endtest/{id}",
 * summary="Create questions and choices",
 * description="Create questions and choices ",
 * operationId="question",
 * tags={"Self-Test Session"},
 * @OA\RequestBody(
 *    description="End session and get results",
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
    public function endSession(Request $request,$id){
       
        $session=TestSession::find($id);
        if(!$session)
        return response()->json(["message"=>"No Test session founded with such id"],404);
    
        return response()->json(["message"=>$session->getAdvices()],200);
    }
    /**
 * @OA\Post(
 * path="/api/questions/answers",
 * summary="Send answers of multiple questions",
 * description="Send answers of multiple questions ",
 * operationId="ansewrId",
 * tags={"Self-Test Session"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Send answers of all questions",
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
public function sendAnswers(Request $request){
    //return $request->data;
        
    $session_id=$request->test_session_id;
    $test_session=TestSession::find($session_id);
    if(!$test_session)
    return response()->json(["message"=>"No Test session founded with such id"],404);
    foreach($request->data as $answers)
    {
        $data=[
            "test_session_id"=>$session_id,
            "user_id"=>Auth::user()->id,
            "question_id"=>$answers["question_id"],
            "choice_id"=>$answers["choice_id"],
        ];
        UserChoice::create($data);
    }
    return response()->json($test_session->getAdvices(),200);
}
  /**
 * @OA\Post(
 * path="/api/questions/{id}/answer",
 * summary="Send answers of a specific question",
 * description="Send answers of a specific question ",
 * operationId="ansewrId",
 * tags={"Self-Test Session"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Send answers of all questions",
 *    @OA\JsonContent(
 *      required={"question_id","choice_id","test_session_id"},
 *      @OA\Property(property="question_id", type="string"),
 *      @OA\Property(property="choice_id", type="string"),
 *      @OA\Property(property="test_session_id", type="string")
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
public function sendAnswer(Request $request){
    $session_id=$request->test_session_id;
    if(!TestSession::find($session_id))
    return response()->json(["message"=>"No Test session founded with such id"],404);
   
        $data=[
            "test_session_id"=>$session_id,
            "user_id"=>$request->user()->id,
            "question_id"=>$request->question_id,
            "choice_id"=>$request->choice_id,

        ];
        UserChoice::create($data);
    return response()->json(["message"=>"Success"],200);
        
   
}
    /**
     * Display the specified resource.
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

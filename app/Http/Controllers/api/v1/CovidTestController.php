<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
 * tags={"Selftest"},
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

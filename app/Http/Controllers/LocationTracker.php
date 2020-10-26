<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class LocationTracker extends Controller
{
    /**
     * @OA\Get(
     * path="/api/location",
     * summary="Returns all previous locations visited",
     * description="Endpoint used to get all visited locations",
     * operationId="authLocationGet",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=false,
     *    description="Will return objects containing the location details",
     * ),
     * @OA\Response(
     *    response=403,
     *    description="Not Authorized",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Permission Denied")
     *        )
     *     )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *        @OA\Property(property="message", type="json",example="[]")
     *     )
     * )
     * Display a listing of the resource.
     *
     * @return Application|ResponseFactory|Response|void
     */
    public function index()
    {
        $location = Location::query()->where(['user_id' => Auth::user()->id])->orderBy('created_at', 'desc')->get(['location_name', 'created_at', 'updated_at']);
        $response = ['locations' => $location];
        return response($response, 200);
    }

    /**
     * @OA\Post(
     * path="/api/location",
     * summary="Add a new location visited",
     * description="Endpoint used to add new visited location after spending at-least an hour in the vicinity",
     * operationId="authLocationPost",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Location data payload",
     *    @OA\JsonContent(
     *       required={"longitude","latitude"},
     *       @OA\Property(property="longitude", type="number", format="float", example="32.01547"),
     *       @OA\Property(property="latitude", type="number", format="float", example="-2.01547"),
     *    ),
     * ),
     * @OA\Response(
     *    response=403,
     *    description="Not Authorized",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Permission Denied")
     *        )
     *     )
     * ),
     * @OA\Response(
     *    response=204,
     *    description="Location Added",
     *    @OA\JsonContent(
     *     )
     * )
     * Store a newly created resource in storage.
     *
     * @param LocationRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function store(LocationRequest $request)
    {
        $user_id = Auth::user()->id;
        $up = [];
        $up['latitude'] = $request->latitude;
        $up['longitude'] = $request->longitude;
        $locationName = $this->getDetails($up['latitude'], $up['longitude']);
        $up['user_id'] = $user_id;
        $up['location_name'] = $locationName;
        $data = Location::updateOrCreate(['user_id' => $user_id, 'location_name' => $locationName], $up);
        return response($data, 204);
    }

    private function getDetails($lat, $long)
    {
        $url = env('LOCATION_IQ_REV', "https://us1.locationiq.com/v1/reverse.php");
        $api = env('LOCATION_IQ_API', "pk.29d2a47cd8841917da1e1c047156d34a");
        $completeUrl = $url . '?key=' . $api . '&lat=' . $lat . '&lon=' . $long . '&format=json';
        try {
            $response = Http::get($completeUrl);
            $data = $response->json();
            $name = explode(',', $data['display_name']);
            return $name[0] . ',' . $name[1] . ',' . $name[2] . ',' . $name[3] . ',' . $name[4] . ',' . $name[6];
        } catch (\Throwable $exc) {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param Location $location
     * @return void
     */
    public function show(Location $location)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Location $location
     * @return void
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Location $location
     * @return void
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Location $location
     * @return void
     */
    public function destroy(Location $location)
    {
        //
    }
}

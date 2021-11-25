<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Calendar\Store;
use App\Lib\ApiWrapper;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Store $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->id();
        $calendar = CalendarEvent::create($input);
        if ($request->has('image')){
            $image = CalendarEvent::storeImage($request, $calendar->id);
        }else{
            $image = null;
        }
        return ApiWrapper::sendResponse(["calendar" => $calendar,'image' => $image],"SUCCESS");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $calendar = CalendarEvent::find($id);
        return ApiWrapper::sendResponse(["calendar" => $calendar],"SUCCESS");
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
        $calendar = CalendarEvent::find($id);
        $calendar->delete();
        return ApiWrapper::sendResponse(["calendar" => $calendar],"SUCCESS");
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Category::paginate(request()->all());
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Category();
        Category::created($re);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Category\StoreRequest  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $model = new Category();
        $model->title = $request->input('title');
        $model->parent_id = $request->has('parent_id') ? $request->input('parent_id') : 0;
        $model->state = $request->has('state') ? $request->input('state') : null;
        $model->save();

        return response()->json([
            "message" => "category created",
            "model" => $model,
        ],201);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (empty($category))
            return response()->json([
                "message" => "not found category",
            ],404);
        $category->delete();
        return response()->json([
            "message" => "Deleted succesfully"
        ],201);
    }
}

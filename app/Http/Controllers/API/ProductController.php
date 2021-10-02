<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\Log;
use App\Models\Products;
use Illuminate\Http\Request;
use Mockery\Exception;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $res = Products::paginate(15);

        return $this->sendResponse($res, 'category pagination');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $product = new Products();
            $product->title = $request->input('title');

            $resp_data = [
                "message" => "succesfully created !",
                "product" => $product
            ];
            $code = 201;
        }catch (\Exception $e){
            Log::writeError("error_product_store", $e);
            $resp_data = [
                "message"=> "error in creating",
                "code" => $e->getCode()
            ];
            $code = 500;
        }
        return response()->json($resp_data,$code);
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

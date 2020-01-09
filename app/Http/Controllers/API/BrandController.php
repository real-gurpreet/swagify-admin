<?php

namespace App\Http\Controllers\API;

use App\Brand;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use JWTAuth;
use Validator;

class BrandController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(Route $route , Request $request)
    {

        $user = JWTAuth::parseToken()->authenticate();
        // $controllerAction = class_basename($route->getActionName());
        // list($controller, $action) = explode('@', $controllerAction);
        // echo $controller ,",", $action;



        // if(!$this->role =  $user->hasRole('Su')){
        //       abort(403, "only admin allow");
        //     }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return response()->json([
            'brands' => $brands,
            'response' => 'success',

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {


        return $this->sendResponse( 'Successfully Created Brand !!', $code = 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $userId)
    {
        $brand = Brand::find($userId) ?? "no brand found";
        return response()->json([
            'brand' => $brand,
            'response' => 'success',

        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'id' => 'bail|required|exists:brands',
            'name' => 'bail|string|max:50',
            'slug' => 'bail|string|max:50',
            'description' => 'bail|string|max:255',
        ]);
        $brand = Brand::find($request->id);
        $brand->name = $request->name ?? $brand->name;
        $brand->slug = $request->slug ?? $brand->slug;
        $brand->description = $request->description ?? $brand->description;
        $brand->save();
        return response()->json([
            'brand' => $brand,
            'response' => 'Successfully brand updated !!',

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'bail|required|exists:brands',
        ]);
        $brand = Brand::find($request->id);
        $brand->delete();
        return response()->json([
            'brand' => $brand,
            'response' => 'Successfully brand is deleted',

        ], 200);
    }
}

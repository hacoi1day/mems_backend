<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class CategoryResourceController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @param CategoryRequest $request
     * @return Response
     */
    public function index(CategoryRequest $request)
    {
        try {
            $page = $request->has('page') ? $request->input('page') : 1;
            $pageLimit = $request->has('pageLimit') ? $request->input('pageLimit') : 10;
            $items = $this->category->offset($page-1)->limit($pageLimit)->get();
            return response()->json(responseList($items), 200);
        } catch (Exception $e) {
            return response()->json(responseError($e), 500);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        try {
            $attr = $request->all();
            $item = $this->category->create($attr);
            return response()->json(responseSuccess($item), 201);
        } catch (Exception $e) {
            return response()->json(responseError($e), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $item = $this->category->find($id);
            if (!$item) {
                return response()->json(responseNotFound(), 404);
            }
            return response()->json(responseSuccess($item), 200);
        } catch (Exception $e) {
            return response()->json(responseError($e), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $item = $this->category->find($id);
            if (!$item) {
                return response()->json(responseNotFound(), 404);
            }
            $attr = $request->all();
            $item->update($attr);
            return response()->json(responseSuccess($item), 202);
        } catch (Exception $e) {
            return response()->json(responseError($e), 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $item = $this->category->find($id);
            if (!$item) {
                return response()->json(responseNotFound(), 404);
            }
            $item->delete();
            return response()->json(responseDelete(), 200);
        } catch (Exception $e) {
            return response()->json(responseError($e), 500);
        }
    }
}

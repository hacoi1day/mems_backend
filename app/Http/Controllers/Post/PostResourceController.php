<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostResourceController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @param PostRequest $request
     * @return Response
     */
    public function index(PostRequest $request)
    {
        try {
            $page = $request->has('page') ? $request->input('page') : 1;
            $pageLimit = $request->has('pageLimit') ? $request->input('pageLimit') : 10;
            $items = $this->post->offset($page-1)->limit($pageLimit)->get();
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
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        try {
            $attr = $request->all();
            $item = $this->post->create($attr);
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
            $item = $this->post->find($id);
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
     * @param PostRequest $request
     * @param int $id
     * @return Response
     */
    public function update(PostRequest $request, int $id)
    {
        try {
            $item = $this->post->find($id);
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
            $item = $this->post->find($id);
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

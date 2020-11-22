<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Response;

class PermissionResourceController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @param PermissionRequest $request
     * @return void
     */
    public function index(PermissionRequest $request)
    {
        $items = $this->permission->all();
        return response()->json(responseList($items), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionRequest $request
     * @return void
     */
    public function store(PermissionRequest $request)
    {
        try {
            $attr = $request->all();
            $item = $this->permission->create($attr);
            if ($item) {
                return response()->json(responseSuccess($item), 201);
            }
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
            $item = $this->permission->findOrFail($id);
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
     * @param PermissionRequest $request
     * @param int $id
     * @return void
     */
    public function update(PermissionRequest $request, $id)
    {
        try {
            $item = $this->permission->findOrFail($id);
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $item = $this->permission->findOrFail($id);
            $item->delete();
            return response()->json(responseSuccess($item), 200);
        } catch (Exception $e) {
            return response()->json(responseError($e), 500);
        }
    }
}

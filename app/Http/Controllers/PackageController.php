<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageController extends Controller {

    public function showAll()
    : JsonResponse {
        return response()->json(Package::with(['subscriptions'  => function($query) {
            $query->orderBy('deleted_at');
        }])->get());
    }

    public function showOne($id)
    : JsonResponse {
        return response()->json(Package::with(['subscriptions'])->find($id));
    }

   

    public function create(Request $request)
    : JsonResponse {
        $this->validate($request, [
            'title' => 'required|unique:package',
        ]);
        $item = Package::create($request->all());
        return response()->json($item, Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    : JsonResponse {
        $item = Package::findOrFail($id);
        $this->validate($request, [
            'title' => 'unique:user,id,'.$id,
        ]);
        $item->update($request->all());
        return response()->json($item, Response::HTTP_OK);
    }

    public function delete($id) {
        Package::findOrFail($id)->delete();
        return response('Deleted Successfully', Response::HTTP_OK);
    }
}
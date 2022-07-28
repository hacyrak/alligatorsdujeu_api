<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FamilyController extends Controller {

    public function showAll()
    : JsonResponse {
        return response()->json(Family::with(['users'])->with(['subscriptions' => function ($q) {
            $q->with(['package']); }])
        ->orderBy('name')->get());
    }

    public function showOne($id)
    : JsonResponse {
        return response()->json(Family::with(['users'])->with(['subscriptions' => function ($q) {
            $q->with(['package']); }])
        ->find($id));
    }

    public function create(Request $request)
    : JsonResponse {
        $this->validate($request, [
            'name' => 'required|unique:family',
        ]);
        $item = Family::create($request->all());
        return response()->json($item, Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    : JsonResponse {
        $item = Family::findOrFail($id);
        $this->validate($request, [
            'name' => 'unique:family,id,'.$id,
        ]);
        $item->update($request->all());
        return response()->json($item, Response::HTTP_OK);
    }

    public function delete($id) {
        Family::findOrFail($id)->delete();
        return response('Deleted Successfully', Response::HTTP_OK);
    }
}
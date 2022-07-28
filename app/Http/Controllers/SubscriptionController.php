<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscriptionController extends Controller {

    public function showAll()
    : JsonResponse {
        return response()->json(Subscription::with(['family', 'package'])->orderByRaw('deleted_at')->get());
    }

    public function showOne($id)
    : JsonResponse {
        return response()->json(Subscription::with(['family', 'package'])->find($id));
    }

    public function getByPackage($id, $year = null)
    : JsonResponse {
        if (isset($year) && is_numeric($year)) {
            return response()->json(Subscription::with(['family', 'package'])->where('package_id','=',$id)->whereYear('deleted_at',$year)->orderByRaw('deleted_at', 'desc')->get());
        } elseif (isset($year) && $year == "now") {
            return response()->json(Subscription::with(['family', 'package'])->where('package_id','=',$id)->where('deleted_at','>=',Carbon::now())->orderByRaw('deleted_at', 'desc')->get());
        } else {
            return response()->json(Subscription::with(['family', 'package'])->where('package_id','=',$id)->orderByRaw('deleted_at', 'desc')->get());
        }
        
    }

    public function create(Request $request)
    : JsonResponse {
        $this->validate($request, [
            'family_id' => 'required|exists:family,id',
            'package_id' => 'required|exists:family,id',
            'created_at' => 'required',
            'deleted_at' => 'required'
        ]);
        $item = Subscription::create($request->all());
        return response()->json(Subscription::with(['family', 'package'])->find($item->id), Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    : JsonResponse {
        $item = Subscription::findOrFail($id);
        $this->validate($request, [
            'family_id' => 'exists:family,id',
            'package_id' => 'exists:family,id',
        ]);
        $item->update($request->all());
        return response()->json(Subscription::with(['family', 'package'])->find($item->id), Response::HTTP_OK);
    }

    public function delete($id) {
        Subscription::findOrFail($id)->delete();
        return response('Deleted Successfully', Response::HTTP_OK);
    }
}
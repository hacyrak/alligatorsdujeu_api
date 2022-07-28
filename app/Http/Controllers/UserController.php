<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Family;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {

    public function showAll()
    : JsonResponse {
        return response()->json(User::with(['family'])->get());
    }

    public function showOne($id)
    : JsonResponse {
        return response()->json(User::with(['family'])->find($id));
    }

    public function create(Request $request)
    : JsonResponse {
        $this->validate($request, [
            'pseudo' => 'required|unique:user',
            'family' => 'exists:family,id'
        ]);
        $item = User::create($request->all());
        if($request->has('avatar') && $request->avatar != null) {
            $item->avatar_path = Controller::uploadImage($request->avatar,$item->id,'avatar');
            $item->update(['avatar_path' => $item->avatar_path]);
        }
        return response()->json($item, Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    : JsonResponse {
        $item = User::findOrFail($id);
        $this->validate($request, [
            'pseudo' => 'unique:user,id,'.$id,
            'family' => 'exists:family,id'
        ]);
        $item->update($request->all());
        if($request->has('avatar') && $request->avatar != null) {
            $item->avatar_path = Controller::uploadImage($request->avatar,$item->id,'avatar');
            $item->update(['avatar_path' => $item->avatar_path]);
        }
        return response()->json($item, Response::HTTP_OK);  
    }

    public function delete($id) {
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', Response::HTTP_OK);
    }

    public function birthdayOfMonth()
    : JsonResponse {
        return response()->json(User::with(['family'])->whereMonth('birthday', date('m'))->orderByRaw('DAY(birthday)')->get());
    }

    public function birthdayOfDay()
    : JsonResponse {
        return response()->json(User::with(['family'])->whereMonth('birthday', date('m'))->whereDay('birthday', date('d'))->get());
    }

    public function getByFamily($id)
    : JsonResponse {
        return response()->json(User::with(['family'])->where('family_id','=',$id)->orderByRaw('DAY(birthday)')->get());
    }
  
}
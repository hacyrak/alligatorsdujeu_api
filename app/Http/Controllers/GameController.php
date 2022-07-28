<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GameController extends Controller {

    public function showAll()
    : JsonResponse {
        return response()->json(Game::orderBy('name')->get());
    }

    public function showOne($id)
    : JsonResponse {
        return response()->json(Game::find($id));
    }

    public function filter()
    : JsonResponse {  
        $tags = Game::select(DB::raw('SUBSTRING(SUBSTR(tags, 1, CHAR_LENGTH(tags) - 1),2) as tags_clean'))->distinct()->whereNotNull('tags')->pluck('tags_clean');
        //$tags = Game::query()->distinct()->whereNotNull('tags')->pluck('tags');
        $array["tags"] = array_values(array_unique(convert($tags)));

        //$collection = Game::query()->distinct()->whereNotNull('collection')->pluck('collection');
        $collection = Game::select(DB::raw('SUBSTRING(SUBSTR(collection, 1, CHAR_LENGTH(collection) - 1),2) as collection_clean'))->distinct()->whereNotNull('collection')->pluck('collection_clean');
        $array["collection"] = array_values(array_unique(convert($collection)));
        return response()->json($array);
    }

   

    public function create(Request $request)
    : JsonResponse {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $item = Game::create($request->all());
        if($request->filled('logo_data')) {
            $item->logo = Controller::uploadImage($request->input('logo_data'),$item->id,'logo');
            $item->update(['logo' => $item->logo]);
        }
        return response()->json($item, Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    : JsonResponse {
        $item = Game::findOrFail($id);
        $item->update($request->all());
        if($request->filled('logo_data')) {
            $item->logo = Controller::uploadImage($request->input('logo_data'),$item->id,'logo');
            $item->update(['logo' => $item->logo]);
        }
        return response()->json($item, Response::HTTP_OK);
    }

    public function delete($id) {
        Game::findOrFail($id)->delete();
        return response('Deleted Successfully', Response::HTTP_OK);
    }
}

function convert($data) {
    $coll = collator_create( 'fr_FR' );
    $i = 0;
    foreach($data as $str) {
        $items = explode(",", $str);
        foreach($items as $item) {
            $arr[$i] = trim(ucfirst($item));
            $i++;
        }
    }
    collator_sort($coll, $arr);
    return $arr;
}
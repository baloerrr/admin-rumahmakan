<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use App\Models\Data;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DataApiController extends Controller
{
    public function index(){
        $datas = Data::get();

        return new DataResource(true, 'List Data', $datas);
    }

    public function show($id){
        $data = Data::find($id);
        return new DataResource(true, 'Data Details', $data);
    }

    public function latest()
    {
        $datas = Data::orderBy('created_at', 'desc')->take(8)->get();
        return new DataResource(true, 'Latest 4 Data', $datas);
    }

    public function random()
    {
        $latestDataIds = Data::orderBy('created_at', 'desc')->take(8)->pluck('id');
        $datas = Data::whereNotIn('id', $latestDataIds)
                     ->inRandomOrder()
                     ->take(8)
                     ->get();
        if ($datas->count() < 8) {
            $additionalDatas = Data::whereIn('id', $latestDataIds)
                                   ->inRandomOrder()
                                   ->take(8 - $datas->count())
                                   ->get();
            $datas = $datas->merge($additionalDatas);
        }

        return new DataResource(true, 'Random Data', $datas);
    }


}

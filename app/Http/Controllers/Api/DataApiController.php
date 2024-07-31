<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Menu;
use App\Models\TentangKami;
use App\Models\Ulasan;

class DataApiController extends Controller
{
    public function galery(){
        $datas = Galery::get();
        return response()->json([
            "message" => "Data retrieved Successfully",
            "data" => $datas
        ], 200);
    }

    public function menu() {
        $datas = Menu::get();
        return response()->json([
            "message" => "Data retrieved Successfully",
            "data" => $datas
        ], 200);
    }

    public function tentangkami() {
        $datas = TentangKami::get();
        return response()->json([
            "message" => "Data retrieved Successfully",
            "data" => $datas
        ], 200);
    }

    public function ulasan() {
        $datas = Ulasan::get();
        return response()->json([
            "message" => "Data retrieved Successfully",
            "data" => $datas
        ], 200);
    }
}

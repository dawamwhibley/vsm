<?php

namespace App\Http\Controllers;

use App\Artikel;
use App\KataDasar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test(Request $request){
        Log::info('TEST CONTROLLER ' . json_encode($request->keyword));

        // == STEP 1 inisialisasi
        $preprocess = new PreProcessingController();
        $vsm = new VSMController();

        // == STEP 2 mendapatkan kata dasar
        $query = $preprocess::preprocess($request->keyword);

        // == STEP 3 medapatkan dokumen ke array
        //$connect = mysqli_query(mysqli_connect('localhost', 'root', '', 'vsm'), "SELECT * FROM artikel");
        $artikel = Artikel::all();
        $arrayDokumen = [];
        foreach ($artikel as $ar) {
            $arrayDoc = [
                'id_doc' => $ar['id'],
                'judul' => $ar['judul'],
                'dokumen' => implode(" ", $preprocess::preprocess($ar['deskripsi']))
            ];
            array_push($arrayDokumen, $arrayDoc);
        }

        Log::info('>>>>' .json_encode($arrayDokumen));

        // STEP 4 == mendapatkan ranking dengan VSM
        $rank = $vsm::get_rank($query, $arrayDokumen);

        Log::info('>>>RANK ' . json_encode($rank));
        $data['hasil'] = $rank;
        return view('hasil', $data);
    }
}

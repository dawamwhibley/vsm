<?php

namespace App\Http\Controllers;

use App\Artikel;
use App\Hasil;
use App\Jobs\ProcessCalculate;
use App\KataDasar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\Promise\all;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test(Request $request){
        Log::info('TEST CONTROLLER ' . json_encode($request->keyword));

        Hasil::truncate();

       ProcessCalculate::dispatch($request->keyword)
           ->delay(now()->addSeconds(5));
       return redirect('/hasil');

//         // == STEP 1 inisialisasi
//         $preprocess = new PreProcessingController();
//         $vsm = new VSMController();
//
//         // == STEP 2 mendapatkan kata dasar
//         $query = $preprocess::preprocess($request->keyword);
//
//         // == STEP 3 medapatkan dokumen ke array
//         //$connect = mysqli_query(mysqli_connect('localhost', 'root', '', 'vsm'), "SELECT * FROM artikel");
//         $artikel = Artikel::all();
//         $arrayDokumen = [];
//         foreach ($artikel as $ar) {
//             $arrayDoc = [
//                 'id_doc' => $ar['id'],
//                 'judul' => $ar['judul'],
//                 'dokumen' => implode(" ", $preprocess::preprocess($ar['deskripsi']))
//             ];
//             array_push($arrayDokumen, $arrayDoc);
//         }
//
//         Log::info('Data Query . ' .json_encode($query));
//         Log::info('Data Doc . ' .json_encode($arrayDokumen));
//
//         // STEP 4 == mendapatkan ranking dengan VSM
//         $rank = $vsm::get_rank($query, $arrayDokumen);
//
//        $rank = collect($rank)->sortBy('ranking')->reverse()->toArray();
//
//         $data['hasil'] = $rank;
//         return view('hasil', $data);
    }

    public function hasil(){
        $hasil = Hasil::all();
        return view('hasil', ['hasil' => $hasil]);
    }

    public function cekhasil(){
        $hasil = Hasil::all();
        return $hasil;
    }

    public function artikel(){
        return view('artikel');
    }

    public function artikelPost(Request $request){
//        Log::info('>>>' . json_encode($request->all()));
        $artikel = new Artikel();

        $artikel->judul = $request->judul;
        $artikel->deskripsi = $request->artikel;

        $artikel->save();

        return redirect('artikel/list');
    }

    public function artikelList(){
        $artikels = Artikel::all();

        return view('artikel-list', ['list' => $artikels]);
    }

    public function artikelHapus(Request $request){
//        Log::info('>>>' . json_encode($request->all()));
        Artikel::where('id', '=', $request->id)->delete();

        return redirect('artikel/list');
    }

    public function artikelDetail(Request $request){
        $artikel = Artikel::where('id', '=', $request->id)->first();
        return view('artikel-detail', ['artikel' => $artikel]);
    }
}

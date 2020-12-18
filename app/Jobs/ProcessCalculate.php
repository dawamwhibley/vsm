<?php

namespace App\Jobs;

use App\Artikel;
use App\Hasil;
use App\Http\Controllers\PreProcessingController;
use App\Http\Controllers\VSMController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessCalculate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $text;

    public function __construct($text)
    {
        //
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

        Log::info('START CALCULATE 1 ' . json_encode($this->text));
        // == STEP 1 inisialisasi
        $preprocess = new PreProcessingController();
        $vsm = new VSMController();

        // == STEP 2 mendapatkan kata dasar
        $query = $preprocess::preprocess($this->text);

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

        Log::info('Data Query . ' .json_encode($query));
        Log::info('Data Doc . ' .json_encode($arrayDokumen));

        // STEP 4 == mendapatkan ranking dengan VSM
        $rank = $vsm::get_rank($query, $arrayDokumen);

        $rank = collect($rank)->sortBy('ranking')->reverse()->toArray();

        $data['hasil'] = $rank;
        $count_data = 0;
        foreach ($rank as $obj){
            Log::info('>>>> ' . json_encode($obj));
            if($obj['ranking']>0){
                $count_data++;
                Log::info('MASUK');
                $hasil = new Hasil();
                $hasil->id_doc = $obj['id_doc'];
                $hasil->judul = $obj['judul'];
                $hasil->ranking = $obj['ranking'];

                $hasil->save();
            }
        }
        if($count_data==0){
            $hasil = new Hasil();
            $hasil->id_doc = 0;
            $hasil->judul = 'Data Tidak Ditemukan';
            $hasil->ranking = 0;

            $hasil->save();
        }


        Log::info('HASIL DARI JOBS ' . json_encode($data));
    }
}

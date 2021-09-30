<?php

namespace App\Http\Controllers;

use App\Models\Bpjs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Phpml\Math\Distance\Euclidean;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['hasil'] = DB::table('hasil')
            ->orderBy('created_at','DESC')
            ->get();

        return view('perhitungan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('perhitungan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $jumlahCluster = 3;
        $maksIter = $request->input('maksimum_iterasi');
        $errorTerkecil = $request->input('error_terkecil');


        $dataset = DB::table('dataset')->get();


        $matriksPartAwal = $this->matriksPartisiAwal($jumlahCluster,count($dataset));


//        var_dump($matriksPartAwal);

        $matriksPartU = []; //nilai untuk perhitungan matriks partisi U
        $p[0] = 0; // nilai P
        $fungsiObjektif = []; //perhitungan fungsi objektif
        $error = []; //nilai minimum error

//        echo "<pre>";

        for ($j = 0;$j < $maksIter; $j++){
            $p[$j+1] = 0;
            if ($j == 0){
                $c = [];
                $sumC = [];
                $pusatC = [];

                $L = [];
                $sumL = [];

                $ML = [];
                $sumML = [];

                for ($i = 0;$i < $jumlahCluster; $i++){
                    foreach ($dataset as $key => $value) {
                        $mu2 = pow(str_replace(',','.',$matriksPartAwal[$key][$i]),2);
//                        var_dump($mu2);
                        $c[$i][$key] = [
                            '𝝁i^2' => $mu2,
                            '𝝁i^2*x1' => $mu2 * $value->dataset_x1,
                            '𝝁i^2*x2' => $mu2 * $value->dataset_x2,
                            '𝝁i^2*x3' => $mu2 * $value->dataset_x3,
                            '𝝁i^2*x4' => $mu2 * $value->dataset_x4,
                        ];
                        $sumC[$i] = [
                            '∑𝝁i^2' => 0,
                            '∑𝝁i^2*x1' => 0,
                            '∑𝝁i^2*x2' => 0,
                            '∑𝝁i^2*x3' => 0,
                            '∑𝝁i^2*x4' => 0,
                        ];
                    }
                }

                for ($i = 0;$i < $jumlahCluster; $i++){
                    foreach ($dataset as $key => $value) {
                        $sumC[$i]['∑𝝁i^2'] += $c[$i][$key]['𝝁i^2'];
                        $sumC[$i]['∑𝝁i^2*x1'] += $c[$i][$key]['𝝁i^2*x1'];
                        $sumC[$i]['∑𝝁i^2*x2'] += $c[$i][$key]['𝝁i^2*x2'];
                        $sumC[$i]['∑𝝁i^2*x3'] += $c[$i][$key]['𝝁i^2*x3'];
                        $sumC[$i]['∑𝝁i^2*x4'] += $c[$i][$key]['𝝁i^2*x4'];
                    }

                    $pusatC[$i]['∑𝝁i^2*x1'] = $sumC[$i]['∑𝝁i^2*x1']/$sumC[$i]['∑𝝁i^2'];
                    $pusatC[$i]['∑𝝁i^2*x2'] = $sumC[$i]['∑𝝁i^2*x2']/$sumC[$i]['∑𝝁i^2'];
                    $pusatC[$i]['∑𝝁i^2*x3'] = $sumC[$i]['∑𝝁i^2*x3']/$sumC[$i]['∑𝝁i^2'];
                    $pusatC[$i]['∑𝝁i^2*x4'] = $sumC[$i]['∑𝝁i^2*x4']/$sumC[$i]['∑𝝁i^2'];

                }

                foreach ($dataset as $key => $value) {
                    $sumL[$key] = 0;
                    $sumML[$key] = 0;
                }

                for ($i = 0;$i < $jumlahCluster; $i++){
                    foreach ($dataset as $key => $value) {
                        $L[$i][$key] = (
                            ((pow($value->dataset_x1 - $pusatC[$i]['∑𝝁i^2*x1'],2)) +
                                (pow($value->dataset_x2 - $pusatC[$i]['∑𝝁i^2*x2'],2)) +
                                (pow($value->dataset_x3 - $pusatC[$i]['∑𝝁i^2*x3'],2)) +
                                (pow($value->dataset_x4 - $pusatC[$i]['∑𝝁i^2*x4'],2))) *
                            $c[$i][$key]['𝝁i^2']
                        );

                        $sumL[$key] += $L[$i][$key];
                        $ML[$i][$key] = (pow((
                            (pow($value->dataset_x1 - $pusatC[$i]['∑𝝁i^2*x1'],2)) +
                            (pow($value->dataset_x2 - $pusatC[$i]['∑𝝁i^2*x2'],2)) +
                            (pow($value->dataset_x3 - $pusatC[$i]['∑𝝁i^2*x3'],2)) +
                            (pow($value->dataset_x4 - $pusatC[$i]['∑𝝁i^2*x4'],2))),-1)
                        );

                        $sumML[$key] += $ML[$i][$key];
                    }

                }

                for ($i = 0;$i < $jumlahCluster; $i++){
                    foreach ($dataset as $key => $value) {
                        $matriksPartU[$i][$key] = $ML[$i][$key] / $sumML[$key];
                    }

                }

                foreach ($dataset as $key => $value) {
                    $p[$j+1] += $sumL[$key];
                }
            }
            else {
                $c = [];
                $sumC = [];
                $pusatC = [];

                $L = [];
                $sumL = [];

                $ML = [];
                $sumML = [];

                for ($i = 0;$i < $jumlahCluster; $i++){
                    foreach ($dataset as $key => $value) {
                        $mu2 = pow($matriksPartU[$i][$key],2);
                        $c[$i][$key] = [
                            '𝝁i^2' => $mu2,
                            '𝝁i^2*x1' => $mu2 * $value->dataset_x1,
                            '𝝁i^2*x2' => $mu2 * $value->dataset_x2,
                            '𝝁i^2*x3' => $mu2 * $value->dataset_x3,
                            '𝝁i^2*x4' => $mu2 * $value->dataset_x4,
                        ];
                        $sumC[$i] = [
                            '∑𝝁i^2' => 0,
                            '∑𝝁i^2*x1' => 0,
                            '∑𝝁i^2*x2' => 0,
                            '∑𝝁i^2*x3' => 0,
                            '∑𝝁i^2*x4' => 0,
                        ];
                    }
                }

                for ($i = 0;$i < $jumlahCluster; $i++){
                    foreach ($dataset as $key => $value) {
                        $sumC[$i]['∑𝝁i^2'] += $c[$i][$key]['𝝁i^2'];
                        $sumC[$i]['∑𝝁i^2*x1'] += $c[$i][$key]['𝝁i^2*x1'];
                        $sumC[$i]['∑𝝁i^2*x2'] += $c[$i][$key]['𝝁i^2*x2'];
                        $sumC[$i]['∑𝝁i^2*x3'] += $c[$i][$key]['𝝁i^2*x3'];
                        $sumC[$i]['∑𝝁i^2*x4'] += $c[$i][$key]['𝝁i^2*x4'];
                    }

                    $pusatC[$i]['∑𝝁i^2*x1'] = $sumC[$i]['∑𝝁i^2*x1']/$sumC[$i]['∑𝝁i^2'];
                    $pusatC[$i]['∑𝝁i^2*x2'] = $sumC[$i]['∑𝝁i^2*x2']/$sumC[$i]['∑𝝁i^2'];
                    $pusatC[$i]['∑𝝁i^2*x3'] = $sumC[$i]['∑𝝁i^2*x3']/$sumC[$i]['∑𝝁i^2'];
                    $pusatC[$i]['∑𝝁i^2*x4'] = $sumC[$i]['∑𝝁i^2*x4']/$sumC[$i]['∑𝝁i^2'];

                }

                foreach ($dataset as $key => $value) {
                    $sumL[$key] = 0;
                    $sumML[$key] = 0;
                }

                for ($i = 0;$i < $jumlahCluster; $i++){
                    foreach ($dataset as $key => $value) {
                        $L[$i][$key] = (
                            ((pow($value->dataset_x1 - $pusatC[$i]['∑𝝁i^2*x1'],2)) +
                                (pow($value->dataset_x2 - $pusatC[$i]['∑𝝁i^2*x2'],2)) +
                                (pow($value->dataset_x3 - $pusatC[$i]['∑𝝁i^2*x3'],2)) +
                                (pow($value->dataset_x4 - $pusatC[$i]['∑𝝁i^2*x4'],2))) *
                            $c[$i][$key]['𝝁i^2']
                        );

                        $sumL[$key] += $L[$i][$key];
                        $ML[$i][$key] = (pow((
                            (pow($value->dataset_x1 - $pusatC[$i]['∑𝝁i^2*x1'],2)) +
                            (pow($value->dataset_x2 - $pusatC[$i]['∑𝝁i^2*x2'],2)) +
                            (pow($value->dataset_x3 - $pusatC[$i]['∑𝝁i^2*x3'],2)) +
                            (pow($value->dataset_x4 - $pusatC[$i]['∑𝝁i^2*x4'],2))),-1)
                        );

                        $sumML[$key] += $ML[$i][$key];
                    }

                }

                for ($i = 0;$i < $jumlahCluster; $i++){
                    foreach ($dataset as $key => $value) {
                        $matriksPartU[$i][$key] = $ML[$i][$key] / $sumML[$key];
                    }

                }

                foreach ($dataset as $key => $value) {
                    $p[$j+1] += $sumL[$key];
                }

            }
//            var_dump((number_format(abs($p[$j+1] - $p[$j]),15)));
            $fungsiObjektif[$j] = $p[$j+1];
            $error[$j] = $p[$j+1] - $p[$j];
            if ((abs($p[$j+1] - $p[$j]) <= $errorTerkecil)){
                break;
            }
        }


//        echo "<pre>";
//
//        var_dump($c);
//        var_dump($sumC);
//        var_dump($pusatC);
//        var_dump($L);
//        var_dump($sumL);
//        var_dump($ML);
//        var_dump($sumML);
//        var_dump($matriksPartU);
//        var_dump($matriksPartAwal);
//        echo "</pre>";
        $hasilCluster = [];
        $hasilL = [];
        $hasilLT = [];
        for ($i=0;$i<$jumlahCluster;$i++){
            foreach ($dataset as $key=>$value) {
                $hasilCluster[$key][$i] = $matriksPartU[$i][$key];
                $hasilL[$key][$i] = $L[$i][$key];
            }
        }
        $mHasilCluster = [];
        foreach ($dataset as $key=>$value) {
            $mHasilCluster[$key] = (array_search(max($hasilCluster[$key]),$hasilCluster[$key]))+1;
            $hasilLT[$key] = $sumL[$key];
        }

        $simpan = [
            'hasil_jumlah_cluster' => $jumlahCluster,
            'hasil_iterasi' => $maksIter,
            'hasil_error_terkecil' => $errorTerkecil,
            'hasil_cluster_hitung' => json_encode($hasilCluster),
            'hasil_L' => json_encode($hasilL),
            'hasil_LT' => json_encode($hasilLT),
            'hasil_cluster' => json_encode($mHasilCluster),
            'hasil_fungsi_objektif' => json_encode($fungsiObjektif),
            'hasil_error' => json_encode($error)
        ];

//        echo "</pre>";

//        dd($simpan);
//        die;
        DB::table('hasil')->insert($simpan);

        return redirect('perhitungan');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data['hasil'] = DB::table('hasil')
            ->where('hasil_id','=',$id)
            ->first();
        $data['uji'] = DB::table('uji')
            ->where('uji_hasil_id','=',$id)
            ->first();
        $data['dataset'] = DB::table('dataset')
            ->join('data','data_id','=','dataset_data_id')
            ->get();
        $hasilCluster = json_decode($data['hasil']->hasil_cluster);
        $data['cluster'] = [];
        $pekerjaan = [];
        $i = 0;
        $rata = 0;
        foreach ($hasilCluster as $key=>$value) {
//            if ($value == 5){
            array_push($pekerjaan,trim(strtolower($data['dataset'][$key]->dataset_x2)));
            $rata+=$data['dataset'][$key]->dataset_x4;
            $i++;
            array_push($data['cluster'],[
                'data_nama' => $data['dataset'][$key]->data_nama,
                'data_nik' => $data['dataset'][$key]->data_nik,
                'data_hp' => $data['dataset'][$key]->data_hp,
                'data_alamat' => $data['dataset'][$key]->data_alamat,
                'data_tinggal' => $data['dataset'][$key]->data_tinggal,
                'data_jml_keluarga' => $data['dataset'][$key]->data_jml_keluarga,
                'data_pekerjaan' => $data['dataset'][$key]->data_pekerjaan,
                'data_penghasilan' => $data['dataset'][$key]->data_penghasilan,
                'cluster' => $value,
            ]);
        }
//        }
        $rataa = $rata / $i;

        $unique = array_unique( $pekerjaan );

        $diff = array_diff_assoc( $pekerjaan, $unique);


        $counted = array_count_values($diff);

        arsort($counted); //sort descending maintain keys

        $occurences = reset($counted); //get the first value (rewinds internal pointer )
        $most_frequent = key($counted); //get the key, as we are rewound it's the first key

//        print_r( $rataa );
//        dd($rataa);



//        dd($data['cluster']);

        return view('perhitungan.detail',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function matriksPartisiAwal($jumlahCluster,$jumlahData){
        $matriks = [];
        if ($jumlahCluster == 2) {
            $data = DB::table('matriks_2')->get();
            for ($i = 0;$i < $jumlahData;$i++){
                $matriks[$i] = [
                    $data[$i]->matriks_2_1,
                    $data[$i]->matriks_2_2,
                ];
            }
        } elseif ($jumlahCluster == 3) {
            $data = DB::table('matriks_3')->get();
            for ($i = 0;$i < $jumlahData;$i++){
                $matriks[$i] = [
                    $data[$i]->matriks_3_1,
                    $data[$i]->matriks_3_2,
                    $data[$i]->matriks_3_3,
                ];
            }
        } elseif ($jumlahCluster == 4) {
            $data = DB::table('matriks_4')->get();
            for ($i = 0;$i < $jumlahData;$i++){
                $matriks[$i] = [
                    $data[$i]->matriks_4_1,
                    $data[$i]->matriks_4_2,
                    $data[$i]->matriks_4_3,
                    $data[$i]->matriks_4_4,
                ];
            }
        } elseif ($jumlahCluster == 5) {
            $data = DB::table('matriks_5')->get();
            for ($i = 0;$i < $jumlahData;$i++){
                $matriks[$i] = [
                    $data[$i]->matriks_5_1,
                    $data[$i]->matriks_5_2,
                    $data[$i]->matriks_5_3,
                    $data[$i]->matriks_5_4,
                    $data[$i]->matriks_5_5,
                ];
            }
        }
        return $matriks;
    }

//    public function pengujian($id){
//        $hasil = DB::table('hasil')
//            ->where('hasil_id',$id)
//            ->first();
//        $clusterHitung = json_decode($hasil->hasil_cluster_hitung);
//        $cluster = json_decode($hasil->hasil_cluster);
//        $dataUji = [];
//        foreach ($clusterHitung as $key=>$value) {
//            array_push($dataUji,[
//                'data' => $value,
//                'cluster' => $cluster[$key]
//            ]);
//        }
//
//        $jumlahCluster = [];
//        $jumlahClusterLuar = [];
//        $dataCluster = [];
//        $dataClusterLuar = [];
//        $clusterLuar = [];
//
//        foreach ($dataUji as $key=>$value) {
//            for ($i = 1;$i <= $hasil->hasil_jumlah_cluster;$i++){
//                if ($value['cluster'] == $i){
//                    $jumlahCluster[$i] = 0;
//                    $dataCluster[$i] = [];
//                } else {
//                    $clusterLuar[$key] = [];
//                    $jumlahClusterLuar[$i] = 0;
//                    $dataClusterLuar[$i] = [];
//                }
//            }
//        }
//        foreach ($dataUji as $key=>$value) {
//            for ($i = 1;$i <= $hasil->hasil_jumlah_cluster;$i++){
//                if ($value['cluster'] == $i){
//                    $jumlahCluster[$i]++;
//                    array_push($dataCluster[$i],$value);
//                } else {
//                    $jumlahClusterLuar[$i]++;
//                    array_push($dataClusterLuar[$i],$value);
//                    array_push($clusterLuar[$key],$i);
//                }
//            }
//        }
//
//        $a = [];
//        $d = [];
//        $b = [];
//        $si = [];
//        $euclidean = new Euclidean();
//        foreach ($dataUji as $key=>$value) {
//            $_a = 0;
//            $v2 = [];
//            foreach ($dataCluster[$value['cluster']] as $key2 => $value2) {
//                $v2[$key] = $value2;
//                $_a += $euclidean->distance($value['data'],$value2['data']);
//                $a[$key] = 1/count($dataUji) * ($_a);
//            }
//
//            $__d[$key] = 0;
//            $avg[$key] = [];
//            foreach ($dataClusterLuar[$value['cluster']] as $key3 => $value3) {
//                if ($value3['cluster'] != $value['cluster']){
//                    foreach ($clusterLuar[$key] as $key4 => $value4){
//                        if ($value3['cluster'] == $value4){
//                            $__d[$key] += $euclidean->distance($v2[$key]['data'],$value3['data']);
//                            $_d[$key4][$key3] = $__d[$key];
//                            $d[$key][$key4][$key3] = 1/($jumlahCluster[$value3['cluster']]) * ($_d[$key4][$key3]);
//                        }
//                    }
//                }
//            }
//            foreach ($d[$key] as $key5 => $value5) {
//                $average = array_sum($value5) / count($value5);
//                array_push($avg[$key],$average);
//            }
//            $b[$key] = min($avg[$key]);
//            $si[$key] = ($b[$key] - $a[$key]) / max($a[$key],$b[$key]);
//        }
//
//        $simpan = [
//            'uji_hasil_id' => $id,
//            'uji_si' => json_encode($si),
//            'uji_si_global' => array_sum($si) / count($si)
//        ];
//
//        DB::table('uji')->insert($simpan);
//
//        return redirect('pengujian/'.$id);
//
//    }
}

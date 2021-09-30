<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Phpml\Math\Distance\Euclidean;

class PengujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['uji'] = DB::table('uji')
            ->join('hasil','hasil.hasil_id','=','uji.uji_hasil_id')
            ->get();
        return view('pengujian.index',$data);
    }

    public function pengujian($id)
    {
        $hasil = DB::table('hasil')
            ->where('hasil_id', $id)
            ->first();
        $clusterHitung = json_decode($hasil->hasil_cluster_hitung);
        $cluster = json_decode($hasil->hasil_cluster);
        $dataUji = [];
        foreach ($clusterHitung as $key => $value) {
            array_push($dataUji, [
                'data' => $value,
                'cluster' => $cluster[$key]
            ]);
        }

        $jumlahCluster = [];
        $jumlahClusterLuar = [];
        $dataCluster = [];
        $dataClusterLuar = [];
        $clusterLuar = [];

        foreach ($dataUji as $key => $value) {
            for ($i = 1; $i <= $hasil->hasil_jumlah_cluster; $i++) {
                if ($value['cluster'] == $i) {
                    $jumlahCluster[$i] = 0;
                    $dataCluster[$i] = [];
                } else {
                    $clusterLuar[$key] = [];
                    $jumlahClusterLuar[$i] = 0;
                    $dataClusterLuar[$i] = [];
                }
            }
        }
        foreach ($dataUji as $key => $value) {
            for ($i = 1; $i <= $hasil->hasil_jumlah_cluster; $i++) {
                if ($value['cluster'] == $i) {
                    $jumlahCluster[$i]++;
                    array_push($dataCluster[$i], $value);
                } else {
                    $jumlahClusterLuar[$i]++;
                    array_push($dataClusterLuar[$i], $value);
                    array_push($clusterLuar[$key], $i);
                }
            }
        }

        $a = [];
        $d = [];
        $b = [];
        $si = [];
        $euclidean = new Euclidean();
        foreach ($dataUji as $key => $value) {
            $_a = 0;
            $v2 = [];
            foreach ($dataCluster[$value['cluster']] as $key2 => $value2) {
                $v2[$key] = $value2;
                $_a += $euclidean->distance($value['data'], $value2['data']);
                $a[$key] = 1 / count($dataUji) * ($_a);
            }

            $__d[$key] = 0;
            $avg[$key] = [];
            foreach ($dataClusterLuar[$value['cluster']] as $key3 => $value3) {
                if ($value3['cluster'] != $value['cluster']) {
                    foreach ($clusterLuar[$key] as $key4 => $value4) {
                        if ($value3['cluster'] == $value4) {
                            $__d[$key] += $euclidean->distance($v2[$key]['data'], $value3['data']);
                            $_d[$key4][$key3] = $__d[$key];
                            $d[$key][$key4][$key3] = 1 / ($jumlahCluster[$value3['cluster']]) * ($_d[$key4][$key3]);
                        }
                    }
                }
            }
            foreach ($d[$key] as $key5 => $value5) {
                $average = array_sum($value5) / count($value5);
                array_push($avg[$key], $average);
            }
            $b[$key] = min($avg[$key]);
            $si[$key] = ($b[$key] - $a[$key]) / max($a[$key], $b[$key]);
        }

        $simpan = [
            'uji_hasil_id' => $id,
            'uji_si' => json_encode($si),
            'uji_si_global' => array_sum($si) / count($si)
        ];

        DB::table('uji')->insert($simpan);

        return redirect(route('pengujian.index'). '/' . $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data['uji'] = DB::table('uji')
            ->where('uji_hasil_id','=',$id)
            ->first();

        return view('pengujian.index', $data);
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
}

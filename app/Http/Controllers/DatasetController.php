<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Bpjs;
use Illuminate\Http\Request;
use DB;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dataset['dataset'] = Dataset::all();
        return view('dataset.index', $dataset);
    }

    public function load()
    {
        $data = Bpjs::all()
            ->whereNotNull('data_nama')
            ->whereNotNull('data_nik')
            ->whereNotNull('data_hp')
            ->whereNotNull('data_alamat')
            ->whereNotNull('data_tinggal')
            ->whereNotNull('data_jml_keluarga')
            ->whereNotNull('data_pekerjaan')
            ->whereNotNull('data_penghasilan')
            ->where('data_nama', '!=','-')
            ->where('data_nik', '!=', '-')
            ->where('data_hp','!=','-')
            ->where('data_alamat','!=', '-')
            ->where('data_tinggal','!=','-')
            ->where('data_jml_keluarga','!=','-')
            ->where('data_pekerjaan','!=','-')
            ->where('data_penghasilan','!=','-')
            ->where('data_penghasilan','!=', '0');

        $dataset = [];
        foreach ($data as $key => $value)
        {
            $rowDataset = [
                'dataset_data_id' => $value->data_id,
                'dataset_x1' => 0,
                'dataset_x2' => 0,
                'dataset_x3' => 0,
                'dataset_x4' => 0
            ];

            //penentuan kriteria dataset X1
            if($value->data_tinggal == "rumah sendiri"){
                $rowDataset['dataset_x1'] = 1;
            }
            elseif($value->data_tinggal = "kontrak")
            {
                $rowDataset['dataset_x1'] = 2;
            }

            //x2
            if($value->data_jml_keluarga <= "1"){
                $rowDataset['dataset_x2'] = 1;
            }
            elseif($value->data_jml_keluarga >= "1" && $value->data_jml_keluarga <= "2")
            {
                $rowDataset['dataset_x2'] = 2;
            }

            elseif($value->data_jml_keluarga >= "3" && $value->data_jml_keluarga <= "4")
            {
                $rowDataset['dataset_x2'] = 3;
            }

            elseif($value->data_jml_keluarga >= "5" && $value->data_jml_keluarga <="6")
            {
                $rowDataset['dataset_x2'] = 4;
            }

            elseif($value->data_jml_keluarga >= "7")
            {
                $rowDataset['dataset_x2'] = 5;
            }

            //x3
            if ($value->data_pekerjaan == "pegawai")
            {
                $rowDataset['dataset_x3'] = 1;
            }
            elseif ($value->data_pekerjaan == "pegawai swasta")
            {
                $rowDataset['dataset_x3'] = 2;
            }
            elseif ($value->data_pekerjaan == "guru")
            {
                $rowDataset['dataset_x3'] = 3;
            }
            elseif ($value->data_pekerjaan == "karyawan")
            {
                $rowDataset['dataset_x3'] = 4;
            }
            elseif ($value->data_pekerjaan == "pedagang")
            {
                $rowDataset['dataset_x3'] = 5;
            }
            elseif ($value->data_pekerjaan == "buruh")
            {
                $rowDataset['dataset_x3'] = 6;
            }

            //x4
            if ($value->data_penghasilan >= 0 && $value->data_penghasilan <= 999999)
            {
                $rowDataset['dataset_x4'] = 5;
            }
            elseif ($value->data_penghasilan >= 1000000 && $value->data_penghasilan <= 1999999)
            {
                $rowDataset['dataset_x4'] = 4;
            }
            elseif ($value->data_penghasilan >= 2000000 && $value->data_penghasilan <= 2999999)
            {
                $rowDataset['dataset_x4'] = 3;
            }
            elseif ($value->data_penghasilan >= 3000000 && $value->data_penghasilan <= 3999999)
            {
                $rowDataset['dataset_x4'] = 2;
            }
            elseif ($value->data_penghasilan >= 4000000)
            {
                $rowDataset['dataset_x4'] = 1;
            }
            array_push($dataset,$rowDataset);
        }
        DB::table('dataset')->truncate();
        DB::table('dataset')->insert($dataset);

        return redirect('dataset');
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

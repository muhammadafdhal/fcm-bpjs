<?php

namespace App\Http\Controllers;

use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BpjsImport;
use App\Models\Bpjs;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
//        $data['data'] =Data::all();
        $data['data'] = Bpjs::all();
        return view('data.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function import(Request $request)
    {

        $this->validate($request, [
            'file' =>   'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');

        //membuat nama file unik
        $nama_file = $file->hashName();

        //file sementara
        $path = $file->storeAs('public/excel', $nama_file);

        //import data
        $import = Excel::import(new BpjsImport, $file);



        //menghapus data dari server
        Storage::delete($path);
        if($import)
        //redirect
        {
            return redirect()->route('data.index')->with(['success' => 'Data berhasil Diimport']);
        }
        else
        //redirect
        {
            return redirect()->route('data.index')->with(['error' => 'Data tidak berhasil Diimport']);
        }
    }

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

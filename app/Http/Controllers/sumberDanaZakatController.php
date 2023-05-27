<?php

namespace App\Http\Controllers;

use App\Models\sumberDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class sumberDanaZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = sumberDana::orderBy('sumber_dana','desc');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi',function($data){
            return view('sumberDana.button')->with('data',$data);
        })
        ->make(true);
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
        $validasi = Validator::make($request->all(), [
            'sumber_dana' => 'required',
            'program' => 'required',
            'keterangan' => 'required',
        ],[
            'sumber_dana.required' => 'Masukan Data Sumber Dana',
            'program.required' => 'Masukan Data Program',
            'keterangan.required' => 'Keterangan masukan Ada / Tidak Ada',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        }else {
            $data = [
                'sumber_dana' => $request->sumber_dana,
                'program' => $request->program,
                'keterangan' => $request->keterangan,
            ];
            sumberDana::create($data);
            return response()->json(['success' => "Berhasil menyimpan data"]);
        }
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
        $data = sumberDana::where('id', $id)->first();
        return response()->json(['result' => $data]);
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
        $validasi = Validator::make($request->all(), [
            'sumber_dana' => 'required',
            'program' => 'required',
            'keterangan' => 'required',
        ],[
            'sumber_dana.required' => 'Masukan Data Sumber Dana',
            'program.required' => 'Masukan Data Program',
            'keterangan.required' => 'Keterangan masukan Ada / Tidak Ada',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        }else {
            $data = [
                'sumber_dana' => $request->sumber_dana,
                'program' => $request->program,
                'keterangan' => $request->keterangan,
            ];
            sumberDana::where('id',$id)->update($data);
            return response()->json(['success' => "Berhasil melakukan update data"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        sumberDana::where('id', $id)->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurusan;
use App\Models\mapel;
use DataTables;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('jurusan.index');
    }

    public function api()
    {
        $jurusan = Jurusan::all();
        return DataTables::of($jurusan)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='fas fa-trash-alt'></i></a>";
            })
            ->addColumn('n_jurusan', function ($p) {
                return "<a href='" . route('jurusan.show', $p->id) . "' class='text-primary' title='Show Data'> . $p->n_jurusan . </a>";

            })                
            
            
            ->addIndexColumn()
            ->rawColumns(['action', 'n_jurusan'])
            ->toJson();
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
        $request->validate([
            'n_jurusan' => 'required|unique:jurusan,n_jurusan',
            
        ]);

        $input = $request->all();
        Jurusan::create($input);

        return response()->json([
            'message' => 'Data berhasil tersimpan.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jurusan = Jurusan::findOrfail($id);
        $mapel = mapel::where('jurusan_id', $id)->get();
        return view('jurusan.show', compact(
            'jurusan',
            'mapel'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return Jurusan::find($id);
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
        $request->validate([
            'n_jurusan' => 'required|unique:jurusan,n_jurusan,' . $id,
            
        ]);

        $input = $request->all();
        $jurusan = Jurusan::findOrfail($id);
        $jurusan->update($input);

        return response()->json([
            'message' => 'data berhasil diperbaharui.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jurusan::destroy($id);

        return response()->json([
            'message' => 'Data berhsil di Hapus'
        ]);
    }
}

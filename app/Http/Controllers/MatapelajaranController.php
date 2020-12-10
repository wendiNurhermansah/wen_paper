<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\mapel;
use App\Models\m_pelajaran;
use App\Models\jurusan_pelajaran;
use App\Models\jurusan;

class MatapelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::select('id', 'n_jurusan')->get();
        return view('matapelajaran.index', compact('jurusan'));
    }

    public function api()
    {
        $m_pelajaran = M_pelajaran::all();
        return DataTables::of($m_pelajaran)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>";
                
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
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
            'nama' => 'required',
        ]);
            
        $input = $request->all();

        $mataPelajaran = M_pelajaran::create($input);

        jurusan_pelajaran::create([
            'id_jurusan' => $request->id_jurusan,
            'id_matapelajaran' => $mataPelajaran->id,
        ]);

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
        return M_pelajaran::find($id);
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
            'nama' => 'required',
            
            
        ]);

        $input = $request->all();
        $m_pelajaran = M_pelajaran::findOrfail($id);
        $m_pelajaran->update($input);

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
        M_pelajaran::destroy($id);

        return response()->json([
            'message' =>'data berhasil di hapus.'
        ]);
    }
}

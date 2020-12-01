<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\mapel;

class MatapelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('matapelajaran.index');
    }

    public function api()
    {
        $mapel = Mapel::all();
        return DataTables::of($mapel)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='fas fa-trash-alt'></i></a>";
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
            'n_mapel' => 'required',
            'jurusan_id'=> 'required',
            
        ]);

        $input = $request->all();
        Mapel::create($input);

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
        return Mapel::find($id);
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
            'n_mapel' => 'required',
            'jurusan_id'=> 'required',
            
        ]);

        $input = $request->all();
        $mapel = Mapel::findOrfail($id);
        $mapel->update($input);

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
        Mapel::destroy($id);

        return response()->json([
            'message' =>'data berhasil di hapus.'
        ]);
    }
}

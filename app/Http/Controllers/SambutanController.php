<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sambutan;
use DataTables;

class SambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.sambutan');
    }

    public function api()
    {
        $sambutan = Sambutan::all();
        return DataTables::of($sambutan)
            ->addColumn('action', function($p){
                return " 
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='fas fa-trash-alt'></i></a>";
            })

            ->addIndexColumn()
            ->rawColumns(['action',])
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
            'isi_sambutan' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:2024'
        ]);

        $file     = $request->file('gambar');
        $fileName = time() . "." . $file->getClientOriginalName();
        $request->file('gambar')->move("images/ava/", $fileName);

        $sambutan = new sambutan();
        $sambutan->isi_sambutan   =$request->isi_sambutan;
        $sambutan->gambar     = $fileName;
        $sambutan->save();

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
        sambutan::destroy($id);

        return response()->js([
            'massage' => 'data berhasil di hapus.'
        ]);
    }
}

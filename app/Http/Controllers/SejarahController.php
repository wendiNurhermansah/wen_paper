<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\sejarah;
use DataTables;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }


    public function api()
    {
       
        $sejarah = Sejarah::all();
        return DataTables::of($sejarah)
            ->addColumn('action', function ($p) {
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
            'isi' => 'required',
            'gambar'     => 'required|mimes:png,jpg,jpeg|max:2024'
            
        ]); 

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = rand() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('paud_storage/public', $fileName, 'sftp', 'public');
        }

        $sejarah = new sejarah();
        $sejarah->isi    =$request->isi;
        $sejarah->gambar     = $fileName;
        $sejarah->save();

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
        $data = sejarah::findOrFail($id);
      

        $exist = $data->gambar;
       
            Storage::disk('sftp')->delete('/paud_storage/public/' . $exist);
    

        $data->delete();

        return response()->js([
            'massage' => 'data berhasil di hapus.'
        ]);
    }
}

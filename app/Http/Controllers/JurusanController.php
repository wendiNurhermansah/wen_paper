<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurusan;
use App\Models\mapel;
use DataTables;
use App\Models\jurusan_pelajaran;
use App\Models\m_pelajaran;


class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan_pelajaran = Jurusan_pelajaran::select('id', 'jurusan_id', 'm_pelajaran_id')->get();
        $m_pelajaran = M_pelajaran::select('id', 'nama')->get();
        $jurusan = Jurusan::select('id', 'n_jurusan')->get();
        
        return view ('jurusan.index', compact('jurusan','jurusan_pelajaran', 'm_pelajaran'));
    }

    public function api()
    {
        $jurusan = Jurusan::all();
        return DataTables::of($jurusan)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>";
            })
           
            
            ->addColumn('jurusan_pelajaran', function ($p) {
                    $data = jurusan_pelajaran::where('jurusan_id', $p->id)->get();
                    
                return count($data). " <a href='" .route('jurusan.show', $p->id) . "' class='text-success pull-right' title='liat_pelajaran'><i class='icon-clipboard-list2 mr-1'></i></a>";
            })
            
            
            ->addIndexColumn()
            ->rawColumns(['action', 'jurusan_pelajaran'])
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
        $m_pelajaran = M_pelajaran::select('id', 'nama')->get();
        $jurusans = Jurusan::select('id', 'n_jurusan')->where('id', $id)->get();
        $jurusan_pelajaran = jurusan_pelajaran::where('jurusan_id', $id)->get();
        return view('jurusan.show', compact(
            'jurusan',
            'jurusans',
            'jurusan_pelajaran',
            'm_pelajaran'
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

    public function tambah(Request $request)
    {
        $request->validate([
            'jurusan_id'       => 'required',
            'm_pelajaran_id' => 'required'
            
        ]);

        $jurusan_pelajaran = new jurusan_pelajaran();
        $jurusan_pelajaran->jurusan_id      = $request->jurusan_id;
        $jurusan_pelajaran->m_pelajaran_id = $request->m_pelajaran_id;
        $jurusan_pelajaran->save();
   
       
        return response()->json([
            'message' => 'Data berhasil tersimpan.'
        ]);
    }

    
}

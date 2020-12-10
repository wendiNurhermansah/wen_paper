<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\jurusan;
use App\Models\m_pelajaran;
use App\Models\jurusan_pelajaran;

class JupelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::select('id', 'n_jurusan')->get();
        $m_pelajaran = M_pelajaran::select('id', 'nama')->get();
        return view('jupel.index', compact('jurusan', 'm_pelajaran'));
    }

    public function api()
    {
        $jurusan_pelajaran = jurusan_pelajaran::all();
        return DataTables::of($jurusan_pelajaran)
            ->addColumn('action', function ($p) {
                return "
                <a href='#' onclick='edit(" . $p->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('jurusan_id', function ($p) {
                return $p->jurusan->n_jurusan ;
            })
            ->editColumn('m_pelajaran_id', function ($p) {
                return $p->m_pelajaran->nama;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'jurusan_id', 'm_pelajaran_id'])
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
            'jurusan_id'       => 'required',
            'm_pelajaran_id' => 'required'
            
        ]);

        $cek = jurusan_pelajaran::where('jurusan_id', $request->jurusan_id)->where('m_pelajaran_id', $request->m_pelajaran_id)->get();
        if ($cek->count() >= 1 ) {
            return response()->json([
                'message' => 'Sudah berhasil tersimpan.'
            ], 442);
        }else {
            $jurusan_pelajaran = new jurusan_pelajaran();
            $jurusan_pelajaran->jurusan_id      = $request->jurusan_id;
            $jurusan_pelajaran->m_pelajaran_id = $request->m_pelajaran_id;
            $jurusan_pelajaran->save();

            return response()->json([
                'message' => 'Data berhasil tersimpan.'
            ]);
       
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
        
        return jurusan_pelajaran::find($id);
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
            'jurusan_id' => 'required',
            'm_pelajaran_id' => 'required'
        ]);

        $jurusan_pelajaran = Jurusan_pelajaran::find($id);
        $jurusan_pelajaran->update([
            'jurusan_id'=> $request->jurusan_id,
            'm_pelajaran_id' => $request->m_pelajaran_id
        ]);

            return response()->json([
                'message' => 'Data telah Terupdate.'
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
        jurusan_pelajaran::destroy($id);

        return response()->json([
            'message' => 'Data berhasil terhapus.'
        ]);
    }
}

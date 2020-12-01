<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Jurusan;
use App\Models\Mapel;
use DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $student = Student::all();
        $jurusan = Jurusan::select('id', 'n_jurusan')->get();
        $mapel = Mapel::select('id', 'n_mapel')->get();
        return view('mahasiswa.index', compact('student', 'jurusan', 'mapel'
    ));
    }

    public function mapelByJurusan($jurusan_id)
    {
        return mapel::select('id', 'n_mapel')->where('jurusan_id', $jurusan_id)->get();
    }


    public function api()
    {
        $student = Student::all();
        
        return DataTables::of($student)
            ->addColumn('action', function ($p) {
                return "
                <a href='".route('mahasiswa.show', $p->id)."'  title='Edit Role'><i class='fas fa-edit mr-3'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='fas fa-trash-alt'></i></a>";
            })
            
            ->editColumn('id_jurusan', function($p)
            {
                return $p->jurusan->n_jurusan;
            })
            ->editColumn('id_mapel', function($p)
            {
                return $p->mapel->n_mapel;
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
    public function create(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|max:6',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
            
        ]); 
        student::create($request->all());
        return redirect('/mahasiswa')->with('sukses', 'Data berhasil di tambahkan');

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
        $jurusan = Jurusan::select('id', 'n_jurusan')->get();
        $mapel = Mapel::select('id', 'n_mapel')->get();
        $student = Student::with('jurusan', 'mapel')->where('id', $id)->first();
         return view('mahasiswa.show', compact('student', 'jurusan', 'mapel', 'id'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jurusan = Jurusan::select('id', 'n_jurusan')->get();
        $mapel = Mapel::select('id', 'n_mapel')->get();

         $student = Student::find($id);
 
         return view('mahasiswa.show', compact(
         'student',
        'jurusan',
        'mapel',
        'id'
    ));
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
        $student = Student::find($id);
        
        $student->update($request->all());

        return response()->json([
            'message' => 'Data berhasil diperbaharui.'
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
       
        // $student = Student::findOrfail($id);

        // $student->delete();
        Student::destroy($id);

        return response()->json([
            'message' => 'Data berhasil di hapus'
        ]);
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurusan;
use App\Models\jurusan_pelajaran;
use App\Models\student;


class DashboardController extends Controller
{
    public function index() {
       
        return redirect ('dashboard');
    }

    public function dash() {
        $student = Student::select('id', 'nama')->get();
        $jurusan = Jurusan::select('id', 'n_jurusan')->get();
        $jurusan_pelajaran = Jurusan_pelajaran::select('id', 'jurusan_id', 'm_pelajaran_id')->orderBy('jurusan_id')->get();
        return view('dashboard', compact('student','jurusan', 'jurusan_pelajaran'));
    }

  
}

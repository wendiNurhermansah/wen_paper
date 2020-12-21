@extends('layouts.main')

@section('content')

<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h3>
                        <i class="icon icon-home mr-1"></i>
                        Dashboard
                    </h3>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card no-b">
                    <div class="card-body">
                        <h5 class="card-header"><strong>Daftar Nama Mahasiswa</strong></h5>
                        <div class="table-responsive" style="height: 300px">
                            <table class="table table-bordered table-striped mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="30">NO</th>
                                        <th>NAMA</th>
                                    </tr>
                                   
                                </thead>

                                <tbody style="height: 50px"> 
                                    @foreach ($student as $index => $i) 
                                   <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$i->nama}}</td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card no-b">
                    <div class="card-body">
                        <h2 class="card-header"><strong>Selamat Datang</strong></h2>
                        <div class="card-body">
                            <h4>Portal Akademik untuk Mahasiswa</h4>
                            <h3><p>Selamat datang di Portal Akademik untuk Mahasiswa ini. Portal Akademik ini digunakan oleh mahasiswa untuk memudahkan akses terhadap informasi - informasi akademik melalui internet.

                                Portal Akademik ini diharapkan dapat digunakan oleh semua civitas akademika dalam melakukan kegiatan - kegiatan akademik, seperti proses belajar mengajar, bimbingan mahasiswa dan aktivitas - aktivitas akademik lainnya.
                                
                                Selamat menggunakan fasilitas ini dengan baik dan bijaksana.</p></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card no-b">
                    <div class="card-body">
                        <h5 class="card-header"><strong>Daftar Jurusan</strong></h5>
                        <div class="table-responsive" style="height: 300px">
                            <table id="dataTable" class="table table-striped table-bordered overflow: aouto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="30">NO</th>
                                        <th>JURUSAN</th>
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    @foreach ($jurusan as $i)
                                    <tr>

                                        <td>{{$i->id}}</td>
                                        <td>{{$i->n_jurusan}}</td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card no-b">
                    <div class="card-body">
                        <h5 class="card-header"><strong>Daftar Mata pelajaran Perjurusan</strong></h5>
                        <div class="table-responsive" style="height: 500px">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th width="30">NO</th>
                                        <th>JURUSAN</th>
                                        <th>MATA PELAJARAN</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($jurusan_pelajaran as $index => $i)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $i->jurusan->n_jurusan }}</td>
                                        <td>{{ $i->m_pelajaran->nama }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

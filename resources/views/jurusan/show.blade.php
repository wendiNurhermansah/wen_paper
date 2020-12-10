@extends('layouts.main')

@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col">
                    <h4>
                        <i class="icon icon-users mr-2"></i>
                        Show Jurusan | {{ $jurusan->n_jurusan }}
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ url('jurusan') }}"><i class="icon icon-arrow_back"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-user"></i>{{ $jurusan->n_jurusan }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#tambah" role="tab"><i class="icon icon-plus"></i>Tambah Data</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content my-3" id="pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h6 class="card-header"><strong>Data Mata Pelajaran</strong></h6>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th width="30">No</th>
                                            <th>Nama Mata Pelajaran</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                           $no=1 ;             
                                        @endphp
                                        @foreach ($jurusan_pelajaran as $i)   
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $i->m_pelajaran->nama }}</td>
                                        </tr>
                                        @php
                                        $no++;
                                       @endphp
                                        @endforeach
                                       
                                        </tbody>
                                    </table>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
           @include('jurusan.tambah')
        </div>
    </div>
</div>


@endsection



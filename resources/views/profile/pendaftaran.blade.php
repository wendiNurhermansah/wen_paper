<@extends('layouts.main')

@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-users text-danger mr-2"></i>
                        Data Pendaftar
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-home2"></i>Semua Data</a>
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
                        <div class="card no-b">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <th width="30">NO</th>
                                            <th>Nama Ayah/Ibu</th>
                                            <th>Nik</th>
                                            <th>Alamat</th>
                                            <th>Pekerjaan</th>
                                            <th>No Hp</th>
                                            <th>Nama Siswa</th>
                                            <th>Umur</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th width="60">AKSI</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script type="text/javascript">
     var table = $('#dataTable').dataTable({
            processing: true,
            serverSide: true,
            pageLength: 15,
            order: [ 0, 'asc' ],
            ajax: {
                url: "{{ route('pendaftaran.api') }}",
                method: 'POST'
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
                {data: 'n_ayah', name: 'n_ayah'},
                {data: 'nik', name: 'nik'},
                {data: 'alamat', name: 'alamat'},
                {data: 'pekerjaan', name: 'pekerjaan'},
                {data: 'no_hp', name: 'no_hp'},
                {data: 'n_siswa', name: 'n_siswa'},
                {data: 'umur', name: 'umur'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 't_lahir', name: 't_lahir'},
                {data: 'tanggal_L', name: 'tanggal_L'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
            ]
        });

        function remove(id){
        $.confirm({
            title: '',
            content: 'Apakah yakin akan menghapus data ini ?',
            icon: 'icon icon-question amber-text',
            theme: 'modern',
            closeIcon: 'true',
            animation: 'scale',
            type: 'red',
            buttons: {
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        $.post("{{ route('pendaftaran.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'},function(data){
                            table.api().ajax.reload();
                            if(id == $('#id').val()) add();
                        }, "JSON").fail(
                            function(){
                                location.reload(); 
                            });
                    }
                },
                cansel: function(){}
            }
        });
    }
</script>
    
@endsection
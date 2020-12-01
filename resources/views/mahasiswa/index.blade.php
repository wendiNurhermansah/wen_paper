<@extends('layouts.main')

@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-users mr-2"></i>
                        MAHASISWA
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-home2"></i>Semua Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#tambah-data" role="tab"><i class="icon icon-plus"></i>Tambah Data</a>
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
                                            <th>NAMA</th>
                                            <th>NIM</th>
                                            <th>JENIS KELAMIN</th>
                                            <th>ALAMAT</th>
                                            <th>JURUSAN</th>
                                            <th>MATA PELAJARAN</th>
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

            <div class="tab-pane animated fadeInUpShort" id="tambah-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert"></div>
                        <div class="card">
                            <div class="card-body">
                    <form method="post" action="{{ url('/students') }}">
                    @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="masukan nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nim">nim</label>
                            <input type="text" class="form-control" id="nim" placeholder="masukan nim" name="nim" value="{{ old('nim') }}" required>
                        </div>
                        <div class="form-group">
                             <label>Jenis kelamin</label>
                                 <div>
                                  <select class="select2 form-control" name="jenis_kelamin" id="jenis_kelamin" autocomplete="off" required>

                                   <option value="">Pilih</option>
                                   
                                     <option value="LAKI-LAKI">LAKI-LAKI</option>
                                     <option value="PEREMPUAN">PEREMPUAN</option>
                                   
                                      </select>
                                                    
                                </div>
                        </div>

                        
                        <div class="form-group">
                             <label>Jurusan</label>
                                 <div>
                                  <select class="select2 form-control" name="id_jurusan" id="id_jurusan" autocomplete="off" required>

                                   <option value="">Pilih</option>
                                   	@foreach ( $jurusan as $i )
                                     <option value="{{ $i->id }}">{{ $i->n_jurusan }}</option>
                                    @endforeach
                                      </select>
                                                    
                                </div>
                        </div>
                         <div class="form-group">
                              <label>Mapel</label>
                                 <div >
                                  <select class="form-control select2" name="id_mapel" id="id_mapel" autocomplete="off" required>
                                   </select>
                                 </div>
                          </div>
                          <div class="form-group">
                            <label for=alamat>Alamat</label>
                            <input type="textarea" class="form-control" id="alamat" placeholder="masukan alamat" name="alamat" value="{{ old('alamat') }}" required>
                        </div>
                          <div>
                             <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Simpan<span id="txtAction"></span></button>
                              <a class="btn btn-sm" onclick="add()" id="reset">Reset</a>
                           </div>
                        
                        
                    </form>
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
                url: "{{ route('api') }}",
                method: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
                {data: 'nama', name: 'nama'},
                {data: 'nim', name: 'nim'},
                {data: 'jenis_kelamin', name: 'jenis_kelamin'},
                {data: 'alamat', name: 'alamat'},
                {data: 'id_jurusan', name: 'id_jurusan'},
                {data: 'id_mapel', name: 'id_mapel'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
            ]
        });

        function add(){
        save_method = "add";
        $('#tambah-data').trigger('reset');
        $('#formTitle').html('Tambah Data');
        $('input[name=_method]').val('POST');
        $('#txtAction').html('');
        $('#reset').show();
        $('#nama').focus();
    }
    


	 $('#id_jurusan').on('change', function(){
        val = $(this).val();
        option = "<option value=''>pilih:</option>";
        if(val == ""){
            $('#id_mapel').html(option);
            
            selectOnChange();
        }else{
            $('#id_mapel').html("<option value=''>Loading...</option>");
            url = "{{ route('mapelByJurusan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + value.n_mapel +"</li>";
                    });
                    $('#id_mapel').empty().html(option);

                    $("#id_mapel").val($("#id_mapel option:first").val()).trigger("change.select2");
                }else{
                    $('#id_mapel').html(option);
                   
                    selectOnChange();
                }
            }, 'JSON');
        }
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
                        $.post("{{ route('mahasiswa.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'},function(data){
                            table.api().ajax.reload();
                            if(id == $('#id').val()) add();
                        }, "JSON").fail(
                            function(){
                                reload();
                            });
                    }
                },
                cansel: function(){}
            }
        });
    }
    

</script>
@endsection

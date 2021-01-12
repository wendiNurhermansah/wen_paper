<@extends('layouts.main')

@section('content')
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-users mr-2"></i>
                        INFO SEKOLAH
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
                                            <th>INFO SEKOLAH</th>
                                            <th>Gambar</th>
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
                     <form class="needs-validation" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="nama_fasilitas">INFO SEKOLAH</label>
                            <input type="textarea" class="form-control @error('nama_fasilitas') is-invalid @enderror" id="nama_fasilitas" placeholder="masukan nama fasilitas" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" required>
                            @error('nama_fasilitas')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group m-0">
                            <label for="" class="col-form-label s-12 col-md-2">
                                Gambar
                                <a class="ml-1 mt-1" data-toggle="popover" title="Required" data-html="true" data-content="Max File: 2MB<br/>Format File: (png, jpg, jpeg)<br/>Width: 500 pixel<br/>Height: 500 pixel">
                                    <i class="icon icon-information2 s-18 red-text"></i>
                                </a>
                            </label>
                            <input type="file" name="gambar" id="file" class="input-file" onchange="tampilkanPreview(this,'preview')">
                            <label for="file" class="btn-tertiary js-labelFile col-md-6">
                                <i class="icon icon-image mr-2 m-b-1"></i>
                                <span id="changeText" class="js-fileName">Browse Image</span>
                            </label>
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
        pageLenght:15,
        order: [0, 'asc'],
        ajax: {
            url: "{{ route('infosekolah.api')}}",
            method: 'POST'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, align: 'center', className: 'text-center'},
            {data: 'nama_fasilitas', name: 'nama_fasilitas'},
            {data: 'gambar', name: 'gambar'},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},

        ]
    });

    (function () {
        'use strict';
        $('.input-file').each(function () {
            var $input = $(this),
                $label = $input.next('.js-labelFile'),
                labelVal = $label.html();

            $input.on('change', function (element) {
                var fileName = '';
                if (element.target.value) fileName = element.target.value.split('\\').pop();
                fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label
                    .removeClass('has-file').html(labelVal);
            });
        });
    })();

    function tampilkanPreview(gambar, idpreview) {
        var gb = gambar.files;
        for (var i = 0; i < gb.length; i++) {
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);
            var reader = new FileReader();
            if (gbPreview.type.match(imageType)) {
                preview.file = gbPreview;
                reader.onload = (function (element) {
                    return function (e) {
                        element.src = e.target.result;
                    };
                })(preview);
                reader.readAsDataURL(gbPreview);
            } else {
                $.confirm({
                    title: '',
                    content: 'Tipe file tidak boleh! haruf format gambar (png, jpg)',
                    icon: 'icon icon-close',
                    theme: 'modern',
                    closeIcon: true,
                    animation: 'scale',
                    type: 'red',
                    buttons: {
                        ok: {
                            text: "ok!",
                            btnClass: 'btn-primary',
                            keys: ['enter'],
                            action: add()
                        }
                    }
                });
            }
        }
    }

    function reset(){
        $('#form').trigger('reset');
        $('#preview').attr({ 'src': '-', 'alt': ''});
        $('#changeText').html('Browser Image')
    }

    function add(){
        save_method = "add";
        $('#tambah-data').trigger('reset');
        $('#formTitle').html('Tambah Data');
        $('input[name=_method]').val('POST');
        $('#txtAction').html('');
        $('#reset').show();
        $('#nama').focus();
    }

    add();
    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            url = "{{ route('infosekolah.store') }}",
            $.ajax({
                url : url,
                type : 'POST',
                data: new FormData(($(this)[0])),
                contentType: false,
                processData: false,
                success : function(data) {
                    console.log(data);
                    $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                    location.reload(); 
                },
                error : function(data){
                    err = '';
                    respon = data.responseJSON;
                    if(respon.errors){
                        $.each(respon.errors, function( index, value ) {
                            err = err + "<li>" + value +"</li>";
                        });
                    }
                    $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
                }
            });
            return false;
        }
        $(this).addClass('was-validated');
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
                        $.post("{{ route('infosekolah.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'},function(data){
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
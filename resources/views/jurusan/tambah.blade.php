<div class="tab-pane animated fadeInUpShort" id="tambah" role="tabpanel">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div id="alert"></div>
                <div class="card-body">
                    <div class="col-md-12">
                        <form class="needs-validation" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                            {{ method_field('POST') }}
                            <input type="hidden" id="id" name="id"/>
                            <h4 id="formTitle">Tambah Data</h4><hr>
                            <div class="form-row form-inline">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <label class="col-form-label s-12 col-md-4">Jurusan</label>
                                        <div class="col-md-8 p-0 bg-light">
                                            <select class="select2 form-control r-0 light s-12" name="jurusan_id" id="jurusan_id" autocomplete="off">
                                                <option value="">Pilih</option>
                                                @foreach ($jurusans as $i)
                                                    <option value="{{ $i->id }}">{{ $i->n_jurusan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group m-t-5">
                                        <label class="col-form-label s-12 col-md-4">Mata Pelajaran</label>
                                        <div class="col-md-8 p-0 bg-light">
                                            <select class="select2 form-control r-0 light s-12" name="m_pelajaran_id" id="m_pelajaran_id" autocomplete="off">
                                                <option value="">Pilih</option>
                                                @foreach($m_pelajaran as $i)
                                                    <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-2" style="margin-left: 34%">
                                        <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Simpan<span id="txtAction"></span></button>
                                        <a class="btn btn-sm" onclick="add()" id="reset">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script type="text/javascript">
 function add(){
        save_method = "add";
        $('#form').trigger('reset');
        $('#formTitle').html('Tambah Data');
        $('input[name=_method]').val('POST');
        $('#txtAction').html('');
        $('#reset').show();
        $('#jurusan_id').val("");
        $('#jurusan_id').trigger('change.select2');
        $('#m_pelajaran_id').val("");
        $('#m_pelajaran_id').trigger('change.select2');
       
    }

    add();
    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            $('#action').attr('disabled', true);
            url = (save_method == 'add') ? "{{ route('jurusan.tambah') }}" : "{{ route('jurusan.update', ':id') }}".replace(':id', $('#id').val());
            $.post(url, $(this).serialize(), function(data){
                $('#alert').html("<div role='alert' class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Success!</strong> " + data.message + "</div>");
                location.reload()
                if(save_method == 'add') add();
            }, "JSON").fail(function(data){
                err = ''; respon = data.responseJSON;
                $.each(respon.errors, function(index, value){
                    err += "<li>" + value +"</li>";
                });
                $('#alert').html("<div role='alert' class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button><strong>Error!</strong> " + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
            }).always(function(){
                $('#action').removeAttr('disabled');
            });
            return false;
        }
        $(this).addClass('was-validated');
    });

</script>
@endsection

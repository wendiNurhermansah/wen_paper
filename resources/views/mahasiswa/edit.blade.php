<div class="tab-pane animated fadeInUpShort" id="edit-data" role="tabpanel">
    <div class="row">
        <div class="col-md-12">
            <div id="alert"></div>
            <div class="card">
                <div class="card-body">
                    <form class="needs-validation" id="form" method="PATCH"  enctype="multipart/form-data" novalidate>
                        {{ method_field('PATCH') }}
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $id }}"/>
                        <h4>Edit Data</h4><hr>
                       
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="masukan nama" name="nama" value="{{ $student->nama }}">
                            @error('nama')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nim">nim</label>
                            <input type="text" class="form-control" id="nim" placeholder="masukan nim" name="nim" value="{{ $student->nim }}">
                        </div>
                        <div class="form-group">
                             <label>Jenis kelamin</label>
                                 <div>
                                  <select class="select2 form-control" name="jenis_kelamin" id="jenis_kelamin" autocomplete="off">

                                   <option value="">Pilih</option>
                                   
                                     <option value="LAKI-LAKI" @if($student->jenis_kelamin == 'LAKI-LAKI' ) selected @endif>LAKI-LAKI</option>
                                     <option value="PEREMPUAN" @if($student->jenis_kelamin == 'PEREMPUAN' ) selected @endif>PEREMPUAN</option>
                                   
                                      </select>
                                                    
                                </div>
                        </div>

                        <div class="form-group">
                            <label for=alamat>Alamat</label>
                            <input type="textarea" class="form-control" id="alamat" placeholder="masukan alamat" name="alamat" value="{{ $student->alamat }}">
                        </div>
                        <div class="form-group">
                             <label>Jurusan</label>
                                 <div>
                                  <select class="select2 form-control" name="id_jurusan" id="id_jurusan" autocomplete="off">

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
                                  <select class="form-control" name="id_mapel" id="id_mapel" autocomplete="off">
                                   </select>
                                 </div>
                          </div>
                          <div>
                             <button type="submit" class="btn btn-primary btn-sm" id="action"><i class="icon-save mr-2"></i>Edit<span id="txtAction"></span></button>
                             
                           </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script type="text/javascript">
    
    $('#id_jurusan').on('change', function(){
        val = $(this).val();
        option = "<option value=''>&nbsp;</option>";
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

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            url = "{{ route('mahasiswa.update', ':id') }}".replace(':id', $('#id').val());
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

</script>
@endsection
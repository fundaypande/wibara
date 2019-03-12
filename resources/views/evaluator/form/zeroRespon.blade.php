@extends('layouts.admin')

@section('content')


    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
              <div class="card-header">
                <h3>Antecedents</h3>

              </div>
            </div>

            <button onclick="deleteForm({{$form->id}})" type="button" name="share" class="btn btn-danger" style="float:right; margin-right: 20px">Delete</button>

            <div style="padding: 30px">
            <br>
            <h4>Do not have respondents yet, share the link form</h4>
            <br>
            <form method="post" data-toggle="validator" action="" id="theForm">
              {{ csrf_field() }} {{ method_field('POST') }}
            <div class="form-group">
              <label for="nama">Copy Link</label>
              <input type="text" name="nama" value="{{ url('/') }}/form/{{$form->id}}/{{$form->hash}}" class="form-control" id="inputCopy" required placeholder="">
            </div>

            <button onclick="copy()" type="button" class="btn btn-info btn-fill" id="simpan">Copy Link</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </form>
          </div>

    </div>


    <script type="text/javascript">

      function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#theForm')[0].reset();
        $('.modal-title').text('Share Form');
        console.log('Tampilkan Form ADD');
      }


      function copy() {
        $('#inputCopy').select();
        document.execCommand("copy");
        console.log('tercopy');

        Swal({
          position: 'top-end',
          type: 'success',
          title: 'Link copied to clipboard',
          showConfirmButton: false,
          timer: 1500
        })
      }


      function deleteForm(id){
        var csrf_token = $('meta[name="crsf_token"]').attr('content');
        Swal({
          title: 'Delete Data?',
          text: "Are you sure to delete this form",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Delete!',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url : "{{ url('form') }}" + '/' + id,
              type: "POST",
              data: {'_method': 'DELETE', '_token': csrf_token},
              success: function(data) {

                console.log(data);
                Swal({
                  position: 'top-end',
                  type: 'success',
                  title: 'Data berhasil dihapus',
                  showConfirmButton: false,
                  timer: 1500
                });
                window.location.replace("/form");
              },
              error: function(){
                Swal({
                  position: 'top-end',
                  type: 'error',
                  title: 'Cannot delete this data',
                  showConfirmButton: true,
                  timer: 8000
                })
              }
            });
          }
        });
      }

    </script>

@endsection

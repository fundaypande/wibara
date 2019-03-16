@extends('layoutResponden.layout')

@section('content')

    <div class="form-respon" id="modali">


      @if(count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors-> all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif


        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if(session('warning'))
          <div class="alert alert-warning ">
            {{session('warning')}}
          </div>
        @endif

        @if(session('notif'))
          <div class="alert alert-primary">
            {{session('notif')}}
          </div>
        @endif

        <br>


        <form method="post" data-toggle="validator" action="/form/{{$form -> id}}/add" id="theForm">
          {{ csrf_field() }} {{ method_field('POST') }}

          <div class="form-group">
            <label for="nama">Name</label>
            <input type="text" name="name" value="" class="form-control" id="name" required placeholder="">
          </div>

          <div class="form-group">
            <label for="nama">Affiliation</label>
            <input type="text" name="affiliation" value="" class="form-control" id="affiliation" required placeholder="">
          </div>

          <div class="form-group">
            <label for="nama">Email</label>
            <input type="email" name="email" value="" class="form-control" id="email" required placeholder="">
          </div>

          <hr>


          <div class="panel-body" style="overflow-x:auto;">
            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Value</th>
                </tr>

              </thead>
              <tbody>
                @foreach($butir as $key => $data)

                  <tr>
                    <td>
                      {{ $data -> butir }}
                    </td>
                    <td>
                      <select style="display: block;" id="nilai" name="{{$data -> id}}">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    </td>
                  </tr>


                @endforeach
              </tbody>
            </table>
          </div>






          <br>
          <br>
        <button type="submit" style="float:right" class="btn btn-info btn-fill" id="simpan">Save</button>
      </form>



    </div>


    <script type="text/javascript">
      var table;

        $(function(){
          $('#modali form').validator().on('submit', function (e) {
            e.preventDefault();
            console.log("Submit dipencet");
            alert('halaksd');
            var data = $('form').serialize();
            console.log("Submit dipencet");
            var form_action = $("#modali").find("form").attr("action");
            var csrf_token = $('meta[name="crsf_token"]').attr('content');
            console.log(form_action);
            $.ajax({
              // headers: {
              //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              // },
              url: form_action,
              type: "POST",
              dataType: "JSON",
              data: data,
              success: function(data) {
                table.ajax.reload();
                $(".modal").modal('hide');
                Swal({
                  position: 'top-end',
                  type: 'success',
                  title: 'Selamat data berhasi disimpan',
                  showConfirmButton: false,
                  timer: 1500
                });
              },
              error: function(jqXhr, json, errorThrown){// this are default for ajax errors
                var errors = jqXhr.responseJSON;
                var errorsHtml = '';
                $.each(errors['errors'], function (index, value) {
                    errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
                });
                //I use SweetAlert2 for this
                swal({
                    title: "Error " + jqXhr.status + ': ' + errorThrown,// this will output "Error 422: Unprocessable Entity"
                    html: errorsHtml,
                    width: 'auto',
                    confirmButtonText: 'Try again',
                    cancelButtonText: 'Cancel',
                    confirmButtonClass: 'btn',
                    cancelButtonClass: 'cancel-class',
                    showCancelButton: true,
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    type: 'error'
                }, function(isConfirm) {
                    if (isConfirm) {
                         $('#openModal').click();//this is when the form is in a modal
                    }
                });

              } //error close
            });
          });
        });

    </script>


@endsection

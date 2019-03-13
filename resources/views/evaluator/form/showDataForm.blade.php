@extends('layouts.admin')

@section('content')

<!-- Modal content-->
<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
<div class="modal-dialog">


<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title" id="modal-title">Tambah Peralatan IKM</h4>
  </div>
  <div class="modal-body">
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
  <div class="modal-footer">

  </div>
</div>

</div>
</div>

<!-- end modal content -->

    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
              <div class="card-header">
                <h3>Antecedents</h3>

              </div>

              <button onclick="deleteForm({{$form->id}})" type="button" name="share" class="btn btn-danger" style="float:right; margin-right: 20px">Delete</button>
              <button onclick="addForm()" type="button" name="share" class="btn btn-primary" style="float:right; margin-right: 20px">Share Form</button>


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
              <br>
              <h4>Total Respondent: {{ count($responden) }}</h4>
            </div>


            <div class="panel-body" style="overflow-x:auto;">
              <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
              <tr>
                <th>Q</th>
                @foreach($responden as $key => $responde)
                  <th>R{{$key}}</th>
                @endforeach
                <th style="color:blue">Average</th>
              </tr>

              <?php
                for($baris=0;$baris<$butir;$baris++) {
                    print('<tr>');
                    ?>
                    <th> <?php echo "Q".$baris;?> </th>
                    <?php
                    for($kolom=0;$kolom<count($dataResponden);$kolom++) {
                        print("<td>{$dataResponden[$kolom][$baris]}</td>");

                    }
                    print("<th style='color:blue'>{$average[$baris]}</th>");
                    print('</tr>');
                }


              ?>

            </table>
          </div>

          <form method="post" data-toggle="validator" action="/form/{{$form->id}}/update-average" id="theForm">
            {{ csrf_field() }} {{ method_field('POST') }}

            <?php for ($i=0; $i < $butir; $i++) {
              // code...
            ?>

            <input type="hidden" name="{{$i}}" value="{{$average[$i]}}">


            <?php }  ?>


            <button style="width:200px; margin-left: 20px" type="submit" class="btn btn-info btn-fill" id="simpan">Update Averages</button>

          </form>

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

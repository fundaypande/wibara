@extends('layoutResponden.layout')

@section('content')

    <div class="form-respon">


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

        <div class="alert alert-success" role="alert">
            Congratulations all your data has been saved!

            <!-- <a href="#" class="btn btn-primary">Input Scores</a> -->
        </div>






    </div>


@endsection

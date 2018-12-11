@extends('layouts.admin')

@section('content')

    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Kelola Staf</h3>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Daftar staf yang dapat mengakses sistem

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    

                </div>
            </div>

    </div>

@endsection

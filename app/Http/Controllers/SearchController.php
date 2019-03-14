<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\DataForm;
use App\DataAverage;
use App\Outcome;
use App\User;
use App\Butir;
use Auth;
use Yajra\Datatables\Datatables;

class SearchController extends Controller
{
  public function show()
  {
    // dd('masuk');
    return view('admin.search.show');
  }

  public function apiSearch()
  {
    $form = Form::join('users', 'users.id', '=', 'forms.user_id')
          ->select('forms.*', 'users.*', 'forms.id AS idForm', 'forms.created_at AS date')
          -> get();

    // dd($form);


    return Datatables::of($form)
      -> addColumn('action', function($form){
        return '
          <a style="color:white" href="/forms/' . $form -> idForm . '/judgement" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i>Show Data</a>
        ';
      })
      ->make(true);
  }

}

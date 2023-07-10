@section('head')
    <!-- iCheck -->
    <link href="{{ url('assets/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

@endsection

@extends('layouts.master', ['title' => $title])

@section('foot')
    <!-- bootstrap-progressbar -->
    <script src="{{ url('assets/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
@endsection

@section('content')

    <div class="product-status mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>LISTES LOCALITES </h4>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Codeloc</th>
                                    <th scope="col">Nomloc</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($localites as $loc)
                                    <tr>
                                        <td><span>{{$loc->id}}</span></td>
                                        <td><span>{{$loc->nomloc}}</span></td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection



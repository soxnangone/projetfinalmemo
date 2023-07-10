
@extends('master')

@section('content')
    <h1>FORMA</h1>
    <div>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">CODE_FORMA</th>
                <th scope="col">NOM_FORMA</th>
                <th scope="col">LOCALITE</th>

            </tr>
            </thead>
            <tbody>
            @foreach($formation as $form)
                <tr>
                    <td><span>{{$form->id}}</span></td>
                    <td><span>{{$form->nom_formation}}</span></td>
                    <td><span>{{$form->codeloc}}</span></td>

                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection



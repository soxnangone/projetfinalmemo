@section('head')
    <!-- iCheck -->
    <link href="{{ url('assets/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/step.css">
@endsection

@extends('layouts.master', ['title' => $title])

@section('foot')
    <!-- bootstrap-progressbar -->
    <script src="{{ url('assets/gentelella/vendors/iCheck/icheck.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ url('assets/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script
        src="{{ url('assets/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script
        src="{{ url('assets/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script
        src="{{ url('assets/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <script src="/js/script.js"></script>
    <script src="/js/step.js"></script>
    <script>
    </script>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /*ajout mariage*/
            $('#datem').on('change keyup', function () {
                if (this.value.length === 10) {
                    var debut = Date.parse($('#datem').val());
                    var fin = Date.parse(new Date());
                    var diff = new Date(fin - debut);
                    console.log('diff', diff);
                    var jour = diff / 86400000;
                    if (jour < 45) {
                        $('#normale').prop('checked', true);
                        $('#tardive').prop('checked', false);
                        $('#normale').prop('disabled', false);
                    }
                    else{
                        $('#normale').prop('checked', false);
                        $('#tardive').prop('checked', true);
                        $('#tardive').prop('disabled', false);
                    }
                }
            });
            /*modifier mariage*/
            $('#datem').on('change keyup', function () {
                if (this.value.length === 10) {
                    var debut = Date.parse($('#datem').val());
                    var fin = Date.parse(new Date());
                    var diff = new Date(fin - debut);
                    console.log('diff', diff);
                    var jour = diff / 86400000;
                    if (jour < 45) {
                        $('#normal').prop('checked', true);
                        $('#tardiv').prop('checked', false);
                        $('#normal').prop('disabled', false);

                    }
                    else{
                        $('#normal').prop('checked', false);
                        $('#tardiv').prop('checked', true);
                        $('#tardiv').prop('disabled', false);
                    }
                }
            });
            /*afficher donnees mariage*/
            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mariage_valide') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'num_registre', name: 'num_registre'},
                    {data: 'lieum', name: 'lieum'},
                    {data: 'regime', name: 'regime'},
                    {data: 'option', name: 'option'},
                    {
                        data: 'datem',
                        render: function (data) {
                            var date = new Date(data);
                            var month = date.getMonth() + 1;
                            return (date.getDate().toString().length > 1 ? date.getDate() : "0" + date.getDate()) + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" + date.getFullYear()
                        },
                        name: 'datem'
                    },
                    {
                        data: 'date_dec',
                        render: function (data) {
                            var date = new Date(data);
                            var month = date.getMonth() + 1;
                            return (date.getDate().toString().length > 1 ? date.getDate() : "0" + date.getDate()) + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" + date.getFullYear()
                        },
                        name: 'date_dec'
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

            });
            /*impression extrait*/
            $('body').on('click', '.printMariage', function () {
                var mariage_id = $(this).data('id');
                $.get("{{'volet'}}" + '/' + mariage_id, function (data) {
                    window.location.href = 'volet/' + mariage_id;
                })
            });
            /*modifier mariage*/
            $('body').on('click', '.modifier', function (e) {

                var mariage_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editMariage') }}" + '/' + mariage_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        var date = new Date(data.datem);
                        var month = date.getMonth() + 1;

                        var date_dec = new Date(data.date_dec);
                        var month_dec = date_dec.getMonth() + 1;

                       

                        $('#ajaxModel2').modal('show');
                        $('#mariage_id').val(data.id);
                        $('#num-registre').val(data.num_registre);
                        $('#option').val(data.option);
                        $('#lieum').val(data.lieum);
                        $('#regime').val(data.regime);
                        $('#date_dec').val((date_dec.getDate().toString().length > 1 ? +date_dec.getFullYear() : "0") + "-" + (month_dec.toString().length > 1 ? month : "0" + month) + "-" + date_dec.getDate());
                        $('#datem').val((date.getDate().toString().length > 1 ? +date.getFullYear() : "0") + "-" + (month.toString().length > 1 ? month : "0" + month) + "_" + date.getDate());
                        $('#dot').val(data.dot);
                        $('#heurem').val(data.heurem);
                        
                        if (data.type_dec === 'NORMALE') {
                            console.log('ok');
                            $('#normal').attr('checked', true);
                            $('#tardiv').attr('checked', false);
                        } else if (data.type_dec === 'TARDIVE') {
                            console.log('nok');
                            $('#normal').attr('checked', false);
                            $('#tardiv').attr('checked', true);
                        }
                        else{
                            console.log('merde');
                            $('#normal').attr('checked', false);
                            $('#tardiv').attr('checked', false);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*edit mariage*/
            $('body').on('click', '.editMariage', function (e) {

                var mariage_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editMariage') }}" + '/' + mariage_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        var date = new Date(data.date_naiss);
                        var month = date.getMonth() + 1;
                        $('#ajaxModel').modal('show');
                        $('#mariage_id').val(data.id);
                        $('#num-registre').val(data.num_registre);
                        $('#option').val(data.option);
                        $('#lieum').val(data.lieum);
                        $('#regime').val(data.regime);
                        $('#datem').val((date.getDate().toString().length > 1 ? +date.getFullYear() : "0") + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" + date.getDate());
                        $('#date_dec').val((date_dec.getDate().toString().length > 1 ? +date_dec.getFullYear() : "0") + "-" + (month_dec.toString().length > 1 ? month : "0" + month) + "-" + date_dec.getDate());
                        $('#dot').val(data.dot);
                        $('#heurem').val(data.heurem);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*enregistrer modification mariage*/
            $('#submit').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#form_mariage').serialize(),
                    url: "{{ route('validations_mariage.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Validation reuissi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#form_mariage').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'echec validation!',
                        })
                    }
                });
            });

        });
    </script>

@endsection

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Mariages <small>Listes Mariages</small></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Mariages</h2>
                        <ul class="nav navbar-right panel_toolbox">

                            <button type="button"  data-toggle="modal" data-target="#ajaxModel1" class="btn btn-success btn-xs">Nouveau</button>


                        </ul>

                        <div class="clearfix"></div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="x_content">



                        <!-- start project list -->
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>N°</th>
                                <th>N° Régistre</th>
                                <th>Lieu Mariage</th>
                                <th>Régime</th>
                                <th>option</th>
                                <th>Date Mariage</th>
                                <th>Date Déclaration</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>


                            </tbody>
                        </table>
                        <!-- end project list -->
                        <!-- creation pop up -->

                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- AJOUTER MARIAGE-->
   <div class="modal fade" id="ajaxModel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
            <h2>
                Nouvelle Declaration de Mariage
                <span id="btnClose" class="btnClose">&times;</span>
            </h2>

                <form class="form-horizontal form-label-left" method="POST" action="/ajout">
                    @csrf
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <li>
                                <a href="#step" >
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                      Etape 1<br/>
                                      <small>Mariage</small>
                                  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-2">
                                    <span class="step_no">2</span>
                                    <span class="step_descr">
                                      Etape 2<br/>
                                      <small>Mariés</small>
                                  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-3">
                                    <span class="step_no">3</span>
                                    <span class="step_descr">
                                      Etape 3<br/>
                                      <small>Temoins</small>
                                  </span>
                                </a>
                            </li>

                            <li>
                                <a href="#step-4">
                                    <span class="step_no">4</span>
                                    <span class="step_descr">
                                      Etape 4<br/>
                                      <small>Officier</small>
                                  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-5">
                                    <span class="step_no">5</span>
                                    <span class="step_descr">
                                      Etape 5<br/>
                                      <small>Mention Marginale</small>
                                  </span>
                                </a>
                            </li>
                        </ul>
                        <div id="step">
                            <div class="row">

                                </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Numero Régistre </label>

                                    <input type="text" required class="form-control" placeholder="Numéro Régistre *"
                                           name="num_registre" id="num_registre">
                                </div>
                                <div class="form-group">
                                    <label for="username">Date Déclaration </label>
                                    <input type="date" class="form-control" placeholder="DATE *" required
                                           name="date_dec" id="date_dec">
                                </div>
                                <div class="form-group">
                                    <label for="username">Date Mariage </label>
                                    <input type="date" class="form-control" placeholder="DATE *" required
                                           name="datem" id="datem">
                                </div>
                                <div class="form-group">
                                    <label for="username">Heure Mariage</label>
                                    <input type="date" class="form-control" name="heurem" id="heurem" placeholder="HEURE *" required>
                                </div>

                                <div class="form-group"  id="num_jugement"  style="visibility: hidden">
                                        <label for="username">Lieu Mariage </label>
                                        <input type="text" class="form-control" placeholder="LIEU *"
                                               name="LIEUM" id="lieum" required>

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="username">Option</label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="option" required>

                                                <option >Monogamie</option>
                                                <option >Polygamie</option>
                                                <option >Polygamie a deux</option>
                                                <option >Polygamie a trois</option>
                                                <option >Polygamie a quatre</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">REGIME</label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="regime" required>

                                                <option >Communaute des biens</option>
                                                <option >Separation des biens</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Type Déclaration</label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="type_dec" required>

                                                <option >NORMALE</option>
                                                <option >TARDIVE</option>

                                            </select>
                                        </div>
                                <div class="form-group">
                                    <label for="username">Dot </label>
                                    <input type="number" class="form-control" placeholder="Dot *" required
                                           name="dot">
                                </div>
                            </div>
                           
                        </div>
                        <div id="step-2">


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>EPOUX</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Epoux</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_epoux">

                                        <option selected disabled>choose....</option>
                                          @foreach($epoux as $epx)
                                            <option value="{{$epx->id}}">{{$epx->prenom_epoux}} {{$epx->nom_epoux}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                              
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>EPOUSE</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Epouse</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_epouse">

                                        <option selected disabled>choose....</option>
                                        @foreach($epouse as $epse)
                                            <option value="{{$epse->id}}">{{$epse->prenom_epouse}} {{$epse->nom_epouse}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>


                        </div>

                        <div id="step-3" >

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin 1</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Temoin1</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t1">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t1)
                                            <option value="{{$t1->id}}">{{$t1->prenom}} {{$t1->nom}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin2</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Temoin2</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t2">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t2)
                                            <option value="{{$t2->id}}">{{$t2->prenom}} {{$t2->nom}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin3</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Temoin3</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t3">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t3)
                                            <option value="{{$t3->id}}">{{$t3->prenom}} {{$t3->nom}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin4</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Temoin4</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t4">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t4)
                                            <option value="{{$t4->id}}">{{$t4->prenom}} {{$t4->nom}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-4" >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <center><h5>Officier</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Officier</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_officier">

                                        <option selected disabled>choose....</option>
                                        @foreach($officier as $off)
                                            <option value="{{$off->id}}">{{$off->prenom_officier}} {{$off->nom_officier}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>
                        </div>

                        <div id="step-5" >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <center><h5>MENTION MARGINALE</h5></center>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea name="mention" id="mention" type="text" style="width: 80%; margin-left: 10%" rows="10">  </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <!-- End SmartWizard Content -->
        </div>
    </div>
    </div>
    <!-- FIN AJOUTER MARIAGE-->
    <!-- AFFICHEZ INFO MARIAGE NON MODIFIABLE-->
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
                    <h1>DETAILS</h1>

                        <div class="row">
                                <center> <h2>Mariage</h2></center>
                                <input type="hidden" class="form-control" name="mariage_id" id="mariage_id" disabled>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Numero Régistre </label>

                                    <input type="text" required class="form-control" placeholder="Nunero Registre *"
                                           name="num_registre" id="num_registre"  disabled>
                                </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Date Mariage</label>
                                    <input class="form-control"  name="datem" id="datem"  disabled>
                                </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Lieu Mariage </label>

                                    <input type="text" required class="form-control" placeholder="Lieu Mariage *"
                                           name="lieum" id="lieum"  disabled>
                                </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Heure Mariage</label>
                                    <input type="date" class="form-control" name="heurem" id="heurem" placeholder="HEURE *" required>
                                </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                            <label for="username">REGIME</label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="regime" required>

                                                <option >Communaute des biens</option>
                                                <option >Separation des biens</option>

                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                            <label for="username">Option</label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="option" required>

                                                <option >Monogamie</option>
                                                <option >Polygamie</option>
                                                <option >Polygamie a deux</option>
                                                <option >Polygamie a trois</option>
                                                <option >Polygamie a quatre</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Dot </label>
                                    <input type="text" class="form-control" placeholder="Dot *" required
                                           name="dot" id="dot"  disabled>
                                </div>
                                </div>
                            </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center> <h2>Epoux</h2></center>
                        <div class="form-group">
                                    <label for="username">Epoux</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_epoux">

                                        <option selected disabled>choose....</option>
                                          @foreach($epoux as $epx)
                                            <option value="{{$epx->id}}">{{$epx->prenom_epoux}} {{$epx->nom_epoux}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center> <h2>Epouse</h2></center>
                        <div class="form-group">
                                    <label for="username">Epouse</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_epouse">

                                        <option selected disabled>choose....</option>
                                        @foreach($epouse as $epse)
                                            <option value="{{$epse->id}}">{{$epse->prenom_epouse}} {{$epse->nom_epouse}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center>     <h2>Témoins</h2></center>
                        <div class="form-group">
                                    <label for="username">Temoin 1</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t1">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t1)
                                            <option value="{{$t1->id}}">{{$t1->prenom}} {{$t1->nom}}</option>
                                        @endforeach
                                     </select>
                        </div>
                        <div class="form-group">
                                    <label for="username">Temoin 2</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t2">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t2)
                                            <option value="{{$t2->id}}">{{$t2->prenom}} {{$t2->nom}}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="form-group">
                                    <label for="username">Temoin 3</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t3">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t3)
                                            <option value="{{$t3->id}}">{{$t3->prenom}} {{$t3->nom}}</option>
                                        @endforeach
                                     </select> 
                        </div>  
                        <div class="form-group">
                                    <label for="username">Temoin 4</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t4">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t4)
                                            <option value="{{$t4->id}}">{{$t4->prenom}} {{$t4->nom}}</option>
                                        @endforeach
                                     </select>
                          </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center>  <h2>Officier</h2></center>
                        <div class="form-group">
                                    <label for="username">Officier</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_officier">

                                        <option selected disabled>choose....</option>
                                        @foreach($officier as $off)
                                            <option value="{{$off->id}}">{{$off->prenom_officier}} {{$off->nom_officier}}</option>
                                        @endforeach
                                    </select>
                          </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
    <!-- FIN AFFICHAGE INFO MARIAGE NON MODIFIABLE-->
    <!-- AFFICHEZ INFO MARIAGE MODIFIABLE PAR OFFICIER-->
    <div class="modal fade" id="ajaxModel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="svg_wrap"></div>

                  <center>  <h1>Modification</h1></center>
                    <form class="form-horizontal form-label-left" id="form_mariage">
                        @csrf

                    <section>
                      <center>  <p>Mariage</p></center>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Numero Régistre </label>

                                    <input type="text" required class="form-control" placeholder="Numéro Régistre *"
                                           name="num_registre" id="num_registre">
                                </div>
                                <div class="form-group">
                                    <label for="username">Date Déclaration </label>
                                    <input type="date" class="form-control" placeholder="DATE *" required
                                           name="date_dec" id="date_dec">
                                </div>
                                <div class="form-group">
                                    <label for="username">Date Mariage </label>
                                    <input type="date" class="form-control" placeholder="DATE *" required
                                           name="datem" id="datem">
                                </div>
                                <div class="form-group">
                                    <label for="username">Heure Mariage</label>
                                    <input type="date" class="form-control" name="heurem" id="heurem" placeholder="HEURE *" required>
                                </div>

                                <div class="form-group"  id="num_jugement"  style="visibility: hidden">
                                        <label for="username">Lieu Mariage </label>
                                        <input type="text" class="form-control" placeholder="LIEU *"
                                               name="LIEUM" id="lieum" required>

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <label for="username">Option</label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="option" required>

                                                <option >Monogamie</option>
                                                <option >Polygamie</option>
                                                <option >Polygamie a deux</option>
                                                <option >Polygamie a trois</option>
                                                <option >Polygamie a quatre</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">REGIME</label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="regime" required>

                                                <option >Communaute des biens</option>
                                                <option >Separation des biens</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Type Déclaration</label>
                                            <select  class="form-control pro-edt-select form-control-primary" name="type_dec" required>

                                                <option >NORMALE</option>
                                                <option >TARDIVE</option>

                                            </select>
                                        </div>
                                <div class="form-group">
                                    <label for="username">Dot </label>
                                    <input type="number" class="form-control" placeholder="Dot *" required
                                           name="dot">
                                </div>
                            </div>
                    </section>

                    <section>
                      <center>  <p>Mariés</p></center>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>EPOUX</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Epoux</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_epoux">

                                        <option selected disabled>choose....</option>
                                          @foreach($epoux as $epx)
                                            <option value="{{$epx->id}}">{{$epx->prenom_epoux}} {{$epx->nom_epoux}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                              
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>EPOUSE</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Epouse</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_epouse">

                                        <option selected disabled>choose....</option>
                                        @foreach($epouse as $epse)
                                            <option value="{{$epse->id}}">{{$epse->prenom_epouse}} {{$epse->nom_epouse}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>
                    </section>

                    <section>
                      <center> <p>Temoins</p></center>
                                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin 1</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Temoin1</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t1">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t1)
                                            <option value="{{$t1->id}}">{{$t1->prenom}} {{$t1->nom}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin2</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Temoin2</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t2">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t2)
                                            <option value="{{$t2->id}}">{{$t2->prenom}} {{$t2->nom}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin3</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Temoin3</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t3">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t3)
                                            <option value="{{$t3->id}}">{{$t3->prenom}} {{$t3->nom}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin4</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Temoin4</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_t4">

                                        <option selected disabled>choose....</option>
                                        @foreach($temoin as $t4)
                                            <option value="{{$t4->id}}">{{$t4->prenom}} {{$t4->nom}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                 </div>
                                </div>
                            </div>
                    </section>
                    <section>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center>  <h2>Officier</h2></center>
                        <div class="form-group">
                                    <label for="username">Officier</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="id_officier">

                                        <option selected disabled>choose....</option>
                                        @foreach($officier as $off)
                                            <option value="{{$off->id}}">{{$off->prenom_officier}} {{$off->nom_officier}}</option>
                                        @endforeach
                                    </select>
                          </div>
                    </div>
                    </section>
                    <section>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <center><h5>MENTION MARGINALE</h5></center>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <center>   <textarea name="mention" id="mention" type="text" style="width: 80%;" rows="10">  </textarea></center>
                            </div><br/>
                        </div>
                    </section>

                  <center> <div class=" btn  btn-success" id="prev"> Precedent</div>
                        <div class=" btn  btn-success" id="next">Suivant </div>
                    <div class=" btn btn-success"  id="submit">Modifier</div> </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FIN AFFICHAGE INFO MARIAGE MODIFIABLE PAR OFFICIER-->


@endsection



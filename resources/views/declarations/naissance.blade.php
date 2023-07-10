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
            /*ajout naissance*/
            $('#date_naissance').on('change keyup', function () {
                if (this.value.length === 10) {
                    var debut = Date.parse($('#date_naissance').val());
                    var fin = Date.parse(new Date());
                    var diff = new Date(fin - debut);
                    console.log('diff', diff);
                    var jour = diff / 86400000;
                    if (jour < 45) {
                        $('#normale').prop('checked', true);
                        $('#tardive').prop('checked', false);
                        $('#jugement').prop('checked', false);
                        $('#normale').prop('disabled', false);
                        document.getElementById('date_jugement').style.visibility='hidden';
                        document.getElementById('num_jugement').style.visibility='hidden';
                        document.getElementById('nom_tribunal').style.visibility='hidden';
                    } else if(jour > 360) {
                        $('#normale').prop('checked', false);
                        $('#tardive').prop('checked', false);
                        $('#jugement').prop('checked', true);
                        $('#jugement').prop('disabled', false);
                        document.getElementById('date_jugement').style.visibility='visible';
                        document.getElementById('num_jugement').style.visibility='visible';
                        document.getElementById('nom_tribunal').style.visibility='visible';
                    }
                    else{
                        $('#normale').prop('checked', false);
                        $('#tardive').prop('checked', true);
                        $('#jugement').prop('checked', false);
                        $('#tardive').prop('disabled', false);
                        document.getElementById('date_jugement').style.visibility='hidden';
                        document.getElementById('num_jugement').style.visibility='hidden';
                        document.getElementById('nom_tribunal').style.visibility='hidden';
                    }
                }
            });
            /*modifier naissance*/
            $('#date--naissance').on('change keyup', function () {
                if (this.value.length === 10) {
                    var debut = Date.parse($('#date--naissance').val());
                    var fin = Date.parse(new Date());
                    var diff = new Date(fin - debut);
                    console.log('diff', diff);
                    var jour = diff / 86400000;
                    if (jour < 45) {
                        $('#normal').prop('checked', true);
                        $('#tardiv').prop('checked', false);
                        $('#jugemen').prop('checked', false);
                        $('#normal').prop('disabled', false);
                        document.getElementById('date-jugement').style.visibility='hidden';
                        document.getElementById('num-jugement').style.visibility='hidden';
                        document.getElementById('nom-tribunal').style.visibility='hidden';
                    } else if(jour > 360) {
                        $('#normal').prop('checked', false);
                        $('#tardiv').prop('checked', false);
                        $('#jugemen').prop('checked', true);
                        $('#jugemen').prop('disabled', false);
                        document.getElementById('date-jugement').style.visibility='visible';
                        document.getElementById('num-jugement').style.visibility='visible';
                        document.getElementById('nom-tribunal').style.visibility='visible';
                    }
                    else{
                        $('#normal').prop('checked', false);
                        $('#tardiv').prop('checked', true);
                        $('#jugemen').prop('checked', false);
                        $('#tardiv').prop('disabled', false);
                        document.getElementById('date-jugement').style.visibility='hidden';
                        document.getElementById('num-jugement').style.visibility='hidden';
                        document.getElementById('nom-tribunal').style.visibility='hidden';
                    }
                }
            });
            /*afficher donnees naissance*/
            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('naissance_valide') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'num_registre', name: 'num_registre'},
                    {data: 'nom_enfant', name: 'nom_enfant'},
                    {data: 'prenom_enfant', name: 'prenom_enfant'},
                    {data: 'sexe', name: 'sexe'},
                    {
                        data: 'date_naiss',
                        render: function (data) {
                            var date = new Date(data);
                            var month = date.getMonth() + 1;
                            return (date.getDate().toString().length > 1 ? date.getDate() : "0" + date.getDate()) + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" + date.getFullYear()
                        },
                        name: 'date_naiss'
                    },
                    {data: 'pere.prenom_pere', name: 'pere.prenom_pere'},
                    {data: 'mere.prenom_mere', name: 'mere.prenom_mere'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

            });
            /*impression extrait*/
            $('body').on('click', '.printNaissance', function () {
                var naissance_id = $(this).data('id');
                $.get("{{'volet'}}" + '/' + naissance_id, function (data) {
                    window.location.href = 'volet/' + naissance_id;
                })
            });
            /*Controle saisie*/
            $('#nin_pere').on('change keyup', function () {
                if (this.value.length === 10) {
                    var nin_pere = $(this).val();
                    var url = "{{'naissance'}}" + '/' + nin_pere;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "JSON",
                        success: function (response) {
                            if (response) {
                                $("#id_pere").val(response[0].id);
                                $("#prenom_pere").val(response[0].prenom_pere);
                                $("#nom_pere").val(response[0].nom_pere);
                                $("#datenaissance_pere").val(response[0].date_naissp);
                                $("#lieu_naissance_pere").val(response[0].lieu_naissp);
                                $("#domicile_pere").val(response[0].domicile_pere);
                                $("#profession_pere").val(response[0].profession_pere);
                            }
                        }
                    });
                } else {
                    $("#id_pere").val('');
                    $("#prenom_pere").val('');
                    $("#nom_pere").val('');
                    $("#datenaissance_pere").val('');
                    $("#lieu_naissance_pere").val('');
                    $("#domicile_pere").val('');
                    $("#profession_pere").val('');
                }
            });
            $('#nin_mere').on('change keyup', function () {
                if (this.value.length === 13) {
                    var nin_mere = $(this).val();
                    var url = "{{'naissances'}}" + '/' + nin_mere;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "JSON",
                        success: function (response) {
                            if (response) {
                                $("#id_mere").val(response[0].id);
                                $("#prenom_mere").val(response[0].prenom_mere);
                                $("#nom_mere").val(response[0].nom_mere);
                                $("#datenaissance_mere").val(response[0].date_naissm);
                                $("#lieu_naissance_mere").val(response[0].lieu_naissm);
                                $("#domicile_mere").val(response[0].domicile_mere);
                                $("#profession_mere").val(response[0].profession_mere);
                            }
                        }
                    });
                } else {
                    $("#id_mere").val('');
                    $("#prenom_mere").val('');
                    $("#nom_mere").val('');
                    $("#datenaissance_mere").val('');
                    $("#lieu_naissance_mere").val('');
                    $("#domicile_mere").val('');
                    $("#profession_mere").val('');
                }
            });
            $('#nin_declarant').on('change keyup', function () {
                if (this.value.length === 13) {
                    var nin_declarant = $(this).val();
                    var url = "{{'naissancess'}}" + '/' + nin_declarant;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "JSON",
                        success: function (response) {
                            if (response) {
                                $("#id_declarant").val(response[0].id);
                                $("#prenom_declarant").val(response[0].prenom_declarant);
                                $("#nom_declarant").val(response[0].nom_declarant);
                                $("#datenaissance_declarant").val(response[0].date_naissd);
                                $("#lieu_naissance_declaran").val(response[0].lieu_naissd);
                                $("#domicile_declarant").val(response[0].domicile_declarant);
                                $("#profession_declarant").val(response[0].profession_declarant);
                            }
                        }
                    });
                } else {
                    $("#id_declarant").val('');
                    $("#prenom_declarant").val('');
                    $("#nom_declarant").val('');
                    $("#datenaissance_declarant").val('');
                    $("#lieu_naissance_declaran").val('');
                    $("#domicile_declarant").val('');
                    $("#profession_declarant").val('');
                }
            });
            $('#nin_t1').on('change keyup', function () {
                if (this.value.length === 13) {
                    var nin_t1 = $(this).val();
                    var url = "{{'naissancess'}}" + '/' + nin_t1;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "JSON",
                        success: function (response) {
                            if (response) {
                                $("#id_t1").val(response[0].id);
                                $("#prenom_t1").val(response[0].prenom_);
                                $("#nom_t1").val(response[0].nom_);
                                $("#datenaissance_t1").val(response[0].date_naissance);
                                $("#lieu_naissance_t1").val(response[0].lieu_naissance);
                                $("#domicile_t1").val(response[0].domicile);
                                $("#profession_t1").val(response[0].profession);
                            }
                        }
                    });
                } else {
                    $("#id_t1").val('');
                    $("#prenom_t1").val('');
                    $("#nom_t1").val('');
                    $("#datenaissance_t1").val('');
                    $("#lieu_naissance_t1").val('');
                    $("#domicile_t1").val('');
                    $("#profession_t1").val('');
                }
            });
            $('#nin_t2').on('change keyup', function () {
                if (this.value.length === 13) {
                    var nin_t2 = $(this).val();
                    var url = "{{'naissancess'}}" + '/' + nin_t2;
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "JSON",
                        success: function (response) {
                            if (response) {
                                $("#id_t2").val(response[0].id);
                                $("#prenom_t2").val(response[0].prenom);
                                $("#nom_t2").val(response[0].nom);
                                $("#datenaissance_t2").val(response[0].date_naissance);
                                $("#lieu_naissance_t2").val(response[0].lieu_naissance);
                                $("#domicile_t2").val(response[0].domicile);
                                $("#profession_t2").val(response[0].profession);
                            }
                        }
                    });
                } else {
                    $("#id_t2").val('');
                    $("#prenom_t2").val('');
                    $("#nom_t2").val('');
                    $("#datenaissance_t2").val('');
                    $("#lieu_naissance_t2").val('');
                    $("#domicile_t2").val('');
                    $("#profession_t2").val('');
                }
            });
            /*modifier naissance*/
            $('body').on('click', '.modifier', function (e) {

                var naissance_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editnaiss') }}" + '/' + naissance_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        var date = new Date(data.date_naiss);
                        var month = date.getMonth() + 1;

                        var date_pere = new Date(data.pere.date_naissp);
                        var month_mere = date_pere.getMonth() + 1;

                        var date_mere = new Date(data.mere.date_naissm);
                        var month_pere = date_mere.getMonth() + 1;

                        var date_declarant = new Date(data.declarant.date_naissd);
                        var month_declarant = date_declarant.getMonth() + 1;

                        $('#ajaxModel2').modal('show');
                        $('#naissance_id').val(data.id);
                        $('#num-registre').val(data.num_registre);
                        $('#annee').val(data.annee);
                        $('#nom-enfant').val(data.nom_enfant);
                        $('#prenom-enfant').val(data.prenom_enfant);
                        $('#date--naissance').val((date.getDate().toString().length > 1 ? +date.getFullYear() : "0") + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" + date.getDate());
                        $('#lieu-naissance').val(data.lieu_naiss);
                        $('#heure-naissance').val(data.heure_naiss);
                        $('#formation-sanitaire').val(data.codeforme);
                        if (data.sexe === 'Femme') {
                            $('#feminin').attr('checked', true);
                            $('#masculin').attr('checked', false);

                        } else {
                            $('#feminin').attr('checked', false);
                            $('#masculin').attr('checked', true);

                        }
                        if (data.type_dec === 'NORMALE') {
                            console.log('ok');
                            $('#normal').attr('checked', true);
                            $('#tardiv').attr('checked', false);
                            $('#jugemen').attr('checked', false);
                        } else if (data.type_dec === 'TARDIVE') {
                            console.log('nok');
                            $('#normal').attr('checked', false);
                            $('#tardiv').attr('checked', true);
                            $('#jugemen').attr('checked', false);
                        }
                        else{
                            console.log('merde');
                            $('#normal').attr('checked', false);
                            $('#tardiv').attr('checked', false);
                            $('#jugemen').attr('checked', true);
                        }
                        $('#id-pere').val(data.pere.id);
                        $('#nin-pere').val(data.pere.nin_pere);
                        $('#nom--pere').val(data.pere.nom_pere);
                        $('#prenom--pere').val(data.pere.prenom_pere);
                        $('#datenaissance--pere').val((date_pere.getDate().toString().length > 1 ? +date_pere.getFullYear() : "0") + "-" + (month_pere.toString().length > 1 ? month : "0" + month) + "-" + date_pere.getDate());
                        $('#lieu-naissance_pere').val(data.pere.lieu_naissp);
                        $('#domicile-pere').val(data.pere.domicile_pere);
                        $('#profession-pere').val(data.pere.profession_pere);
                        $('#id-mere').val(data.mere.id);
                        $('#nin-mere').val(data.mere.nin_mere);
                        $('#nom--mere').val(data.mere.nom_mere);
                        $('#prenom--mere').val(data.mere.prenom_mere);
                        $('#datenaissance--mere').val((date_mere.getDate().toString().length > 1 ? +date_mere.getFullYear() : "0") + "-" + (month_mere.toString().length > 1 ? month : "0" + month) + "-" + date_mere.getDate());
                        $('#lieu-naissance_mere').val(data.mere.lieu_naissm);
                        $('#domicile-mere').val(data.mere.domicile_mere);
                        $('#profession-mere').val(data.mere.profession_mere);
                        $('#id-declarant').val(data.declarant.id);
                        $('#nin-declarant').val(data.declarant.nin_declarant);
                        $('#nom--declarant').val(data.declarant.nom_declarant);
                        $('#prenom--declarant').val(data.declarant.prenom_declarant);
                        $('#datenaissance--declarant').val((date_declarant.getDate().toString().length > 1 ? +date_declarant.getFullYear() : "0") + "-" + (month_declarant.toString().length > 1 ? month : "0" + month) + "-" + date_declarant.getDate());
                        $('#lieu-naissance_declarant').val(data.declarant.lieu_naissd);
                        $('#domicile-declarant').val(data.declarant.domicile_declarant);
                        $('#profession-declarant').val(data.declarant.profession_declarant);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*edit naissance*/
            $('body').on('click', '.editNaissance', function (e) {

                var naissance_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editnaiss') }}" + '/' + naissance_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        var date = new Date(data.date_naiss);
                        var month = date.getMonth() + 1;
                        $('#ajaxModel').modal('show');
                        $('#num_registre').val(data.num_registre);
                        $('#nom_enfant').val(data.nom_enfant);
                        $('#prenom_enfant').val(data.prenom_enfant);
                        $('#date-naissance').val((date.getDate().toString().length > 1 ? +date.getFullYear() : "0") + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" + date.getDate());
                        $('#prenom-pere').val(data.pere.prenom_pere);
                        $('#nom-pere').val(data.pere.nom_pere);
                        $('#nom-mere').val(data.mere.nom_mere);
                        $('#prenom-mere').val(data.mere.prenom_mere);
                        $('#nom-declarant').val(data.declarant.nom_declarant);
                        $('#prenom-declarant').val(data.declarant.prenom_declarant);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*enregistrer modification naissance*/
            $('#submit').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#form_naissance').serialize(),
                    url: "{{ route('validations_naissance.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Validation reuissi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#form_naissance').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'echec validaion!',
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
                <h3>Naissances <small>Listes Naissances</small></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Naissances</h2>
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
                                <th>N° Declaration</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Sexe</th>
                                <th>Date Naisssance</th>
                                <th>Prenom Pere</th>
                                <th>Prenom Mere</th>
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
    <!-- AJOUTER NAISSANCE-->
    <div class="modal fade" id="ajaxModel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
            <h2>
                Nouvelle Declaration de Naissance
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
                                      <small>Enfant/Naissance</small>
                                  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-2">
                                    <span class="step_no">2</span>
                                    <span class="step_descr">
                                      Etape 2<br/>
                                      <small>Parents</small>
                                  </span>
                                </a>
                            </li>
                            <li>
                                <a href="#step-3">
                                    <span class="step_no">3</span>
                                    <span class="step_descr">
                                      Etape 3<br/>
                                      <small>Declarant</small>
                                  </span>
                                </a>
                            </li>

                            <li>
                                <a href="#step-4">
                                    <span class="step_no">4</span>
                                    <span class="step_descr">
                                      Etape 4<br/>
                                      <small>Temoins</small>
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
                                    <label for="username">Numero Declaration </label>

                                    <input type="text" required class="form-control" placeholder="Nunero Declaration *"
                                           name="num_registre">
                                </div>
                                <div class="form-group">
                                    <label for="username">Nom </label>
                                    <input type="text" class="form-control" placeholder="Nom *" required
                                           name="nom_enfant">
                                </div>
                                <div class="form-group">
                                    <label for="username">Prenom </label>
                                    <input type="text" class="form-control" placeholder="Prenom *" required
                                           name="prenom_enfant">
                                </div>
                                <div class="form-group">
                                    <label for="username">Date Naissance</label>
                                    <input type="date" class="form-control" name="date_naissance" id="date_naissance">
                                </div>

                                    <div class="form-group"  id="num_jugement"  style="visibility: hidden">
                                        <label for="username">Numero Jugement </label>
                                        <input type="text" class="form-control" placeholder="Numero Jugemnt *"
                                               name="num_jugement">

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Lieu Naissance </label>
                                    <input type="text" class="form-control" placeholder="Lieu Naissance *" required
                                           name="lieu_naissance">
                                </div>
                                <div class="form-group">
                                    <label for="username">Heure </label>
                                    <input type="number" class="form-control" placeholder="Heure *" required
                                           name="heure_naissance">
                                </div>

                                <div class="form-group">
                                    <label for="username">Formation Sanitaire</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="formation_sanitaire">

                                        <option selected disabled>choose....</option>
                                        @foreach($formations as $forma)
                                            <option value="{{$forma->id}}">{{$forma->nom_formation}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                    <div class="form-group"  id="date_jugement" style="visibility: hidden">
                                        <label for="username">Date Jugement</label>
                                        <input type="date" class="form-control" name="date_jugement"
                                              >
                                    </div>

                                    <div class="form-group" id="nom_tribunal"  style="visibility: hidden">
                                        <label for="username">Nom Tribunal</label>
                                        <input type="text" class="form-control" placeholder="Nom Tribunal *"
                                               name="nom_tribunal"  >

                                </div>


                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Sexe</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexe" id="exampleRadios1"
                                               value="Masculin" checked>
                                        Masculin
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexe" id="exampleRadios2"
                                               value="Feminin">
                                        Feminin
                                    </div>

                                </div>
                                <div class="form-group">

                                    <label for="username">TYPE DECLARATION</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_declaration"
                                               id="normale" value="Normale" disabled>
                                        Normale
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_declaration"
                                               id="tardive" value="Tardive" disabled>

                                        Tardive

                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_declaration"
                                               id="jugement" value="jugement" disabled>
                                        Jugement

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-2">


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>PERE</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-control" name="id_pere" id="id_pere">
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Nin " name="nin_pere"
                                                   id="nin_pere" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Nom </label>
                                            <input type="text" class="form-control" placeholder="Nom " name="nom_pere"
                                                   id="nom_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Prenom</label>
                                            <input type="text" class="form-control" placeholder="Prenom "
                                                   name="prenom_pere" id="prenom_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" name="datenaissance_pere"
                                                   id="datenaissance_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Lieu Naissance</label>
                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                                   name="lieu_naissance_pere" id="lieu_naissance_pere">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Domicile</label>
                                            <input type="text" class="form-control" placeholder="DOMICILE "
                                                   name="domicile_pere" id="domicile_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Profession</label>
                                            <input type="text" class="form-control" placeholder="PROFFESSION "
                                                   name="profession_pere" id="profession_pere">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>MERE</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-control" name="id_mere" id="id_mere">
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Nin " name="nin_mere"
                                                   id="nin_mere">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Nom </label>
                                            <input type="text" class="form-control" placeholder="Nom " name="nom_mere"
                                                   id="nom_mere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Prenom</label>
                                            <input type="text" class="form-control" placeholder="Prenom "
                                                   name="prenom_mere" id="prenom_mere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" name="datenaissance_mere"
                                                   id="datenaissance_mere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Lieu Naissance</label>
                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                                   name="lieu_naissance_mere" id="lieu_naissance_mere">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Domicile</label>
                                            <input type="text" class="form-control" placeholder="DOMICILE "
                                                   name="domicile_mere" id="domicile_mere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Profession</label>
                                            <input type="text" class="form-control" placeholder="PROFFESSION "
                                                   name="profession_mere" id="profession_mere">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div id="step-3">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                                <div class="row">
                                    <div class="col-md-12">
                                        <center><h5>DECLARANT</h5></center>
                                        <input type="hidden" class="form-control" name="id_declarant" id="id_declarant">
                                        <div class="form-group">
                                            <label for="username">Nin</label>
                                            <input type="text" class="form-control" placeholder="Nin *"
                                                   name="nin_declarant" id="nin_declarant">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Nom </label>
                                            <input type="text" class="form-control" placeholder="Nom *"
                                                   name="nom_declarant" id="nom_declarant">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Prenom</label>
                                            <input type="text" class="form-control" placeholder="Prenom *"
                                                   name="prenom_declarant" id="prenom_declarant">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" name="datenaissance_declarant"
                                                   id="datenaissance_declarant">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Lieu Naissance</label>
                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE *"
                                                   name="lieu_naissance_declarant" id="lieu_naissance_declarant">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Domicile</label>
                                            <input type="text" class="form-control" placeholder="DOMICILE *"
                                                   name="domicile_declarant" id="domicile_declarant">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Profession</label>
                                            <input type="text" class="form-control" placeholder="PROFFESSION *"
                                                   name="profession_declarant" id="profession_declarant">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div id="step-4" >

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin 1</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-control" name="id_t1" id="id_t1">
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Nin " name="nin_t1"
                                                   id="nin_t1" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Nom </label>
                                            <input type="text" class="form-control" placeholder="Nom " name="nom_t1"
                                                   id="nom_t1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Prenom</label>
                                            <input type="text" class="form-control" placeholder="Prenom "
                                                   name="prenom_t1" id="prenom_t1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" name="datenaissance_t1"
                                                   id="datenaissance_t1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Lieu Naissance</label>
                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                                   name="lieu_naissance_t1" id="lieu_naissance_t1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Domicile</label>
                                            <input type="text" class="form-control" placeholder="DOMICILE "
                                                   name="domicile_t1" id="domicile_t1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Profession</label>
                                            <input type="text" class="form-control" placeholder="PROFFESSION "
                                                   name="profession_t1" id="profession_t1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin2</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-control" name="id_t2" id="id_t2">
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Nin " name="nin_t2"
                                                   id="nin_t2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Nom </label>
                                            <input type="text" class="form-control" placeholder="Nom " name="nom_t2"
                                                   id="nom_t2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Prenom</label>
                                            <input type="text" class="form-control" placeholder="Prenom "
                                                   name="prenom_t2" id="prenom_t2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" name="datenaissance_t2"
                                                   id="datenaissance_t2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Lieu Naissance</label>
                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                                   name="lieu_naissance_t2" id="lieu_naissance_t2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Domicile</label>
                                            <input type="text" class="form-control" placeholder="DOMICILE "
                                                   name="domicile_t2" id="domicile_t2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Profession</label>
                                            <input type="text" class="form-control" placeholder="PROFFESSION "
                                                   name="profession_t2" id="profession_t2">
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
    <!-- FIN AJOUTER NAISSANCE-->
    <!-- AFFICHEZ INFO NAISSANCE NON MODIFIABLE-->
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
                    <h1>DETAILS</h1>

                        <div class="row">
                                <center> <h2>Enfants</h2></center>
                                <input type="hidden" class="form-control" name="naissance_id" id="naissance_id" disabled>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Numero Declaration </label>

                                    <input type="text" required class="form-control" placeholder="Nunero Registre *"
                                           name="num_registre" id="num_registre"  disabled>
                                </div>
                            </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Nom </label>

                                    <input type="text" required class="form-control" placeholder="Nunero Registre *"
                                           name="num_registre" id="nom_enfant"  disabled>
                                </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Prenom </label>
                                    <input type="text" class="form-control" placeholder="Prenom *" required
                                           name="prenom_enfant" id="prenom_enfant"  disabled>
                                </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Date Naissance</label>
                                    <input class="form-control"  name="date_naissance" id="date-naissance"  disabled>
                                </div>
                                </div>
                            </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center> <h2>Pere</h2></center>
                        <div class="form-group">
                            <label for="username">nom</label>
                            <input type="text" class="form-control" placeholder="Prenom " name="nom_pere"
                                   id="nom-pere"  disabled>
                        </div>

                        <div class="form-group">
                            <label for="username">Prenom</label>
                            <input type="text" class="form-control" placeholder="Prenom " name="prenom_pere"
                                   id="prenom-pere"  disabled>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center> <h2>Mere</h2></center>
                        <div class="form-group">
                            <label for="username">Nom </label>
                            <input type="text" class="form-control" placeholder="Nom " name="nom-mere"
                                   id="nom-mere"  disabled>
                        </div>
                        <div class="form-group">
                            <label for="username">Prenom</label>
                            <input type="text" class="form-control" placeholder="Prenom " name="prenom-mere"
                                   id="prenom-mere"  disabled>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center>     <h2>Declarant</h2></center>
                        <div class="form-group">
                            <label for="username">Nom </label>
                            <input type="text" class="form-control" placeholder="Nom *" name="nom_declarant"
                                   id="nom-declarant"  disabled>
                        </div>
                        <div class="form-group">
                            <label for="username">Prenom</label>
                            <input type="text" class="form-control" placeholder="Prenom *"
                                   name="prenom_declarant" id="prenom-declarant"  disabled>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <center>  <h2>Jugement</h2></center>
                        <div class="form-group">
                            <label for="username">Numero Jugement </label>
                            <input type="text" required class="form-control"
                                   name="num_registre" id="num-jugement"  disabled>
                        </div>
                        <div class="form-group">
                            <label for="username">Date Jugement </label>

                            <input type="text" required class="form-control"
                                   name="num_registre" id="date_jugement"  disabled>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
    <!-- FIN AFFICHAGE INFO NAISSANCE NON MODIFIABLE-->
    <!-- AFFICHEZ INFO NAISSANCE MODIFIABLE PAR OFFICIER-->
    <div class="modal fade" id="ajaxModel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="svg_wrap"></div>

                  <center>  <h1>Modification</h1></center>
                    <form class="form-horizontal form-label-left" id="form_naissance">
                        @csrf

                    <section>
                      <center>  <p>Enfant</p></center>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <input type="hidden" class="form-control" name="naissance_id" id="naissance_id">
                            <div class="form-group">
                                <label for="username">Numero Declaration </label>
                                <input type="text" required class="form-control" placeholder="Nunero Declaration *"
                                       name="num-registre" id="num-registre">
                            </div>
                            <div class="form-group">
                                <label for="username">Nom </label>
                                <input type="text" class="form-control" placeholder="Nom *" required
                                       name="nom_enfant" id="nom-enfant">
                            </div>
                            <div class="form-group">
                                <label for="username">Prenom </label>
                                <input type="text" class="form-control" placeholder="Prenom *" required
                                       name="prenom_enfant" id="prenom-enfant">
                            </div>
                            <div class="form-group">
                                <label for="username">Date Naissance</label>
                                <input  class="form-control" name="date_naissance" id="date--naissance">
                            </div>

                            <div class="form-group"  id="num_jugement"  style="visibility: hidden">
                                <label for="username">Numero Jugement </label>
                                <input type="text" class="form-control" placeholder="Numero Jugemnt *"
                                       name="num_jugement" id="num-jugement">

                            </div>
                            <div class="form-group" id="nom_tribunal"  style="visibility: hidden">
                                <label for="username">Nom Tribunal</label>
                                <input type="text" class="form-control" placeholder="Nom Tribunal *"
                                       name="nom_tribunal" id="nom-tribunal"  >

                            </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label for="username">Annee </label>
                                <input type="text" required class="form-control"
                                       name="annee" id="annee" disabled>
                            </div>
                            <div class="form-group">
                                <label for="username">Lieu Naissance </label>
                                <input type="text" class="form-control" placeholder="Lieu Naissance *" required
                                       name="lieu_naissance" id="lieu-naissance">
                            </div>
                            <div class="form-group">
                                <label for="username">Heure </label>
                                <input type="number" class="form-control" placeholder="Heure *" required
                                       name="heure_naissance" id="heure-naissance">
                            </div>

                            <div class="form-group">
                                <label for="username">Formation Sanitaire</label>
                                <select class="form-control pro-edt-select form-control-primary" required
                                        name="formation_sanitaire" id="formation-sanitaire" >

                                    <option selected disabled>choose....</option>
                                    @foreach($formations as $forma)
                                        <option value="{{$forma->id}}">{{$forma->nom_formation}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group"  id="date_jugement" style="visibility: hidden">
                                <label for="username">Date Jugement</label>
                                <input type="date" class="form-control" name="date_jugement" id="date-jugement"
                                >
                            </div>




                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                               <center> <label for="username">Sexe</label></center>
                                <div class="form-check">
                                 <center>   Masculin<input class="form-check-input" type="radio" name="sexe" id="masculin"
                                           value="Masculin" >
                                   </center>
                                </div>
                                <div class="form-check">
                                  <center>    Feminin<input class="form-check-input" type="radio" name="sexe" id="feminin"
                                           value="Feminin">
                                  </center>
                                </div>

                            </div>
                            <div class="form-group">
                               <center> <label for="username">TYPE DECLARATION</label></center>
                                <div class="form-check">
                                    <center>   Normale  <input class="form-check-input" type="radio" name="type_declaration"
                                                        id="normal" value="Normale" >  </center>
                                </div>
                                <div class="form-check">
                                <center> Tardive <input class="form-check-input" type="radio" name="type_declaration"
                                           id="tardiv" value="Tardive" >  </center>
                                </div>
                                <div class="form-check">
                                 <center>Jugement <input class="form-check-input" type="radio" name="type_declaration"
                                           id="jugemen" value="jugement" > </center>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                      <center>  <p>Parents</p></center>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <center><h5>PERE</h5></center>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" class="form-control"  id="id-pere" name="id_pere">
                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="Nin "
                                               id="nin-pere" name="nin_pere">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Nom </label>
                                        <input type="text" class="form-control" placeholder="Nom "
                                               id="nom--pere" name="nom_pere">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Prenom</label>
                                        <input type="text" class="form-control" placeholder="Prenom "
                                               id="prenom--pere" name="prenon_pere">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Date Naissance</label>
                                        <input  class="form-control"
                                               id="datenaissance--pere" name="datenaissance_pere">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Lieu Naissance</label>
                                        <input type="text" class="form-control" placeholder="LIEU NAISSANCE " name="lieu_naissance_pere" id="lieu-naissance_pere">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Domicile</label>
                                        <input type="text" class="form-control" placeholder="DOMICILE " id="domicile-pere" name="domicile_pere">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Profession</label>
                                        <input type="text" class="form-control" placeholder="PROFFESSION "
                                               id="profession-pere" name="profession_pere">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <center><h5>MERE</h5></center>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" class="form-control" name="id_mere" id="id_mere">
                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="Nin "
                                               id="nin-mere" name="nin_mere">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Nom </label>
                                        <input type="text" class="form-control" placeholder="Nom "
                                               id="nom--mere" name="nom_mere">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Prenom</label>
                                        <input type="text" class="form-control" placeholder="Prenom "
                                               id="prenom--mere" name="prenon_pere">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Date Naissance</label>
                                        <input  class="form-control"
                                               id="datenaissance--mere" name="datenaissance_mere">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Lieu Naissance</label>
                                        <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                                 id="lieu-naissance_mere" name="lieu_naissance_mere">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Domicile</label>
                                        <input type="text" class="form-control" placeholder="DOMICILE "
                                               id="domicile-mere" name="domicile_mere">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Profession</label>
                                        <input type="text" class="form-control" placeholder="PROFFESSION "
                                               id="profession-mere" name="profession_mere">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section>
                       <center> <p>Declarant</p></center>
                        <div class="col-md-12">
                            <input type="hidden" class="form-control" name="id_declarant" id="id_declarant">
                            <div class="form-group">
                                <label for="username">Nin</label>
                                <input type="text" class="form-control" placeholder="Nin *"
                                       name="nin_declarant" id="nin-declarant">
                            </div>
                        </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Nom </label>
                            <input type="text" class="form-control" placeholder="Nom *"
                                   name="nom_declarant" id="nom--declarant">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Prenom</label>
                            <input type="text" class="form-control" placeholder="Prenom *"
                                   name="prenom_declarant" id="prenom--declarant">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Date Naissance</label>
                            <input  class="form-control" name="datenaissance_declarant"
                                   id="datenaissance--declarant">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Lieu Naissance</label>
                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE *"
                                   name="lieu_naissance_declarant" id="lieu-naissance_declarant">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Domicile</label>
                            <input type="text" class="form-control" placeholder="DOMICILE *"
                                   name="domicile_declarant" id="domicile-declarant">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Profession</label>
                            <input type="text" class="form-control" placeholder="PROFFESSION *"
                                   name="profession_declarant" id="profession-declarant">
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

                                        <input type="text" class="form-control" placeholder="Nin "
                                               id="nin-t1" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Nom </label>
                                        <input type="text" class="form-control" placeholder="Nom "
                                               id="nom-t1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Prenom</label>
                                        <input type="text" class="form-control"
                                               id="prenom-t1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Date Naissance</label>
                                        <input type="date" class="form-control"
                                               id="datenaissance-t1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Lieu Naissance</label>
                                        <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                               id="lieu-naissance_t1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Domicile</label>
                                        <input type="text" class="form-control" placeholder="DOMICILE "
                                               id="domicile-t1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Profession</label>
                                        <input type="text" class="form-control" placeholder="PROFFESSION "
                                                id="profession-t1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <center><h5>Temoin2</h5></center>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <input type="text" class="form-control" placeholder="Nin "
                                               id="nin-t2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Nom </label>
                                        <input type="text" class="form-control" placeholder="Nom "
                                               id="nom-t2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Prenom</label>
                                        <input type="text" class="form-control" placeholder="Prenom "
                                             id="prenom-t2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Date Naissance</label>
                                        <input type="date" class="form-control"
                                               id="datenaissance-t2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Lieu Naissance</label>
                                        <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                               id="lieu-naissance_t2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Domicile</label>
                                        <input type="text" class="form-control" placeholder="DOMICILE "
                                               id="domicile-t2">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Profession</label>
                                        <input type="text" class="form-control" placeholder="PROFFESSION "
                                               id="profession-t2">
                                    </div>
                                </div>
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

    <!-- FIN AFFICHAGE INFO NAISSANCE MODIFIABLE PAR OFFICIER-->


@endsection



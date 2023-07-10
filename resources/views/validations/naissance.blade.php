@section('head')
    <!-- iCheck -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ url('assets/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">


@endsection

@extends('layouts.master', ['title' => $title])

@section('foot')

    <!-- iCheck -->
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
    <script src="{{ url('assets/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ url('assets/gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <script src="/js/script.js"></script>

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

                    <div class="x_content">


                        <!-- start project list -->
                        <table class="table table-striped projects data-table">
                            <thead>
                            <tr>
                                <th style="width: 20%"></th>
                                <th>N° Registre</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Sexe</th>
                                <th>Date Naisssance</th>
                                <th>Lieu Naisssance</th>
                                <th>Heure Naisssance</th>
                                <th>Prenom Pere</th>
                                <th>Prenom Mere</th>
                                <th>Prenom Declarant</th>
                                <th style="width: 20%">Actions</th>
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
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>
                        Verification Declaration de Naissance
                        <span id="btnClose" class="btnClose">&times;</span>
                    </h2>
                </div>

                <form class="form-horizontal form-label-left" id="form_naissance">
                    <input type="hidden" id="naissance_id" name="naissance_id" value="">
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <li>
                                <a href="#step-1">
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

                        </ul>

                        <div id="step-1">

                            <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="username">Numero Registre </label>
                                        <input type="text" required class="form-control" value=""
                                               placeholder="Num_registre *" id="num_registre" name="num_registre">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label for="username">Annee </label>

                                        <input type="number" required class="form-control" placeholder="Annee *"
                                               name="annee" id="annee">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                                <div class="form-group">
                                    <label for="username">Nom </label>
                                    <input type="text" class="form-control" id="nom_enfant" placeholder="Nom *" required
                                           name="nom_enfant">
                                </div>
                                <div class="form-group">
                                    <label for="username">Prenom </label>
                                    <input type="text" class="form-control" id="prenom_enfant" placeholder="Prenom *"
                                           required name="prenom_enfant">
                                </div>
                                <div class="form-group">
                                    <label for="username">Date Naissance</label>
                                    <input type="date" class="form-control" id="date_naissance" name="date_naissance">
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Lieu Naissance </label>
                                    <input type="text" class="form-control" placeholder="Lieu Naissance *" required
                                           name="lieu_naissance" id="lieu_naissance">
                                </div>
                                <div class="form-group">
                                    <label for="username">Heure </label>
                                    <input type="number" class="form-control" placeholder="Heure *" required
                                           name="heure_naissance" id="heure_naissance">
                                </div>

                                <div class="form-group">
                                    <label for="username">Formation Sanitaire</label>
                                    <select class="form-control pro-edt-select form-control-primary" required
                                            name="formation_sanitaire" id="formation_sanitaire">

                                        <option selected disabled>choose....</option>
                                        @foreach($formations as $forma)
                                            <option value="{{$forma->id}}">{{$forma->nom_formation}}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                                <div class="form-group">
                                    <label for="username">Sexe</label>
                                    <br>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexe" id="sexe" value="Homme"
                                               checked>
                                        Homme
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexe" id="sexe"
                                               value="Femme">
                                        Femme
                                    </div>

                                </div>
                                <div class="form-group">

                                    <label for="username">TYPE DECLARATION</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_declaration"
                                               id="type_declaration" value="Normal" checked>

                                        Normal
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_declaration"
                                               id="type_declaration" value="Tardive">

                                        Tardive

                                    </div>

                                </div>


                            </div>


                        </div>
                        <div id="step-2">


                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>PERE</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Nin " name="nin_pere"
                                                   id="nin_pere">
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
                                                   name="lieu_naissance_declarant" id="lieu_naissance_declaran">
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
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                        </button>
                    </div>
                </form>



            <!-- End SmartWizard Content -->

        </div>
    </div>
    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


<script type="text/javascript">
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('validations_naissance.index') }}",
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
                {data: 'lieu_naiss', name: 'lieu_naissance'},
                {data: 'heure_naiss', name: 'heure_naissance'},
                {data: 'pere.prenom_pere', name: 'pere.prenom_pere'},
                {data: 'mere.prenom_mere', name: 'mere.prenom_mere'},
                {data: 'declarant.prenom_declarant', name: 'declarant.prenom_declarant'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });


        $('body').on('click', '.editNaissance', function () {
            var naissance_id = $(this).data('id');
            $.get("{{ route('validations_naissance.index') }}" + '/' + naissance_id + '/edit', function (data) {
                $('#modelHeading').html("Edit Product");
                $('#ajaxModel').modal('show');
                $('#naissance_id').val(data.id);
                $('#num_registre').val(data.num_registre);
                $('#annee').val(data.annee);
                $('#nom_enfant').val(data.nom_enfant);
                $('#prenom_enfant').val(data.prenom_enfant);
                $('#date_naissance').val(data.date_naiss);
                $('#lieu_naissance').val(data.lieu_naiss);
                $('#heure_naissance').val(data.heure_naiss);
                $('#formation_sanitaire').val(data.codeforme);
                $('#sexe').val(data.sexe);
                $('#type_declaration').val(data.type_dec);
                $('#nin_pere').val(data.pere.nin_pere);
                $('#nom_pere').val(data.pere.nom_pere);
                $('#prenom_pere').val(data.pere.prenom_pere);
                $('#datenaissance_pere').val(data.pere.date_naissp);
                $('#lieu_naissance_pere').val(data.pere.lieu_naissp);
                $('#domicile_pere').val(data.pere.domicile_pere);
                $('#profession_pere').val(data.pere.profession_pere);
                $('#nin_mere').val(data.mere.nin_mere);
                $('#nom_mere').val(data.mere.nom_mere);
                $('#prenom_mere').val(data.mere.prenom_mere);
                $('#datenaissance_mere').val(data.mere.date_naissm);
                $('#lieu_naissance_mere').val(data.mere.lieu_naissm);
                $('#domicile_mere').val(data.mere.domicile_mere);
                $('#profession_mere').val(data.mere.profession_mere);
                $('#nin_declarant').val(data.declarant.nin_declarant);
                $('#nom_declarant').val(data.declarant.nom_declarant);
                $('#prenom_declarant').val(data.declarant.prenom_declarant);
                $('#datenaissance_declarant').val(data.declarant.date_naissd);
                $('#lieu_naissance_declaran').val(data.declarant.lieu_naissd);
                $('#domicile_declarant').val(data.declarant.domicile_declarant);
                $('#profession_declarant').val(data.declarant.profession_declarant);

            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
                data: $('#form_naissance').serialize(),
                url: "{{ route('validations_naissance.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#form_naissance').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });


    });
</script>


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
    <script>
    </script>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /*afficher donnees naissance*/

            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('impression_extrait_naissance.index') }}",
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
                            return (date.getDate().toString().length > 1 ? date.getDate() : "0" + date.getDate()) + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" + date.getFullYear()
                        },
                        name: 'date_naiss'
                    },
                    {data: 'pere.prenom_pere', name: 'pere.prenom_pere'},
                    {data: 'mere.prenom_mere', name: 'mere.prenom_mere'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            /*impression extrait*/
            $('body').on('click', '.printNaissance', function () {
                var naissance_id = $(this).data('id');
                $.get("{{'impressions'}}" + '/' + naissance_id, function (data) {
                    window.location.href = 'impressions/' + naissance_id;
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

            });


    </script>

@endsection

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3></h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Validations <small>Naissances</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

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
                </div>
            </div>
        </div>
    </div>

    <!-- AFFICHEZ INFO NAISSANCE NON MODIFIABLE-->
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
                <h1>DETAILS</h1>

                <div class="row">
                    <center> <h2>Enfants</h2></center>
                    <input type="hidden" class="form-control" name="naissance_id" id="naissance_id" >
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


    <!-- FIN AFFICHAGE INFO NAISSANCE MODIFIABLE PAR OFFICIER-->


@endsection



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
            /*ajout epouse*/
          
            /*modifier epouse*/
          
            /*afficher donnees Epouse*/
            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('epouse_valide') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nin_epouse', name: 'nin_epouse'},
                    {data: 'nom_epouse', name: 'nom_epouse'},
                    {data: 'prenom_epouse', name: 'prenom_epouse'},
                    {
                        data: 'date_naiss_epouse',
                        render: function (data) {
                            var date = new Date(data);
                            var month = date.getMonth() + 1;
                            return (date.getDate().toString().length > 1 ? date.getDate() : "0" + date.getDate()) + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" + date.getFullYear()
                        },
                        name: 'date_naiss_epouse'
                    },
                  
                    {data: 'lieu_naiss_epouse', name: 'lieu_naiss_epouse'},
                    {data: 'domicile_epouse', name: 'domicile_epouse'},
                    {data: 'profession_epouse', name: 'profession_epouse'},
                    {data: 'situation_mat_epouse', name: 'situation_mat_epouse'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

            });
           
            /*modifier epouse*/
            $('body').on('click', '.modifier', function (e) {

                var epouse_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editEpouse') }}" + '/' + epouse_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {

                        var date_epouse = new Date(data.epouse.date_naiss_epouse);
                        var month_epouse = date_epouse.getMonth() + 1;


                        $('#ajaxModel2').modal('show');
                        $('#id_epouse').val(data.id);
                        $('#nin_epouse').val(data.nin_epouse);
                        $('#nom_epouse').val(data.nom_epouse);
                        $('#prenom_epouse').val(data.prenom_epouse);
                        $('#date_naiss_epouse').val((date_epouse.getDate().toString().length > 1 ? +date_epouse.getFullYear() : "0") + "_" + (month_epouse.toString().length > 1 ? month : "0" + month) + "-" + date_epouse.getDate());
                        $('#lieu_naiss_epouse').val(data.lieu_naiss_epouse);
                        $('#domicile_epouse').val(data.domicile_epouse);
                        $('#profession_epouse').val(data.profession_epouse);
                        $('#situation_mat_epouse').val(data.situation_mat_epouse);
                       
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*edit epouse*/
            $('body').on('click', '.editEpouse', function (e) {

                var epouse_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editEpouse') }}" + '/' + epouse_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        var date_epouse = new Date(data.epouse.date_naiss_epouse);
                        var month_epouse = date_epouse.getMonth() + 1;
                        $('#ajaxModel2').modal('show');
                        $('#id_epouse').val(data.id);
                        $('#nin_epouse').val(data.nin_epouse);
                        $('#nom_epouse').val(data.nom_epouse);
                        $('#prenom_epouse').val(data.prenom_epouse);
                        $('#date_naiss_epouse').val((date_epouse.getDate().toString().length > 1 ? +date_epouse.getFullYear() : "0") + "_" + (month_epouse.toString().length > 1 ? month : "0" + month) + "-" + date_epouse.getDate());
                        $('#lieu_naiss_epouse').val(data.lieu_naiss_epouse);
                        $('#domicile_epouse').val(data.domicile_epouse);
                        $('#profession_epouse').val(data.profession_epouse);
                        $('#situation_mat_epouse').val(data.situation_mat_epouse);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*enregistrer modification epouse*/
            $('#submit').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#form_epouse').serialize(),
                    url: "{{ route('validations_epouse.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Validation reuissi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#form_epouse').trigger("reset");
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
                <h3>Epouses <small>Listes Epouse</small></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Epouses</h2>
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
                                <th>NIN</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Date Naisssance</th>
                                <th>lieu Naissance</th>
                                <th>Domicile</th>
                                <th>Profession</th>
                                <th>Situation Matrimoniale</th>
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
    <!-- AJOUTER EPOUSE-->
    <div class="modal fade" id="ajaxModel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
            <h2>
                Nouvelle Declaration de Epouse
                <span id="btnClose" class="btnClose">&times;</span>
            </h2>

                <form class="form-horizontal form-label-left" method="POST" action="/ajoutEpouse">
                    @csrf
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <li>
                                <a href="#step" >
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                      Etape 1<br/>
                                      <small>Epouse</small>
                                  </span>
                                </a>
                            </li>   
                        </ul>
                        <div id="step">
                            <div class="row">



                             </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                            <label for="nin_epouse">NIN</label>

                            <input type="text" class="form-control" placeholder="NIN" name="nin_epouse">
                            </div>
                            <div class="form-group">
                            <label for="nom_epouse">Nom</label>

                            <input type="text" class="form-control" placeholder="NOM" name="nom_epouse">
                            </div>
                            <div class="form-group">
                            <label for="prenom_epouse">Prenom</label>

                            <input type="text" class="form-control" placeholder="PRENOM" name="prenom_epouse">
                            </div>
                            <div class="form-group">
                            <label for="date_naiss_epouse">Date Naissance</label>
                            <input type="date" class="form-control" name="date_naiss_epouse" >
                            </div>
                            <div class="form-group">
                            <label for="lieu_naiss_epouse">Lieu Naissance</label>

                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" name="lieu_naiss_epouse" >
                            </div>
                            <div class="form-group">
                            <label for="domicile_epouse">Domicile</label>

                            <input type="text" class="form-control" placeholder="DOMICILE" name="domicile_epouse">
                            </div>
                            <div class="form-group">
                            <label for="profession_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="PROFFESSION" name="profession_epouse">
                            </div>
                            <div class="form-group">
                            <label for="situation_mat_epouse">Situation Matrimoniale </label>

                            <input type="text" class="form-control" placeholder="Situation Matrimoniale" name="situation_mat_epouse">
                            </div>

                            </div>
                           
                        </div>
                                </div>
                </form>
            <!-- End SmartWizard Content -->
        </div>
    </div>
    </div>
    <!-- FIN AJOUTER EPOUSE-->
    <!-- AFFICHEZ INFO EPOUSE NON MODIFIABLE-->
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
                    <h1>DETAILS</h1>

                        <div class="row">
                                <center> <h2>Epouse</h2></center>
                                <input type="hidden" class="form-control" name="epouse_id" id="epouse_id" disabled>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                            <label for="nin_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="NIN" name="nin_epouse">
                            </div>
                            <div class="form-group">
                            <label for="nom_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="NOM" name="nom_epouse">
                            </div>
                            <div class="form-group">
                            <label for="prenom_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="PRENOM" name="prenom_epouse">
                            </div>
                            <div class="form-group">
                            <label for="date_naiss_epouse">Date Naissance</label>
                            <input type="date" class="form-control" name="date_naiss_epouse" >
                            </div>
                            <div class="form-group">
                            <label for="lieu_naiss_epouse">Lieu Naissance</label>

                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" name="lieu_naiss_epouse" >
                            </div>
                            <div class="form-group">
                            <label for="domicile_epouse">Domicile</label>

                            <input type="text" class="form-control" placeholder="DOMICILE" name="domicile_epouse">
                            </div>
                            <div class="form-group">
                            <label for="profession_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="PROFFESSION" name="profession_epouse">
                            </div>
                            <div class="form-group">
                            <label for="situation_mat_epouse">Situation Matrimoniale </label>

                            <input type="text" class="form-control" placeholder="Situation Matrimoniale" name="situation_mat_epouse">
                            </div>

                            </div>
                            </div>
                </div>
                </div>
            </div>
    <!-- FIN AFFICHAGE INFO EPOUSE NON MODIFIABLE-->
    <!-- AFFICHEZ INFO EPOUSE MODIFIABLE PAR OFFICIER-->
    <div class="modal fade" id="ajaxModel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="svg_wrap"></div>

                  <center>  <h1>Modification</h1></center>
                    <form class="form-horizontal form-label-left" id="form_epouse">
                        @csrf

                    <section>
                      <center>  <p>Epouse</p></center>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                            <label for="nin_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="NIN" name="nin_epouse">
                            </div>
                            <div class="form-group">
                            <label for="nom_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="NOM" name="nom_epouse">
                            </div>
                            <div class="form-group">
                            <label for="prenom_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="PRENOM" name="prenom_epouse">
                            </div>
                            <div class="form-group">
                            <label for="date_naiss_epouse">Date Naissance</label>
                            <input type="date" class="form-control" name="date_naiss_epouse" >
                            </div>
                            <div class="form-group">
                            <label for="lieu_naiss_epouse">Lieu Naissance</label>

                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" name="lieu_naiss_epouse" >
                            </div>
                            <div class="form-group">
                            <label for="domicile_epouse">Domicile</label>

                            <input type="text" class="form-control" placeholder="DOMICILE" name="domicile_epouse">
                            </div>
                            <div class="form-group">
                            <label for="profession_epouse">Profession</label>

                            <input type="text" class="form-control" placeholder="PROFFESSION" name="profession_epouse">
                            </div>
                            <div class="form-group">
                            <label for="situation_mat_epouse">Situation Matrimoniale </label>

                            <input type="text" class="form-control" placeholder="Situation Matrimoniale" name="situation_mat_epouse">
                            </div>

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

    <!-- FIN AFFICHAGE INFO EPOUSE MODIFIABLE PAR OFFICIER-->


@endsection



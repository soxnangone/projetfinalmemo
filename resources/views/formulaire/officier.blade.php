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
            /*ajout officier*/
          
            /*modifier officier*/
          
            /*afficher donnees Officier*/
            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('officier_valide') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nom_officier', name: 'nom_officier'},
                    {data: 'prenom_officier', name: 'prenom_officier'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

            });
           
            /*modifier officier*/
            $('body').on('click', '.modifier', function (e) {

                var officier_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editOfficier') }}" + '/' + officier_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {

                        var date_officier = new Date(data.officier.date_naiss_officier);
                        var month_officier = date_officier.getMonth() + 1;


                        $('#ajaxModel2').modal('show');
                        $('#id_officier').val(data.id);
                        $('#nom_officier').val(data.nom_officier);
                        $('#prenom_officier').val(data.prenom_officier);
            
                       
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*edit officier*/
            $('body').on('click', '.editOfficier', function (e) {

                var officier_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editOfficier') }}" + '/' + officier_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        var date_officier = new Date(data.officier.date_naiss_officier);
                        var month_officier = date_officier.getMonth() + 1;
                        $('#ajaxModel2').modal('show');
                        $('#id_officier').val(data.id);
                        $('#nom_officier').val(data.nom_officier);
                        $('#prenom_officier').val(data.prenom_officier);
                    
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*enregistrer modification officier*/
            $('#submit').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#form_officier').serialize(),
                    url: "{{ route('validations_officier.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Validation reuissi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#form_officier').trigger("reset");
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
                <h3>Officiers <small>Listes Officier</small></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Officiers</h2>
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
                                <th>Nom</th>
                                <th>Prenom</th>
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
    <!-- AJOUTER OFFICIER-->
    <div class="modal fade" id="ajaxModel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
            <h2>
                Nouvelle Declaration de Officier
                <span id="btnClose" class="btnClose">&times;</span>
            </h2>

                <form class="form-horizontal form-label-left" method="POST" action="/ajoutOfficier">
                    @csrf
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <li>
                                <a href="#step" >
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                      Etape 1<br/>
                                      <small>Officier</small>
                                  </span>
                                </a>
                            </li>
                        </ul>
                        <div id="step">
                            <div class="row">



                             </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                            <label for="nom_officier">Nom</label>

                            <input type="text" class="form-control" placeholder="NOM" name="nom_officier">
                            </div>
                            <div class="form-group">
                            <label for="prenom_officier">Prénom</label>

                            <input type="text" class="form-control" placeholder="PRENOM" name="prenom_officier">
                            </div>
                            

                            </div>
                           
                        </div>
                                </div>
                </form>
            <!-- End SmartWizard Content -->
        </div>
    </div>
    </div>
    <!-- FIN AJOUTER OFFICIER-->
    <!-- AFFICHEZ INFO OFFICIER NON MODIFIABLE-->
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
                    <h1>DETAILS</h1>

                        <div class="row">
                                <center> <h2>Officier</h2></center>
                                <input type="hidden" class="form-control" name="officier_id" id="officier_id" disabled>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        
                            <div class="form-group">
                            <label for="nom_officier">Nom</label>

                            <input type="text" class="form-control" placeholder="NOM" name="nom_officier">
                            </div>
                            <div class="form-group">
                            <label for="prenom_officier">Prénom</label>

                            <input type="text" class="form-control" placeholder="PRENOM" name="prenom_officier">
                            </div>

                            </div>
                            </div>
                </div>
                </div>
            </div>
    <!-- FIN AFFICHAGE INFO OFFICIER NON MODIFIABLE-->
    <!-- AFFICHEZ INFO OFFICIER MODIFIABLE PAR OFFICIER-->
    <div class="modal fade" id="ajaxModel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="svg_wrap"></div>

                  <center>  <h1>Modification</h1></center>
                    <form class="form-horizontal form-label-left" id="form_officier">
                        @csrf

                    <section>
                      <center>  <p>Officier</p></center>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                           
                            <div class="form-group">
                            <label for="nom_officier">Nom</label>

                            <input type="text" class="form-control" placeholder="NOM" name="nom_officier">
                            </div>
                            <div class="form-group">
                            <label for="prenom_officier">Prénom</label>

                            <input type="text" class="form-control" placeholder="PRENOM" name="prenom_officier">
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

    <!-- FIN AFFICHAGE INFO OFFICIER MODIFIABLE PAR OFFICIER-->


@endsection



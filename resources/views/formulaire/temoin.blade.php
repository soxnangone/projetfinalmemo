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
            /*ajout temoin*/
          
            /*modifier temoin*/
          
            /*afficher donnees Temoin*/
            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('temoin_valide') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nom', name: 'nom'},
                    {data: 'prenom', name: 'prenom'},
                    {
                        data: 'date_naiss',
                        render: function (data) {
                            var date = new Date(data);
                            var month = date.getMonth() + 1;
                            return (date.getDate().toString().length > 1 ? date.getDate() : "0" + date.getDate()) + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" + date.getFullYear()
                        },
                        name: 'date_naiss'
                    },
                  
                    {data: 'lieu_naiss', name: 'lieu_naiss'},
                    {data: 'domicile', name: 'domicile'},
                    {data: 'profession', name: 'profession'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

            });
           
            /*modifier temoin*/
            $('body').on('click', '.modifier', function (e) {

                var temoin_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editTemoin') }}" + '/' + temoin_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {

                        var date = new Date(data.temoin.date_naiss);
                        var month = date.getMonth() + 1;


                        $('#ajaxModel2').modal('show');
                        $('#id').val(data.id);
                        $('#nin').val(data.nin);
                        $('#nom').val(data.nom);
                        $('#prenom').val(data.prenom);
                        $('#date_naiss').val((date.getDate().toString().length > 1 ? +date.getFullYear() : "0") + "_" + (month.toString().length > 1 ? month : "0" + month) + "-" + date.getDate());
                        $('#lieu_naiss').val(data.lieu_naiss);
                        $('#domicile').val(data.domicile);
                        $('#profession').val(data.profession);                       
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*edit temoin*/
            $('body').on('click', '.editTemoin', function (e) {

                var temoin_id = $(this).data('id');
                e.preventDefault();
                $.ajax({
                    url: "{{ url('editTemoin') }}" + '/' + temoin_id  ,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        var date = new Date(data.temoin.date_naiss);
                        var month = date.getMonth() + 1;
                        $('#ajaxModel2').modal('show');
                        $('#id').val(data.id);
                        $('#nin').val(data.nin);
                        $('#nom').val(data.nom);
                        $('#prenom').val(data.prenom);
                        $('#date_naiss').val((date.getDate().toString().length > 1 ? +date.getFullYear() : "0") + "_" + (month.toString().length > 1 ? month : "0" + month) + "-" + date.getDate());
                        $('#lieu_naiss').val(data.lieu_naiss);
                        $('#domicile').val(data.domicile);
                        $('#profession').val(data.profession);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }

                })
            });
            /*enregistrer modification temoin*/
            $('#submit').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#form').serialize(),
                    url: "{{ route('validations.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Validation reuissi',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#form').trigger("reset");
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
                <h3>Temoins <small>Listes Temoin</small></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Temoins</h2>
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
    <!-- AJOUTER TEMOIN-->
    <div class="modal fade" id="ajaxModel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
            <h2>
                Nouvelle Declaration de Temoin
                <span id="btnClose" class="btnClose">&times;</span>
            </h2>

                <form class="form-horizontal form-label-left" method="POST" action="/ajoutTemoin">
                    @csrf
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <li>
                                <a href="#step" >
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                      Etape 1<br/>
                                      <small>Temoin</small>
                                  </span>
                                </a>
                            </li>
                        </ul>
                        <div id="step">
                            <div class="row">



                             </div>

                             <div class="product-tab-list tab-pane fade" id="tepoux">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="review-content-section">
                                        <h5>TEMOIN 1</h5>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="NOM">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="PRENOM">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" >
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" >
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="DOMICILE">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="PROFFESSION">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="review-content-section">
                                        <h5>TEMOIN 2</h5>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="NOM">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="PRENOM">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" >
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" >
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="DOMICILE">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="PROFFESSION">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade " id="tepouse">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="review-content-section">
                                        <h5>TEMOIN 3</h5>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="NOM">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="PRENOM">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" >
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" >
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="DOMICILE">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="PROFFESSION">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="review-content-section">
                                        <h5>TEMOIN 4</h5>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="NOM">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="PRENOM">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input type="date" class="form-control" >
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" >
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="DOMICILE">
                                        </div>
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="PROFFESSION">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                           
                        </div>
                                </div>
                </form>
            <!-- End SmartWizard Content -->
        </div>
    </div>
    </div>
    <!-- FIN AJOUTER TEMOIN-->
    <!-- AFFICHEZ INFO TEMOIN NON MODIFIABLE-->
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <br class="modal-header">
                    <h1>DETAILS</h1>

                        <div class="row">
                                <center> <h2>Temoin</h2></center>
                                <input type="hidden" class="form-control" name="temoin_id" id="temoin_id" disabled>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                            <label for="nin">NIN</label>

                            <input type="text" class="form-control" placeholder="NIN" name="nin">
                            </div>
                            <div class="form-group">
                            <label for="nom">Nom</label>

                            <input type="text" class="form-control" placeholder="NOM" name="nom">
                            </div>
                            <div class="form-group">
                            <label for="prenom">Prenom</label>

                            <input type="text" class="form-control" placeholder="PRENOM" name="prenom">
                            </div>
                            <div class="form-group">
                            <label for="date_naiss">Date Naissance</label>
                            <input type="date" class="form-control" name="date_naiss" >
                            </div>
                            <div class="form-group">
                            <label for="lieu_naiss">Lieu Naissance</label>

                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" name="lieu_naiss" >
                            </div>
                            <div class="form-group">
                            <label for="domicile">Domicile</label>

                            <input type="text" class="form-control" placeholder="DOMICILE" name="domicile">
                            </div>
                            <div class="form-group">
                            <label for="profession">Profession</label>

                            <input type="text" class="form-control" placeholder="PROFFESSION" name="profession">
                            </div>

                            </div>
                            </div>
                </div>
                </div>
            </div>
    <!-- FIN AFFICHAGE INFO TEMOIN NON MODIFIABLE-->
    <!-- AFFICHEZ INFO TEMOIN MODIFIABLE PAR OFFICIER-->
    <div class="modal fade" id="ajaxModel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="svg_wrap"></div>

                  <center>  <h1>Modification</h1></center>
                    <form class="form-horizontal form-label-left" id="form">
                        @csrf

                    <section>
                      <center>  <p>Temoin</p></center>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                            <label for="nin">Profession</label>

                            <input type="text" class="form-control" placeholder="NIN" name="nin">
                            </div>
                            <div class="form-group">
                            <label for="nom">Profession</label>

                            <input type="text" class="form-control" placeholder="NOM" name="nom">
                            </div>
                            <div class="form-group">
                            <label for="prenom">Profession</label>

                            <input type="text" class="form-control" placeholder="PRENOM" name="prenom">
                            </div>
                            <div class="form-group">
                            <label for="date_naiss">Date Naissance</label>
                            <input type="date" class="form-control" name="date_naiss" >
                            </div>
                            <div class="form-group">
                            <label for="lieu_naiss">Lieu Naissance</label>

                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE" name="lieu_naiss" >
                            </div>
                            <div class="form-group">
                            <label for="domicile">Domicile</label>

                            <input type="text" class="form-control" placeholder="DOMICILE" name="domicile">
                            </div>
                            <div class="form-group">
                            <label for="profession">Profession</label>

                            <input type="text" class="form-control" placeholder="PROFFESSION" name="profession">
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

    <!-- FIN AFFICHAGE INFO TEMOIN MODIFIABLE PAR OFFICIER-->


@endsection



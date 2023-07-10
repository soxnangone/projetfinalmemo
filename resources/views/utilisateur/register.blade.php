@section('head')
    <!-- iCheck -->
    <link href="{{ url('assets/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/css/util.css">
    <link rel="stylesheet" type="text/css" href="/css/register.css">
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('Listes_Utilisateurs.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'nin', name: 'nin'},
                    {data: 'nom', name: 'name'},
                    {data: 'prenom', name: 'prenom'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'adresse', name: 'adresse'},
                    {data: 'telephone', name: 'telephone'},
                    {data: 'poste', name: 'poste'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

            });

            $('body').on('click', '.activer', function (e) {
                var id = $(this).data('id');

                e.preventDefault();
                $.ajax({
                    url: "{{ url('statu') }}" + '/' + id,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire(
                            'tres bien!',
                            'vous avez activer ce compte!',
                            'success'
                        )
                       table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
            $('body').on('click', '.desactiver', function (e) {
                var id = $(this).data('id');

                e.preventDefault();
                $.ajax({
                    url: "{{ url('statu') }}" + '/' + id,
                    type: "GET",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire(
                            'tres bien!',
                            'vous avez desactiver ce compte!',
                            'success'
                        )
                        table.draw();
                    },
                    error: function (data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'echec activation!',
                        })
                        console.log('Error:', data);
                    }
                });
            });
            $('#enregistrer').click(function (e) {
                e.preventDefault();
                $.ajax({
                    data: $('#formRegister').serialize(),
                    url: "{{ route('Listes_Utilisateurs.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Utilisateur ajouté!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#formRegister').trigger("reset");
                        $('#ajaxModel').modal('hide');
                            table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'echec Enregistrement!',
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
                <h3>Utilisateurs <small>Listes Des Utilisateurs</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Utilisateurs</h2>
                        <ul class="nav navbar-right panel_toolbox">

                            <button type="button"  data-toggle="modal" data-target="#ajaxModel" class="btn btn-success btn-xs">Nouveau</button>


                        </ul>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <!-- start project list -->
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nin</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Telephone</th>
                                <th>Poste</th>
                                <th>Statut</th>
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
                Nouvelle Utilisateur
                <span id="btnClose" class="btnClose">&times;</span>
            </h2>
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(/images/br2.jpg);">
					<span class="login100-form-title-1">
						Ajout Utilisateur
					</span>
                </div>

                <form class="login100-form validate-form"  id="formRegister">
                    {{ csrf_field()}}
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="row">

                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <center>
                                    <div class="wrap-input100 validate-input m-b-26" data-validate="Nin Obligatoire">
                                        <span class="label-input100">Nin</span>
                                        <input class="input100" type="text" name="nin" placeholder="Saisir Nin" id="nin_user">
                                        <span class="focus-input100"></span>
                                    </div>
                                </center>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="wrap-input100 validate-input m-b-26" data-validate="nom Obligatoire">
                                    <span class="label-input100">Nom</span>
                                    <input class="input100" type="text" name="name"
                                           placeholder="Veillez saisir votre Nom">
                                    <span class="focus-input100"></span>
                                </div>
                                <div class="wrap-input100 validate-input m-b-26" data-validate="prenom Obligatoire">
                                    <span class="label-input100">Prenom</span>
                                    <input class="input100" type="text" name="prenom"
                                           placeholder="Veillez saisir votre Prenom">
                                    <span class="focus-input100"></span>
                                </div>
                                <div class="wrap-input100 validate-input m-b-26" data-validate="Email Obligatoire">
                                    <span class="label-input100">Email</span>
                                    <input class="input100" type="email" name="email"
                                           placeholder="Veillez saisir votre Email">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="wrap-input100 validate-input m-b-26"
                                     data-validate="Nom d'utilisateur Obligatoire">
                                    <span class="label-input100">Nom d'Utilisation</span>
                                    <input class="input100" type="text" name="username"
                                           placeholder="Veillez saisir votre  nom D'utilisateur">
                                    <span class="focus-input100"></span>
                                </div>
                                <div class="wrap-input100 validate-input m-b-26" data-validate="telephone Obligatoire">
                                    <span class="label-input100">Telephone</span>
                                    <input class="input100" type="text" name="telephone"
                                           placeholder="Veillez saisir votre Num telephone" id="telephone">
                                    <span class="focus-input100"></span>
                                </div>
                                <div class="wrap-input100 validate-input m-b-26" data-validate="adresse Obligatoire">
                                    <span class="label-input100">Adresse</span>
                                    <input class="input100" type="text" name="adresse"
                                           placeholder="Veillez saisir votre Adresse" id="adresse">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <span class="label-input100">POSTE</span>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="poste" id="poste" value="agent"
                                           checked>
                                    Agent-simple
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="poste" id="poste"
                                           value="officier">

                                    Officier

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="poste" id="poste" value="admin">

                                    Admin

                                </div>
                                <div class="container-login100-form-btn">
                                    <button class="login100-form-btn " id="enregistrer">
                                        ENREGISTRER
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <!-- End SmartWizard Content -->
        </div>
    </div>

    <!-- impression -->


@endsection



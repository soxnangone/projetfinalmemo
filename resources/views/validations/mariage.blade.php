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
                <h3>Mariages <small>Liste Mariages</small></h3>

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
                                <th>N° Régistre</th>
                                <th>Lieu Mariage</th>
                                <th>Régime</th>
                                <th>option</th>
                                <th>Date Mariage</th>
                                <th>Date Déclaration</th>
                                <th>Prenom Epoux</th>
                                <th>Prenom Epouse</th>
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
                        Verification Declaration de Mariage
                        <span id="btnClose" class="btnClose">&times;</span>
                    </h2>
                </div>

                <form class="form-horizontal form-label-left" id="form_mariage">
                    <input type="hidden" id="naissance_id" name="naissance_id" value="">
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
                data: $('#form_mariage').serialize(),
                url: "{{ route('validations_mariage.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#form_mariage').trigger("reset");
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


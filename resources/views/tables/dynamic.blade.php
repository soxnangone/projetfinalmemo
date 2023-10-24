@section('head')
    <!-- iCheck -->
    <link href="{{ url('assets/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/step.css">
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
    <script src="{{ url('assets/gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/step.js"></script>
@endsection

@section('content')
    <div class="">
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
                        <h2>Validations <small>Mariages</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="svg_wrap"></div>

                    <center>  <h1>Validation Mariage</h1></center>
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
                            <div class=" btn btn-success"  id="submit">Valider</div> </center>
                    </form>
                </div>
             <!---   <form class="form-horizontal" id="form_naissance">
                    {{ csrf_field()}}
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <input type="hidden" class="form-control" name="naissance_id" id="naissance_id">
                            <div class="form-group">
                                <label for="username">Numero Registre </label>

                                <input type="text" required class="form-control" placeholder="Nunero Registre *"
                                       name="num_registre" id="num_registre">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label for="username">Annee </label>

                                <input type="number" required class="form-control" placeholder="Annee *" name="annee"
                                       id="annee">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                            <div class="form-group">
                                <label for="username">Nom </label>
                                <input type="text" class="form-control" placeholder="Nom *" required name="nom_enfant"
                                       id="nom_enfant">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label for="username">Prenom </label>
                                <input type="text" class="form-control" placeholder="Prenom *" required
                                       name="prenom_enfant" id="prenom_enfant">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label for="username">Date Naissance</label>
                                <input class="form-control" name="date_naissance" id="date_naissance">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label for="username">Lieu Naissance </label>
                                <input type="text" class="form-control" placeholder="Lieu Naissance *" required
                                       name="lieu_naissance" id="lieu_naissance">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label for="username">Heure </label>
                                <input type="number" class="form-control" placeholder="Heure *" required
                                       name="heure_naissance" id="heure_naissance">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label for="username">Formation Sanitaire</label>
                                <select class="form-control pro-edt-select form-control-primary" required
                                        name="formation_sanitaire" id="formation_sanitaire">

                                    <option selected disabled>choose....</option>
                                  
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <center><h5>PERE</h5></center>


                                <input type="hidden" class="form-control" name="id_pere" id="id_pere">
                                <div class="form-group">

                                    <input type="text" class="form-control" placeholder="Nin " name="nin_pere"
                                           id="nin_pere">
                                </div>
                                <div class="form-group">
                                    <label for="username">Nom </label>
                                    <input type="text" class="form-control" placeholder="Nom " name="nom_pere"
                                           id="nom_pere">
                                </div>
                                <div class="form-group">
                                    <label for="username">Prenom</label>
                                    <input type="text" class="form-control" placeholder="Prenom " name="prenom_pere"
                                           id="prenom_pere">
                                </div>

                                <div class="form-group">
                                    <label for="username">Date Naissance</label>
                                    <input class="form-control" name="datenaissance_pere" id="datenaissance_pere">
                                </div>
                                <div class="form-group">
                                    <label for="username">Lieu Naissance</label>
                                    <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                           name="lieu_naissance_pere" id="lieu_naissance_pere">
                                </div>
                                <div class="form-group">
                                    <label for="username">Domicile</label>
                                    <input type="text" class="form-control" placeholder="DOMICILE " name="domicile_pere"
                                           id="domicile_pere">
                                </div>
                                <div class="form-group">
                                    <label for="username">Profession</label>
                                    <input type="text" class="form-control" placeholder="PROFFESSION "
                                           name="profession_pere" id="profession_pere">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                                <center><h5>MERE</h5></center>
                                <input type="hidden" class="form-control" name="id_mere" id="id_mere">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nin " name="nin_mere"
                                           id="nin_mere">
                                </div>


                                <div class="form-group">
                                    <label for="username">Nom </label>
                                    <input type="text" class="form-control" placeholder="Nom " name="nom_mere"
                                           id="nom_mere">
                                </div>


                                <div class="form-group">
                                    <label for="username">Prenom</label>
                                    <input type="text" class="form-control" placeholder="Prenom " name="prenom_mere"
                                           id="prenom_mere">
                                </div>

                                <div class="form-group">
                                    <label for="username">Date Naissance</label>
                                    <input class="form-control" name="datenaissance_mere" id="datenaissance_mere">
                                </div>
                                <div class="form-group">
                                    <label for="username">Lieu Naissance</label>
                                    <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                           name="lieu_naissance_mere" id="lieu_naissance_mere">
                                </div>

                                <div class="form-group">
                                    <label for="username">Domicile</label>
                                    <input type="text" class="form-control" placeholder="DOMICILE " name="domicile_mere"
                                           id="domicile_mere">
                                </div>
                                <div class="form-group">
                                    <label for="username">Profession</label>
                                    <input type="text" class="form-control" placeholder="PROFFESSION "
                                           name="profession_mere" id="profession_mere">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <center><h5>DECLARANT</h5></center>
                                <input type="hidden" class="form-control" name="id_declarant" id="id_declarant">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nin *" name="nin_declarant"
                                           id="nin_declarant">
                                </div>


                                <div class="form-group">
                                    <label for="username">Nom </label>
                                    <input type="text" class="form-control" placeholder="Nom *" name="nom_declarant"
                                           id="nom_declarant">
                                </div>

                                <div class="form-group">
                                    <label for="username">Prenom</label>
                                    <input type="text" class="form-control" placeholder="Prenom *"
                                           name="prenom_declarant" id="prenom_declarant">
                                </div>

                                <div class="form-group">
                                    <label for="username">Date Naissance</label>
                                    <input class="form-control" name="datenaissance_declarant"
                                           id="datenaissance_declarant">
                                </div>

                                <div class="form-group">
                                    <label for="username">Lieu Naissance</label>
                                    <input type="text" class="form-control" placeholder="LIEU NAISSANCE *"
                                           name="lieu_naissance_declarant" id="lieu_naissance_declarant">
                                </div>

                                <div class="form-group">
                                    <label for="username">Domicile</label>
                                    <input type="text" class="form-control" placeholder="DOMICILE *"
                                           name="domicile_declarant" id="domicile_declarant">
                                </div>

                                <div class="form-group">
                                    <label for="username">Profession</label>
                                    <input type="text" class="form-control" placeholder="PROFFESSION *"
                                           name="profession_declarant" id="profession_declarant">

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <center><h5></h5></center>
                                </br>
                                <div class="form-group">
                                    <label for="username">Sexe</label>
                                    <br>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexe" id="masculin"
                                               value="Masculin">
                                        Masculin
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sexe" id="feminin"
                                               value="Feminin">
                                        Feminin
                                    </div>

                                </div>
                                <div class="form-group">

                                    <label for="username">TYPE DECLARATION</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_declaration"
                                               id="normale" value="Normal">
                                        Normale
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_declaration"
                                               id="tardive" value="Tardive">

                                        Tardive

                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                </form>
                !--->
            </div>



        </div>
    </div>


@endsection
<script src="{{ url('js/jquery.js') }}"></script>
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
                ajax: "{{ route('validations_mariage.index') }}",
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
                        var date_dec = new Date(data.date_dec);
                        var month_dec = date_dec.getMonth() + 1;

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
                    
                });
            });

        });
    </script>


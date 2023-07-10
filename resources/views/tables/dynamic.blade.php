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
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="svg_wrap"></div>

                    <center>  <h1>Validation Naissance</h1></center>
                    <form class="form-horizontal form-label-left" id="form_naissance">
                        @csrf
                        <section>
                            <center>  <p>Informations Enfant</p></center>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <input type="hidden" class="form-control" name="naissance_id" id="naissance_id">
                                <div class="form-group">
                                    <label for="username">Numero Declaration </label>
                                    <input type="text" required class="form-control" placeholder="Nunero Declaration *"
                                           name="num_registre" id="num_registre">
                                </div>
                                <div class="form-group">
                                    <label for="username">Nom </label>
                                    <input type="text" class="form-control" placeholder="Nom *" required
                                           name="nom_enfant" id="nom_enfant">
                                </div>
                                <div class="form-group">
                                    <label for="username">Prenom </label>
                                    <input type="text" class="form-control" placeholder="Prenom *" required
                                           name="prenom_enfant" id="prenom_enfant">
                                </div>
                                <div class="form-group">
                                    <label for="username">Date Naissance</label>
                                    <input  class="form-control" name="date_naissance" id="date_naissance">
                                </div>

                                <div class="form-group"  id="num_jugement"  style="visibility: hidden">
                                    <label for="username">Numero Jugement </label>
                                    <input type="text" class="form-control" placeholder="Numero Jugemnt *"
                                           name="num_jugement" id="num_jugement">

                                </div>
                                <div class="form-group" id="nom_tribunal"  style="visibility: hidden">
                                    <label for="username">Nom Tribunal</label>
                                    <input type="text" class="form-control" placeholder="Nom Tribunal *"
                                           name="nom_tribunal" id="nom_tribunal"  >

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Annee </label>
                                    <input type="text" required class="form-control"
                                           name="annee" id="annee" readonly>
                                </div>
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
                                            name="formation_sanitaire" id="formation_sanitaire" >

                                        <option selected disabled>choose....</option>
                                        @foreach($formations as $forma)
                                            <option value="{{$forma->id}}">{{$forma->nom_formation}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group"  id="date_jugement" style="visibility: hidden">
                                    <label for="username">Date Jugement</label>
                                    <input type="date" class="form-control" name="date_jugement" id="date_jugement"
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
                                                                   id="normale" value="Normale" >  </center>
                                    </div>
                                    <div class="form-check">
                                        <center> Tardive <input class="form-check-input" type="radio" name="type_declaration"
                                                                id="tardive" value="Tardive" >  </center>
                                    </div>
                                    <div class="form-check">
                                        <center>Jugement <input class="form-check-input" type="radio" name="type_declaration"
                                                                id="jugement" value="jugement" > </center>
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
                                        <input type="hidden" class="form-control"  id="id_pere" name="id_pere">
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Nin "
                                                   id="nin_pere" name="nin_pere">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Nom </label>
                                            <input type="text" class="form-control" placeholder="Nom "
                                                   id="nom_pere" name="nom_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Prenom</label>
                                            <input type="text" class="form-control" placeholder="Prenom "
                                                   id="prenom_pere" name="prenon_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input  class="form-control"
                                                    id="datenaissance_pere" name="datenaissance_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Lieu Naissance</label>
                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE " name="lieu_naissance_pere" id="lieu_naissance_pere">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Domicile</label>
                                            <input type="text" class="form-control" placeholder="DOMICILE " id="domicile_pere" name="domicile_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Profession</label>
                                            <input type="text" class="form-control" placeholder="PROFFESSION "
                                                   id="profession_pere" name="profession_pere">
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
                                                   id="nin_mere" name="nin_mere">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Nom </label>
                                            <input type="text" class="form-control" placeholder="Nom "
                                                   id="nom_mere" name="nom_mere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Prenom</label>
                                            <input type="text" class="form-control" placeholder="Prenom "
                                                   id="prenom_mere" name="prenon_pere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Date Naissance</label>
                                            <input  class="form-control"
                                                    id="datenaissance_mere" name="datenaissance_mere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Lieu Naissance</label>
                                            <input type="text" class="form-control" placeholder="LIEU NAISSANCE "
                                                   id="lieu_naissance_mere" name="lieu_naissance_mere">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Domicile</label>
                                            <input type="text" class="form-control" placeholder="DOMICILE "
                                                   id="domicile_mere" name="domicile_mere">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Profession</label>
                                            <input type="text" class="form-control" placeholder="PROFFESSION "
                                                   id="profession_mere" name="profession_mere">
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
                                           name="nin_declarant" id="nin_declarant">
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
                                        <input  class="form-control" name="datenaissance_declarant"
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
                        </section>

                        <section>
                            <center> <p>Temoins</p></center>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                                <center><h5>Temoin 1</h5></center>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <input type="text" class="form-control" placeholder="Nin "
                                                   id="nin_t1" name="nin_t1" >
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
                                    @foreach($formations as $forma)
                                        <option value="{{$forma->id}}">{{$forma->nom_formation}}</option>
                                    @endforeach
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

        var table = $('.table').DataTable({
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

        $('body').on('click', '.editNaissance', function () {
            var naissance_id = $(this).data('id');
            $.get("{{ route('validations_naissance.index') }}" + '/' + naissance_id + '/edit', function (data) {
                var date = new Date(data.date_naiss);
                var month = date.getMonth() + 1;

                var date_pere = new Date(data.pere.date_naissp);
                var month_mere = date_pere.getMonth() + 1;

                var date_mere = new Date(data.mere.date_naissm);
                var month_pere = date_mere.getMonth() + 1;

                var date_declarant = new Date(data.declarant.date_naissd);
                var month_declarant = date_declarant.getMonth() + 1;

                $('#modelHeading').html("Edit ");
                $('#ajaxModel').modal('show');
                $('#naissance_id').val(data.id);
                $('#num_registre').val(data.num_registre);
                $('#annee').val(data.annee);
                $('#nom_enfant').val(data.nom_enfant);
                $('#prenom_enfant').val(data.prenom_enfant);
                $('#date_naissance').val((date.getDate().toString().length > 1 ? +date.getFullYear() : "0") + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" + date.getDate());
                $('#lieu_naissance').val(data.lieu_naiss);
                $('#heure_naissance').val(data.heure_naiss);
                $('#formation_sanitaire').val(data.codeforme);
                if (data.sexe === 'Femme') {
                    $('#feminin').attr('checked', true);
                    $('#masculin').attr('checked', false);

                } else {
                    $('#feminin').attr('checked', false);
                    $('#masculin').attr('checked', true);
                }
                if (data.type_dec === 'Normal') {
                    $('#normale').attr('checked', true);
                    $('#tardive').attr('checked', false);
                } else {
                    $('#normale').attr('checked', false);
                    $('#tardive').attr('checked', true);
                }
                $('#id_pere').val(data.pere.id);
                $('#nin_pere').val(data.pere.nin_pere);
                $('#nom_pere').val(data.pere.nom_pere);
                $('#prenom_pere').val(data.pere.prenom_pere);
                $('#datenaissance_pere').val((date_pere.getDate().toString().length > 1 ? +date_pere.getFullYear() : "0") + "-" + (month_pere.toString().length > 1 ? month : "0" + month) + "-" + date_pere.getDate());
                $('#lieu_naissance_pere').val(data.pere.lieu_naissp);
                $('#domicile_pere').val(data.pere.domicile_pere);
                $('#profession_pere').val(data.pere.profession_pere);
                $('#id_mere').val(data.mere.id);
                $('#nin_mere').val(data.mere.nin_mere);
                $('#nom_mere').val(data.mere.nom_mere);
                $('#prenom_mere').val(data.mere.prenom_mere);
                $('#datenaissance_mere').val((date_mere.getDate().toString().length > 1 ? +date_mere.getFullYear() : "0") + "-" + (month_mere.toString().length > 1 ? month : "0" + month) + "-" + date_mere.getDate());
                $('#lieu_naissance_mere').val(data.mere.lieu_naissm);
                $('#domicile_mere').val(data.mere.domicile_mere);
                $('#profession_mere').val(data.mere.profession_mere);
                $('#id_declarant').val(data.declarant.id);
                $('#nin_declarant').val(data.declarant.nin_declarant);
                $('#nom_declarant').val(data.declarant.nom_declarant);
                $('#prenom_declarant').val(data.declarant.prenom_declarant);
                $('#datenaissance_declarant').val((date_declarant.getDate().toString().length > 1 ? +date_declarant.getFullYear() : "0") + "-" + (month_declarant.toString().length > 1 ? month : "0" + month) + "-" + date_declarant.getDate());
                $('#lieu_naissance_declarant').val(data.declarant.lieu_naissd);
                $('#domicile_declarant').val(data.declarant.domicile_declarant);
                $('#profession_declarant').val(data.declarant.profession_declarant);

            })
        });
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

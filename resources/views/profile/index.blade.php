@section('head')
<!-- bootstrap-daterangepicker -->
<link href="{{ url('assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/util.css">
<link rel="stylesheet" type="text/css" href="/css/main1.css">

@endsection

@extends('layouts.master')

@section('foot')
<!-- morris.js -->
<script src="{{ url('assets/gentelella/vendors/raphael/raphael.min.js') }}"></script>
<script src="{{ url('assets/gentelella/vendors/morris.js/morris.min.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ url('assets/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ url('assets/gentelella/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ url('assets/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

@endsection

@section('content')

<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Profile Utilisateur</h3>
      </div>


    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                  </div>
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" src="{{ url('assets/gentelella/images/uti.png') }}" alt="Avatar" title="Change the avatar">
                </div>
              </div>


              <!-- start skills -->


              <!-- end of skills -->

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <br/>
                <h3>{{Auth::user()->prenom }} {{Auth::user()->nom }} </h3>

                <ul class="list-unstyled user_data">
                    <li><i class="fa fa-user "></i> {{Auth::user()->username }}
                    </li>
                    <li><i class="fa fa-send "></i> {{Auth::user()->email }}
                    </li>
                    <li><i class="fa fa-map-marker "></i> {{Auth::user()->adresse }}
                    </li>
                    <li><i class="fa fa-phone "></i> {{Auth::user()->telephone }}
                    </li>
                    <li>
                        <i class="fa fa-briefcase user-profile-icon"></i> {{Auth::user()->poste }}
                    </li>


                </ul>


            </div>
              </div>
              <div class="row">
                  <br/>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <center><h1>Editer Profile</h1></center>

                  <form class="login100-form validate-form" method="post" action="/update_user">
                      {{ csrf_field()}}
                      @if ($message = Session::get('success'))
                          <div class="alert alert-success ">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              <strong>{{ $message }}</strong>
                          </div>
                      @endif
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <input class="input100" type="hidden" name="id_user" placeholder="Enter Nom" value="{{Auth::user()->id}}" >
                                  <div class="wrap-input100 validate-input m-b-26" data-validate="Name is required">

                                      <input class="input100" type="text" name="nom" placeholder="Enter Nom" value="{{Auth::user()->nom}}" >
                                      <span class="focus-input100"></span>
                                  </div>
                                  <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">

                                      <input class="input100" type="text" name="prenom" placeholder="Enter Prenom" id="prenom" value="{{Auth::user()->prenom}}" >
                                      <span class="focus-input100"></span>
                                  </div>
                                  <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required" >

                                      <input class="input100" type="text" name="email" placeholder="Enter Email" id="email" value="{{Auth::user()->email}}">
                                      <span class="focus-input100"></span>
                                  </div>


                              </div>



                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">

                                      <input class="input100" type="text" name="username" placeholder="Entrer Username" id="username" value="{{Auth::user()->username}}">
                                      <span class="focus-input100"></span>
                                  </div>
                                  <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">

                                      <input class="input100" type="text" name="telephone" placeholder="Enter telephone" id="telephone" value="{{Auth::user()->telephone}}" >
                                      <span class="focus-input100"></span>
                                  </div>
                                  <div class="wrap-input100 validate-input m-b-18" data-validate = "username is required">

                                      <input class="input100" type="text" name="adresse" placeholder="Enter Adreese" id="adresse" value="{{Auth::user()->adresse}}">
                                      <span class="focus-input100"></span>
                                  </div>

                              </div>
                          </div>
                          <div class="container-login100-form-btn">
                              <button class="login100-form-btn">
                                  Editer
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <center><h1>Changer Mot de passe</h1> </center>

                      <form class="login100-form validate-form" method="post" action="/update_password">
                          {{ csrf_field()}}
                          <input class="input100" type="hidden" name="id_user" placeholder="Enter Nom" value="{{Auth::user()->id}}" >
                      <div class="wrap-input100 validate-input m-b-26" data-validate="Password is required">

                          <input class="input100" type="password" name="password" placeholder="Nouveau Password" id="password" >
                          <span class="focus-input100"></span>
                      </div>
                      <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                          <input class="input100" type="password" name="Nouveau_password" placeholder="Confirmer Password" id="nvpassword">
                          <span class="focus-input100"></span>
                      </div>
                          <div class="container-login100-form-btn">
                              <button class="login100-form-btn">
                                  Changer
                              </button>
                          </div>
                      </form>
                  </div>
          </div>


        </div>

      </div>
    </div>

              <br />

              <div class="row">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

</div>

          <script src="{{ url('js/jquery.js') }}"></script>


@endsection



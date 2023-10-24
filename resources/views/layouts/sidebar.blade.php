<div class="col-md-3 left_col">
    <div class="left_col scroll-view" style="background-color: #00008B;">
        <div class="navbar nav_title navbar-light" style="background-color: #00008B;" style="border: 0;">
            <a href="{{ url('dashboard') }}" class="site_title"> <img src="{{ url('assets/gentelella/images/logo_mg.jpg') }}" style="width: 25%; height: 75%; margin-top: 3%; margin-left: 0%"  class="img-circle profile_img">
                <span>Medina-Gounas</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">

            <div class="profile_info">
                <span>Bonjour,</span>
                <span style="text-transform: uppercase;"> <h2>{{Auth::user()->prenom }}</h2></span>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    @if(Auth::user()->poste=="agent"|| Auth::user()->poste=="OFFICIER")
                        <li><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> ACCUEIL</a>
                        </li>
                        <li><a ><i class="fa fa-birthday-cake"></i> Mariage <span class="fa fa-chevron-down"></span> </a>
                            <ul class="nav child_menu">
                                <li><a href="{{ url('declarations/Mariage') }}">Declaration</a></li>
                                <li><a href="{{route('impression_extrait_mariage.index')}}" >Extrait</a></li>
                                <li><a >Copie Litterale</a></li>
                            </ul>
                        </li>
                        </li>
                        <li><a ><i class="fa fa-remove"></i> DECES <span class="fa fa-chevron-down"></span> </a>
                            <ul class="nav child_menu">
                                <li><a href="{{ url('declarations/Mariage') }}">Declaration</a></li>
                                <li><a href="{{route('impression_extrait_mariage.index')}}" >Extrait</a></li>
                                <li><a >Copie Litterale</a></li>
                            </ul>
                        </li>
                        </li>
                    @endif
                    @if(Auth::user()->poste=="OFFICIER")
                        <li><a><i class="fa fa-check"></i> VALIDATIONS <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('validations_mariage.index') }}">Mariage</a></li>
                                <li><a href="{{ url('chart/moris') }}">Deces</a></li>
                            </ul>
                        </li>
                    @endif
                        @if(Auth::user()->poste=="ADMIN")
                            <li><a href="{{ route('Listes_Utilisateurs.index') }}"><i class="fa fa-user"></i> UTILISATEUR </a></li>
                        @endif
                </ul>
            </div>
        </div>

    </div>
</div>

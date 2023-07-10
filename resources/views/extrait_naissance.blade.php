@section('head')
    <!-- iCheck -->
    <link href="{{ url('assets/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/gentelella/css/gentelella.css') }}" rel="stylesheet">
@endsection

@extends('layouts.master', ['title' => $title])

@section('foot')

@endsection

@section('content')
	<div class="container">
<div class="rectangle1">
	 <center> <span class="vertical-line"></span></center>
	<div class="rect1">
		<center><h6>REGION DE DAKAR</h6><hr>
			<label>Departement de Guediawaye</label><br>
			<label>Commune de Dalifort-Foreil</label>
		</center>

	</div>
	<div class="rect2">
		<center><h5>REPUBLIQUE DU SENEGAL</h5>
			<label>UN PEUPLE-UN BUT-UNE FOI</label>
			<h3 style="font-size: 20px">ETAT CIVIL</h3>

			<label>Dalifort-Forail</label>
		</center>

	</div>
</div>
<div class="rectangle2">
	<span class="vertical-line2"></span>

	<div class="rect3"><br>
		Pour l'annee: <label>-----------------------------------------------</label><br>
		N° dans le registre : <label>-----------------------------</label>
	</div>
	<div class="rect4">
		<br>
		AN <label>=====</label><br>
		 N  <label>====</label>
	</div>
</div>
<div class="rectangle3">
	<br>
	Le <label>--------------------------------------------</label><br>
	à <label>-------</label>heure<label>----------</label>minutes est né(e) à<label>----------------</label><br>
	un enfant de sexe <label>---------------</label> <br>
	Prenom<label>------------------------</label>            Nom<label>-------------------</label><br>
	De <label>----------------------------------</label><br>
	et de <label>-----------------------------</label>                  Nom<label>-------------</label>

	<br>
	<center>Pays de Naissance pour les naissances à l'etranger  <label></label></center>


</div>
<div class="rectangle4">
	<span class="vertical-line3"></span>
	<span class="vertical-line4"></span>
	<div class="rect5">
		Jugement
		 d'autorisation
		 d'inscription
	</div>
	<div class="rect6">
		  Delivre par le juge de la paix de <label> =====================</label><br>
		  le <label></label><br>
		  sous le numero <label>-----------------------</label><br>
		  inscrit le <label></label> sur le registre des actes de naissances de l'annee
	</div>
	<div class="rect7">
			<br>
		     AN  <label>====</label><br>
		     N  <label>====</label>
	</div>
</div>
<div class="rectangle5">
	<br>
	<center>Le <label>--------------------------------------------</label><br>
	à <label>-------</label>heure<label>----------</label>minutes est né(e) à<label>----------------</label><br>
	un enfant de sexe <label>---------------</label> <br></center>



</div>
<div class="rectangle6">

</div>
<div class="rectangle7">

</div>
<div class="rectangle8">

</div>
<div class="rectangle9">

</div>
</div>
@endsection

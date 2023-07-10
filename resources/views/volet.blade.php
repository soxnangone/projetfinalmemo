<!DOCTYPE html>
<html>
<head>
    <title>extrait</title>
    <link rel="stylesheet" type="text/css" href="css/volet.css">
</head>
<body>
<fieldset>
  <center> <h3> VOLET 1 ACTE DE NAISSANCE</h3> </center>
    <table  class="table" id="table">
    <thead>
    <tr>
        <th colspan="2" class="a"><h3 style="color: black">REGION DE DAKAR</h3><hr>
            <label style="color: black">Departement de Pikine</label><br>
            <label style="color: black">Commune de Dalifort-Foirail</label>
        </th>
        <th colspan="2" class="a"><h5>REPUBLIQUE DU SENEGAL</h5>
            <label style="color: black">UN PEUPLE-UN BUT-UNE FOI</label>
            <h3 style="color: black">ETAT CIVIL</h3>
    </tr>
    </thead>
</table>
<pre>
  <fieldset>
    <legend>Enfant</legend>
           <pre>
   <label>Prenoms de l'enfant</label>:    {{$data->prenom_enfant}}                   <label>Numero</label>:{{$data->num_registre}}<br/>
   <label>Sexe</label>: {{$data->sexe}}    <br/>
   <label>Date Naissance</label>: {{$data->date_naiss}} <br/>
   <label>Lieu Naissance</label>: {{$data->lieu_naiss}}
     </pre>
       </fieldset>

       <fieldset>
    <legend>Pere</legend>
           <pre>
    <label>Nin</label>:    {{$data->pere->nin_pere}}<br/>
    <label>Prenom</label>:     {{$data->pere->prenom_pere}}                     <label>Nom</label>:    {{$data->pere->nom_pere}}<br/>
    <label>Date Naissance</label>: {{$data->pere->date_naissp}}   <label>Lieu Naissance</label>: {{$data->pere->lieu_naissp}}<br/>
    <label>Domicile</label>: {{$data->pere->domicile_pere}}                   <label>Profession</label>: {{$data->pere->profession_pere}}
     </pre>
       </fieldset>
      <fieldset>
    <legend>Mere</legend>
           <pre>
    <label>Nin</label>:    {{$data->mere->nin_mere}}<br/>
    <label>Prenom</label>:    {{$data->mere->prenom_mere}}               <label>Nom</label>:    {{$data->mere->nom_mere}} <br/>
    <label>Date Naissance</label>: {{$data->mere->date_naissm}}   <label>Lieu Naissance</label>: {{$data->mere->lieu_naissm}}<br/>
    <label>Domicile</label>: {{$data->mere->domicile_mere}}                   <label>Profession</label>: {{$data->mere->profession_mere}}
     </pre>
       </fieldset>
      <fieldset>
    <legend>Declarant</legend>
           <pre>
    <label>Nin</label>:    {{$data->declarant->nin_declarant}}<br/>
    <label>Prenom</label>:    {{$data->declarant->prenom_declarant}}                  <label>Nom</label>:   {{$data->declarant->nom_declarant}}<br/>
    <label>Date Naissance</label>: {{$data->declarant->date_naissd}}   <label>Lieu Naissance</label>: {{$data->declarant->lieu_naissd}}<br/>
    <label>Domicile</label>: {{$data->declarant->domicile_declarant}}                   <label>Profession</label>: {{$data->declarant->profession_declarant}}
     </pre>
       </fieldset>
     <fieldset>
    <legend>Infos Suplementaire</legend>
           <pre>
   <label>Date Declaration</label>:    {{$data->date_declaration}}       <br/>
   <label>Heure Naissance</label>: {{$data->heure_naiss}} h   <br/>
   <label>Date Jugement</label>: {{$data->date_jugement}} <br/>
   <label>Numero Jugement</label>: {{$data->num_jugement}}<br/>
   <label>Nom Tribunal</label>: {{$data->nom_tribunal}}<br/>
     </pre>
       </fieldset>
</pre>
</fieldset>
</body>
</html>


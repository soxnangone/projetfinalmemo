<!DOCTYPE html>
<html>
<head>
    <title>extrait</title>
    <link rel="stylesheet" type="text/css" href="css/extrait.css">

</head>
<body>

<table  class="table" id="table">

    <caption>
       <b> EXTRAIT DE NAISSANCE</b><br>
    </caption>

    <thead>
    <tr>
        <th colspan="2" class="a"><h3>REGION DE DAKAR</h3><hr>
            <label>Departement de Pikine</label><br>
            <label>Commune de Dalifort-Foirail</label>
        </th>
        <th colspan="2" class="a"><h5>REPUBLIQUE DU SENEGAL</h5>
            <label>UN PEUPLE-UN BUT-UNE FOI</label>
            <h3>ETAT CIVIL</h3>
    </tr>
    </thead>


    <tbody>
    <tr>
        <th >Pour L'annee</th>
        <td id="annee">{{$annee}}</td>
        <th>AN :</th>
        <td>{{$data->annee}}</td>
    </tr>
    <tr>
        <th>Registre Numero</th>
        <td id="num_registre">{{$registre}}</td>
        <th>N:</th>
        <td>{{$data->num_registre}}</td>
    </tr>

    </tbody>
    <tbody>
    <tr>
        <th>Le</th>
        <td colspan="3">{{$data->date_naiss}}</td>
    </tr>
    <tr>
        <th>à</th>
        <td >{{$data->heure_naiss}}</td>
        <th>heures</th>
        <td>mn</td>
    </tr>
    <tr>
        <th colspan="2">Est né(e) Un enfant de sexe</th>
        <td colspan="2" >{{$data->sexe}}</td>
    </tr>
    <tr>
        <th>Prenom</th>
        <td >{{$data->prenom_enfant}}</td>
        <th>Nom</th>
        <td>{{$data->nom_enfant}}</td>
    </tr>
    <tr>
        <th>De</th>
        <td >{{$data->pere->prenom_pere}}</td>
        <th>Et de</th>
        <td>{{$data->mere->prenom_mere}}{{$data->nom_mere}}</td>
    </tr>
    <tr>
        <th colspan="4">Pays de Naissance Pour les etrangers</td>
    </tr>
    </tbody>
    <tbody>
    <tr>
        <th class="c">Jugement</th>
        <th>Delivre par </th>
        <td colspan="2"></td>

    </tr>
    <tr>
        <th class="c">d'autorisation</th>
        <th>le </th>
        <td colspan="2"></td>

    </tr>
    <tr>
        <th class="c">d'inscription</th>
        <th> sous le numero </th>
        <td colspan="2"></td>

    </tr>

    </tbody>
    <tfoot>
    <tr>
        <th colspan="4"  ></th>
    </tr>
    <tr>
        <th colspan="4"  ></th>
    </tr>
    <tr>
        <th colspan="4"  ></th>
    </tr>
    <tr>
        <th colspan="4"  ></th>
    </tr>
    <tr>
        <th colspan="4"  ></th>
    </tr>
    </tfoot>
</table>
</body>
</html>


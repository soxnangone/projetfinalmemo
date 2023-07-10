<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Naissance
 *
 * @property int $id
 * @property string $num_registre
 * @property int $annee
 * @property string $nom_enfant
 * @property string $prenom_enfant
 * @property string $sexe
 * @property string $heure_naiss
 * @property Carbon $date_naiss
 * @property string $lieu_naiss
 * @property int $codeforme
 * @property int|null $id_pere
 * @property int|null $id_mere
 * @property int $id_declarant
 * @property int $id_validant
 * @property int|null $id_user
 * @property int|null $id_temoins1
 * @property int|null $id_temoins2
 * @property Carbon $date_declaration
 * @property string $type_dec
 * @property string|null $num_jugement
 * @property Carbon $date_jugement
 * @property string $nom_tribunal
 * @property string $mention
 * @property int $validation
 *
 * @property Declarant $declarant
 * @property Forma $forma
 * @property Mere|null $mere
 * @property Pere|null $pere
 * @property Temoin|null $temoin
 * @property Utilisateur|null $utilisateur
 *
 * @package App\Models
 */
class Naissance extends Model
{
	protected $table = 'naissances';
	public $timestamps = false;

	protected $casts = [
		'annee' => 'int',
		'codeforme' => 'int',
		'id_pere' => 'int',
		'id_mere' => 'int',
		'id_declarant' => 'int',
		'id_validant' => 'int',
		'id_user' => 'int',
		'id_temoins1' => 'int',
		'id_temoins2' => 'int',
		'validation' => 'int'
	];

	protected $dates = [
		'date_naiss',
		'date_declaration',
		'date_jugement'
	];

	protected $fillable = [
		'num_registre',
		'annee',
		'nom_enfant',
		'prenom_enfant',
		'sexe',
		'heure_naiss',
		'date_naiss',
		'lieu_naiss',
		'codeforme',
		'id_pere',
		'id_mere',
		'id_declarant',
		'id_validant',
		'id_user',
		'id_temoins1',
		'id_temoins2',
		'date_declaration',
		'type_dec',
		'num_jugement',
		'date_jugement',
		'nom_tribunal',
		'mention',
		'validation'
	];

	public function declarant()
	{
		return $this->belongsTo(Declarant::class, 'id_declarant');
	}

	public function forma()
	{
		return $this->belongsTo(Forma::class, 'codeforme');
	}

	public function mere()
	{
		return $this->belongsTo(Mere::class, 'id_mere');
	}

	public function pere()
	{
		return $this->belongsTo(Pere::class, 'id_pere');
	}

	public function temoin()
	{
		return $this->belongsTo(Temoin::class, 'id_temoins1');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_user');
	}
}

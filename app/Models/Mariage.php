<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mariage
 * 
 * @property int $id
 * @property string $nin_epoux
 * @property string $nom_epoux
 * @property string $prenom_epoux
 * @property Carbon $date_naiss_epoux
 * @property string $lieu_naiss_epoux
 * @property string $domicile_epoux
 * @property string $proffession_epoux
 * @property string $situation_mat_epoux
 * @property string $nin_epouse
 * @property string $nom_epouse
 * @property string $prenom_epouse
 * @property Carbon $date_naiss_epouse
 * @property string $lieu_naiss_epouse
 * @property string $domicile_epouse
 * @property string $proffession_epouse
 * @property string $situation_mat_epouse
 * @property int $id_parentepoux
 * @property int $id_parentepouse
 * @property int $id_t1
 * @property int $id_t2
 * @property int $id_t3
 * @property int $id_t4
 * @property int $codecentre
 * @property int $id_officier
 * @property Carbon $date_declaration
 * @property Carbon $date_de_mariage
 * @property string $heure_de_mariage
 * @property string $option
 * @property string $regime
 * @property string $dot
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Mariage extends Model
{
	protected $table = 'mariages';

	protected $casts = [
		'id_user' => 'int',
		'id_t1' => 'int',
		'id_t2' => 'int',
		'id_t3' => 'int',
		'id_t4' => 'int',
		'id_epoux' => 'int',
		'id_epouse' => 'int',
		'id_officier' => 'int'
	];

	protected $dates = [
		
		'date_dec',
		'datem'
	];

	protected $fillable = [
		'id_t1',
		'id_t2',
		'id_t3',
		'id_t4',
		'id_epoux',
		'id_epouse',
		'id_user',
		'id_officier',
		'date_dec',
		'datem',
		'heurem',
		'lieum',
		'option',
		'regime',
		'dot',
		'validation'
	];

	public function epouse()
	{
		return $this->belongsTo(Epouse::class, 'id_epouse');
	}

	public function epoux()
	{
		return $this->belongsTo(Epoux::class, 'id_epoux');
	}

	public function temoin()
	{
		return $this->belongsTo(Temoin::class, 'id_temoin');
	}
	public function officier()
	{
		return $this->belongsTo(Officier::class, 'id_officier');
	}

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'id_user');
	}
}

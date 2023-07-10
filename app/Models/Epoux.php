<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Epoux
 * 
 * @property int $id
 * @property string|null $nin_epoux
 * @property string|null $nom_epoux
 * @property string|null $prenom_epoux
 * @property Carbon|null $date_naiss_epoux
 * @property string|null $lieu_naiss_epoux
 * @property string|null $domicile_epoux
 * @property string|null $profession_epoux
 * 
 * @property Collection|Mariage[] $mariages
 *
 * @package App\Models
 */
class Epoux extends Model
{
	protected $table = 'epouxs';
	public $timestamps = false;

	protected $dates = [
		'date_naiss_epoux'
	];

	protected $fillable = [
		'nin_epoux',
		'nom_epoux',
		'prenom_epoux',
		'date_naiss_epoux',
		'lieu_naiss_epoux',
		'domicile_epoux',
		'profession_epoux',
		'situation_mat_epoux'
	];

	public function mariages()
	{
		return $this->hasMany(Mariage::class, 'id_epoux');
	}
}

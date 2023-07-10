<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Epouse
 * 
 * @property int $id
 * @property string|null $nin_epouse
 * @property string|null $nom_epouse
 * @property string|null $prenom_epouse
 * @property Carbon|null $date_naiss_epouse
 * @property string|null $lieu_naiss_epouse
 * @property string|null $domicile_epouse
 * @property string|null $profession_epouse
 * 
 * @property Collection|Mariage[] $mariages
 *
 * @package App\Models
 */
class Epouse extends Model
{
	protected $table = 'epouses';
	public $timestamps = false;

	protected $dates = [
		'date_naiss_epouse'
	];

	protected $fillable = [
		'nin_epouse',
		'nom_epouse',
		'prenom_epouse',
		'date_naiss_epouse',
		'lieu_naiss_epouse',
		'domicile_epouse',
		'profession_epouse',
		'situation_mat_epouse'
	];

	public function mariages()
	{
		return $this->hasMany(Mariage::class, 'id_epouse');
	}
}

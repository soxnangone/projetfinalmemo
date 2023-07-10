<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Declarant
 * 
 * @property int $id
 * @property string $nin_declarant
 * @property string $nom_declarant
 * @property string $prenom_declarant
 * @property Carbon $date_naissd
 * @property string $lieu_naissd
 * @property string $domicile_declarant
 * @property string $profession_declarant
 * 
 * @property Collection|Naissance[] $naissances
 *
 * @package App\Models
 */
class Declarant extends Model
{
	protected $table = 'declarants';
	public $timestamps = false;

	protected $dates = [
		'date_naissd'
	];

	protected $fillable = [
		'nin_declarant',
		'nom_declarant',
		'prenom_declarant',
		'date_naissd',
		'lieu_naissd',
		'domicile_declarant',
		'profession_declarant'
	];

	public function naissances()
	{
		return $this->hasMany(Naissance::class, 'id_declarant');
	}
}

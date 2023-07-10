<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Temoin
 * 
 * @property int $id
 * @property string|null $nin
 * @property string|null $nom
 * @property string|null $prenom
 * @property Carbon|null $date_naissance
 * @property string|null $lieu_naissance
 * @property string|null $domicile
 * @property string|null $profession
 * 
 * @property Collection|Mariage[] $mariages
 *
 * @package App\Models
 */
class Temoin extends Model
{
	protected $table = 'temoins';
	public $timestamps = false;

	protected $dates = [
		'date_naissance'
	];

	protected $fillable = [
		'nin',
		'nom',
		'prenom',
		'date_naissance',
		'lieu_naissance',
		'domicile',
		'profession'
	];

	public function mariages()
	{
		return $this->hasMany(Mariage::class, 'id_temoins1');
	}
}

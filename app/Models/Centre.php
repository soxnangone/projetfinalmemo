<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Centre
 * 
 * @property int $id
 * @property string $nom_centre
 * @property string $type_centre
 * @property int $codeloc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Localite $localite
 * @property Collection|Naissance[] $naissances
 *
 * @package App\Models
 */
class Centre extends Model
{
	protected $table = 'centres';

	protected $casts = [
		'codeloc' => 'int'
	];

	protected $fillable = [
		'nom_centre',
		'type_centre',
		'codeloc'
	];

	public function localite()
	{
		return $this->belongsTo(Localite::class, 'codeloc');
	}

	public function naissances()
	{
		return $this->hasMany(Naissance::class, 'codecentre');
	}
}

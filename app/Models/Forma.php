<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Forma
 * 
 * @property int $id
 * @property string $nom_formation
 * 
 * @property Collection|Naissance[] $naissances
 *
 * @package App\Models
 */
class Forma extends Model
{
	protected $table = 'formas';
	public $timestamps = false;

	protected $fillable = [
		'nom_formation'
	];

	public function naissances()
	{
		return $this->hasMany(Naissance::class, 'codeforme');
	}
}

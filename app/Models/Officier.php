<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Officier
 * 
 * @property int $id
 * @property string|null $nom_officier
 * @property string|null $prenom_officier
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Mariage[] $mariages
 *
 * @package App\Models
 */
class Officier extends Model
{
	protected $table = 'officiers';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nom_officier',
		'prenom_officier'
	];

	public function mariages()
	{
		return $this->hasMany(Mariage::class, 'id_validant');
	}
}

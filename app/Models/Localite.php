<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Localite
 * 
 * @property int $id
 * @property string $nomloc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Centre[] $centres
 * @property Collection|Forma[] $formas
 *
 * @package App\Models
 */
class Localite extends Model
{
	protected $table = 'localites';

	protected $fillable = [
		'nomloc'
	];

	public function centres()
	{
		return $this->hasMany(Centre::class, 'codeloc');
	}

	public function formas()
	{
		return $this->hasMany(Forma::class, 'codeloc');
	}
}

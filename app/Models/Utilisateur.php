<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateur
 *
 * @property int $id
 * @property string|null $nin
 * @property string $name
 * @property string $prenom
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $poste
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $adresse
 * @property string $telephone
 * @property int $Statut
 *
 * @property Mariage $mariages
 *
 * @package App\Models
 */
class Utilisateur extends Model  implements Authenticatable
{
    use BasicAuthenticatable;
	protected $table = 'utilisateurs';

	protected $casts = [
		'Statut' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nin',
		'name',
		'prenom',
		'username',
		'password',
		'email',
		'poste',
		'adresse',
		'telephone',
		'Statut'
	];

	public function mariage()
	{
		return $this->hasOne(Mariage::class, 'id_user');
	}
}

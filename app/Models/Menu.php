<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 * 
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property int $ordinal
 * @property string $parent_status
 * @property int $parent_id
 * @property int $permission_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Menu $menu
 * @property Permission $permission
 * @property Collection|Menu[] $menus
 *
 * @package App\Models
 */
class Menu extends Model
{
	protected $table = 'menu';

	protected $casts = [
		'ordinal' => 'int',
		'parent_id' => 'int',
		'permission_id' => 'int'
	];

	protected $fillable = [
		'name',
		'url',
		'icon',
		'ordinal',
		'parent_status',
		'parent_id',
		'permission_id'
	];

	public function menu()
	{
		return $this->belongsTo(Menu::class, 'parent_id');
	}

	public function permission()
	{
		return $this->belongsTo(Permission::class);
	}

	public function menus()
	{
		return $this->hasMany(Menu::class, 'parent_id');
	}
}

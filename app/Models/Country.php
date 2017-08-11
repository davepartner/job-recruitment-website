<?php 


namespace App\Models;

 
/**
* Extend eloquent model class 
* read more https://laravel.com/docs/5.4/eloquent
*/
use Illuminate\Database\Eloquent\Model;
/**
* To enable CakePHP's ORM, uncomment the line below
* Read more => https://book.cakephp.org/3.0/en/orm.html 
*/

//use Cake\ORM\TableRegistry; 


class Country extends Model
{
	
	//optional: define table name if different from 'countries'
	protected $table = 'countries';

	public $timestamps = false;

	protected $fillable = [
		'id',
		'code',
		'name'
	];

	
	//every user belongs to a country
	public function users(){
		return $this->hasMany('App\Models\User');
	}
	
}
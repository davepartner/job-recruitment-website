<?php 


namespace App\Models;

 
/**
* Extend eloquent model class 
* read more https://laravel.com/docs/5.1/eloquent
*/
use Illuminate\Database\Eloquent\Model;
/**
* To enable CakePHP's ORM, uncomment the line below
* Read more => https://book.cakephp.org/3.0/en/orm.html 
*/

//use Cake\ORM\TableRegistry; 


class Skill extends Model
{
	
	//optional: define database table name if different from 'books'
	protected $table = 'skills';
	
	protected $fillable = [
		'id',
		'name',
		'description',
		'url'
	];

	/**
	* Every book belongs to a user. 
	* That is,  books table has a user_id column which refers to the id of the user
	* So let's define the relationship below
	*/

	
	public function users(){
		return $this->belongsToMany('App\Models\User')->withPivot('description', 'url')->withTimestamps();
	}
	
	
	
}
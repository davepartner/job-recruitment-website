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


class SkillUser extends Model
{
	
	//optional: define database table name if different from 'books'
	protected $table = 'skill_user';
	
	protected $fillable = [
		'id',
		'user_id',
		'skill_id',
		'description',
		'url',
	];

	
	
	
	
}
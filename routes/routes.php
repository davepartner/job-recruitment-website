<?php
 
 //always import middlewares you wish to use
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;
use App\Controllers;
 /*
$app->get('/', function($request, $response){
		//return a text
		//return 'home';
		
		//return a view
		return $this->view->render($response, 'home.twig');
	}); */
	

//home page
$app->get('/', 'PostsController:index')->setName('home');
//about page
$app->get('/about', 'HomeController:about' )->setName('about');




//GuestMiddleware group
$app->group('', function ()  use ($app) {
$app->get('/auth/signup', 'AuthController:getSignup')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignup');

//Handle POST and GET requests for signin, instead of doing it seperately as above
$app->map(['POST','GET'], '/auth/signin', 'AuthController:signin')->setName('auth.signin');

$app->map(['POST','GET'],'/auth/password/forgot', 'AuthController:forgotPassword')->setName('auth.password.forgot');

})->add(new GuestMiddleware($container));




//AuthMiddleware group
$app->group('', function ()  use ($app) {

//change password
$app->map(['POST', 'GET'], '/auth/password/change', 'PasswordController:changePassword')->setName('auth.password.change');

$app->map(['POST', 'GET'], '/auth/password/reset', 'PasswordController:resetPassword')->setName('auth.password.reset');

$app->get('/auth/signout', 'AuthController:getSignout')->setName('auth.signout');


//roles
$app->get('/roles/view/{id}', 'RolesController:view')->setName('roles.view');
$app->get('/roles/index', 'RolesController:index')->setName('roles.index');
$app->map(['POST', 'GET'],'/roles/add', 'RolesController:add')->setName('roles.add');
$app->map(['POST', 'GET'],'/roles/edit/{id}', 'RolesController:edit')->setName('roles.edit');
$app->get('/roles/delete/{id}', 'RolesController:delete')->setName('roles.delete');

//users
$app->get('/users/view/{id}', 'UsersController:view')->setName('users.view');
$app->get('/users/index', 'UsersController:index')->setName('users.index');
$app->map(['POST', 'GET'],'/users/edit/{id}', 'UsersController:edit')->setName('users.edit');
$app->get('/users/delete/{id}', 'UsersController:delete')->setName('users.delete');


//post routes
$app->get('/posts/index[/{user_id}]', 'PostsController:index')->setName('posts.index'); //Optional user_id parameter
$app->map(['POST', 'GET'], '/posts/add/', 'PostsController:add')->setName('posts.add');
$app->map(['POST', 'GET'], '/posts/edit/{id}', 'PostsController:edit')->setName('posts.edit');
$app->get('/posts/view/{id}', 'PostsController:view')->setName('posts.view');
$app->get('/posts/delete/{id}', 'PostsController:delete')->setName('posts.delete');




//Countries routes
$app->get('/countries/index', 'CountriesController:index')->setName('countries.index'); //Optional user_id parameter
$app->map(['POST', 'GET'], '/countries/add/', 'CountriesController:add')->setName('countries.add');
$app->map(['POST', 'GET'], '/countries/edit/{id}', 'CountriesController:edit')->setName('countries.edit');
$app->get('/countries/view/{id}', 'CountriesController:view')->setName('countries.view');
$app->get('/countries/delete/{id}', 'CountriesController:delete')->setName('countries.delete');



 
//searches routes
$app->get('/searches/index', 'SearchesController:index')->setName('searches.index'); //Optional user_id parameter
$app->get('/searches/view/{id}', 'SearchesController:view')->setName('searches.view');


})->add(new AuthMiddleware($container));



 
//states routes
$app->get('/states/index', 'StatesController:index')->setName('states.index'); //Optional user_id parameter
$app->map(['POST', 'GET'], '/states/add/', 'StatesController:add')->setName('states.add');
$app->map(['POST', 'GET'], '/states/edit/{id}', 'StatesController:edit')->setName('states.edit');
$app->get('/states/view/{id}', 'StatesController:view')->setName('states.view');
$app->get('/states/delete/{id}', 'StatesController:delete')->setName('states.delete');


 
//skills routes
$app->get('/skills/index[/{id}]', 'SkillsController:index')->setName('skills.index'); //Optional user_id parameter
$app->map(['POST', 'GET'], '/skills/add/', 'SkillsController:add')->setName('skills.add');
$app->map(['POST', 'GET'], '/skills/edit/{id}', 'SkillsController:edit')->setName('skills.edit');
$app->get('/skills/view/{id}', 'SkillsController:view')->setName('skills.view');
$app->get('/skills/delete/{id}', 'SkillsController:delete')->setName('skills.delete');


//search
$app->map(['POST', 'GET'], '/searches/add/', 'SearchesController:add')->setName('searches.add');


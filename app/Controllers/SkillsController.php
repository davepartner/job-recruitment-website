<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
use App\Models\Skill;
use Respect\Validation\Validator as v; 

class SkillsController extends Controller{
	
	/**
	* List all users
	* 
	* @return
	*/
	public function index($request, $response,  $args){

        //find all skills by the user with this ID
        if(isset($args['id'])){
             //get the user's details
	          $user = User::find($args['id']);
			  $skills = $user->skills();
              return $this->view->render($response,'skills/index.twig', ['skills'=>$skills, 'user'=>$user]);
        }else{
            $skills = Skill::all();
            return $this->view->render($response,'skills/index.twig', ['skills'=>$skills]);
        }

	}



	/**
	* Display a skill
	* 
	* @return
	*/
	public function view($request, $response, $args){
	
	    $skill = Skill::find( $args['id']);
		
		return $this->view->render($response,'skills/view.twig', ['skill'=>$skill]);
		
	}


	
	/**
	* Create A New skill
	* 
	* @return
	*/
	public function add($request, $response,  $args){
	
        if($request->isPost()){
           
            /**
            * validate input before submission
            * @var 
            * 
            */ 
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()	
            ]);


		//redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $response->withRedirect($this->router->pathFor('skills/add.twig')); 
		}
		
            $skill = Skill::create([
                'name' => $request->getParam('name'),
                'description' => $request->getParam('description'),
                'url' => $request->getParam('url')
            ]);

                $this->flash->addMessage('success', 'skill Added Successfully');
                //redirect to eg. skills/view/8 
                return $response->withRedirect($this->router->pathFor('skills.view', ['id'=>$skill->id]));
           
        }
		return $this->view->render($response,'skills/add.twig');
		
	}

    
	
	/**
	* Edit skill
	* 
	* @return
	*/
	public function edit($request, $response,  $args){
	
              //find the skill
            $skill = Skill::find( $args['id']);

			//only admin and the person that created the skill can edit or delete it.
			if(($this->auth->user()->id != $skill->user_id) AND ($this->auth->user()->role_id > 2) ){
                
			$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			return $this->view->render($response,'skills/edit.twig', ['skill'=>$skill]);

			}

        //if form was submitted
        if($request->isPost()){
        
         $validation = $this->validator->validate($request, [
                'name' => v::notEmpty()
            ]);
        //redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $this->view->render($response,'skills/edit.twig', ['skill'=>$skill]);
		}
		
            //save Data
            $skill =  Skill::where('id', $args['id'])
                            ->update([
                                'name' => $request->getParam('name'),
                                'url' => $request->getParam('url'),
                                'description' => $request->getParam('description')
                                ]);
            
            if($skill){
                $this->flash->addMessage('success', 'skill Updated Successfully');
                //redirect to eg. skills/view/8 
                return $response->withRedirect($this->router->pathFor('skills.view', ['id'=>$args['id']]));
            }
        }
        
	    
		return $this->view->render($response,'skills/edit.twig', ['skill'=>$skill]);
		
	}


/**
	* Delete a skill
	* 
	* @return
	*/
	public function delete($request, $response,  $args){
		$skill = Skill::find( $args['id']);

		//only admin and the person that created the skill can edit or delete it.
			if(($this->auth->user()->id != $skill->user_id) AND ($this->auth->user()->role_id > 2) ){
                
			$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			return $this->view->render($response,'skills/edit.twig', ['skill'=>$skill]);

			}


		if($skill->delete()){
			$this->flash->addMessage('success', 'skill Deleted Successfully');
			return $response->withRedirect($this->router->pathFor('skills.index', ['user_id'=>$this->auth->user()->id]));
		}
	}

}
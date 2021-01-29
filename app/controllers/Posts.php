<?php
class Posts extends  Controller {
	private $postModel;
	
	public function __construct() {
		$this->postModel = $this->model('Post');
	}
	
	public function index()
	{
		$posts = $this->postModel->findAllPosts();
		$data = ['posts' => $posts,];
		
		$this->view('posts/index', $data);
	}
	
	public function create() {
	$data = [];
	
	$this->view('posts/create', $data);
	}
	
	public function update() {
	
	}
	
	public function delete() {
	
	}
}
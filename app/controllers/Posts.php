<?php
class Posts extends  Controller
{
	private $postModel;

	public function __construct()
	{
		$this->postModel = $this->model('Post');
	}

	public function index()
	{
		$posts = $this->postModel->findAllPosts();
		$data = ['posts' => $posts,];

		$this->view('posts/index', $data);
	}

	public function create()
	{
		if (!isLoggedIn()) {
			header('Location: ' . URLROOT . '/posts');
		}

		$data = [
			'title' => '',
			'body' => '',
			'titleError' => '',
			'bodyError' => '',
		];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				'user_id' => $_SESSION['user_id'],
				'title' => trim($_POST['title']),
				'body' => trim($_POST['body']),
				'titleError' => '',
				'bodyError' => '',
			];

			if(empty($data['title'])) {
				$data['titleError'] = 'The title of a post cannot be empty';
			}

			if(empty($data['body'])) {
				$data['bodyError'] = 'The body of a post cannot be empty';
			}

			if (empty($data['titleError']) && empty($data['bodyError'])) {
				if ($this->postModel->addPost($data)) {
					header('Location: ' . URLROOT . 'posts');
				} else {
					die("Something went wrong, please try again!");
				}
			} else {
				$this->view('posts/create', $data);
			}

		}

		$this->view('posts/create', $data);
	}

	public function update()
	{
	}

	public function delete()
	{
	}
}

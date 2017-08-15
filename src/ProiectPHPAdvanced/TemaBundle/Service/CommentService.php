<?php
	/**
	 * Created by PhpStorm.
	 * User: root
	 * Date: 8/5/17
	 * Time: 5:27 PM
	 */
	
	namespace ProiectPHPAdvanced\TemaBundle\Service;
	
	
	use ProiectPHPAdvanced\TemaBundle\Repository\CommentsRepository;
	
	class CommentService
	{
		private $commentsRepository;
		
		public function __construct(CommentsRepository $commentsRepository)
		{
			$this->commentsRepository = $commentsRepository;
		}
		
		public function commentsAction($action, $content =null,$id = null)
		{
			if($action =='add')
			{
				$this->commentsRepository->addComment($content,$id);
			}
			if($action =='get')
			{
			
			}
		
		}
	}
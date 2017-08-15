<?php
	/**
	 * Created by PhpStorm.
	 * User: root
	 * Date: 8/5/17
	 * Time: 5:27 PM
	 */
	
	namespace ProiectPHPAdvanced\TemaBundle\Service;
	
	
	use ProiectPHPAdvanced\TemaBundle\Entity\Articles;
	
	use ProiectPHPAdvanced\TemaBundle\Repository\ArticlesRepository;
	
	class ArticleService
	{
		private $articlesRepository;
		
		public function __construct(ArticlesRepository $articlesRepository)
		{
			$this->articlesRepository = $articlesRepository;
		}
		
		public function postsAction($action, $content = null)
		{
			
			
			if($action == 'list')
			{
				
				return $this->articlesRepository->getArticles();
				
			}
			if($action == 'one')
			{
				
				var_dump($content);
				return $this->articlesRepository->findOneBy(['id'=>$content]);
			}
		
		}
		
		public function addArticle($articleData){
			
			
			$this->articlesRepository->setArticle($articleData);
			
			
			
		}
		
	}
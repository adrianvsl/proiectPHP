<?php

namespace ProiectPHPAdvanced\TemaBundle\Repository;

use ProiectPHPAdvanced\TemaBundle\Entity\Articles;

/**
 * ArticlesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticlesRepository extends \Doctrine\ORM\EntityRepository
{
	public function getArticles($pagination = null)
	{
		if($pagination == NULL){
		$articles = $this->findAll();
		}
		
		return $articles;
		
	}
	
	public function setArticle($articleData){
		$article = new Articles();
		$article->setTitle($articleData['title']);
		$article->setContent($articleData['content']);
		$article->setUpdated(new \DateTime("now"));
		$article->setCreatedAt(new \DateTime("now"));
		$article->setAuthor("admin");
		$this->_em->persist($article);
		
		// actually executes the queries (i.e. the INSERT query)
		
		
		$this->_em->flush();
	}
	
}

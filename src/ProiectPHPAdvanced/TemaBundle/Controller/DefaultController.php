<?php

namespace ProiectPHPAdvanced\TemaBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use FOS\RestBundle\Controller\Annotations as Rest;
use ProiectPHPAdvanced\TemaBundle\Entity\Articles;
use ProiectPHPAdvanced\TemaBundle\Form\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use ProiectPHPAdvanced\TemaBundle\Service\ArticleService;
use ProiectPHPAdvanced\TemaBundle\Service\CommentService;
use ProiectPHPAdvanced\TemaBundle\Repository\ArticlesRepository;

class DefaultController extends Controller
{
    /**
     * @Route("/temaphp")
     */
    public function indexAction()
    {
		$articles = $this->get('proiect_php_advanced_tema.service.article')->postsAction('list');
	
		return $this->render('ProiectPHPAdvancedTemaBundle:Default:index.html.twig',array('articles'=>$articles));
    }
	/**
	 * @Route("/article")
	 *
	 */
	public function articleAction(Request $request)
	{
		$data = $request->query->all();
		
		
		if(isset($data['id'])) {
			
			$articles = $this->get('proiect_php_advanced_tema.service.article')->postsAction('one', $data['id']);
			
		}else{
			$articles=null;
		}
		if(isset($articles)) {
			
			$defaultData = array('message' => 'Article Added');
			$form = $this->createFormBuilder($defaultData)
				->add('title', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
				->add('comment', TextareaType::class)
				->add('submit', SubmitType::class)
				->getForm();
			
			$form->handleRequest($request);
			
			if ($form->isSubmitted() && $form->isValid()) {
				// data is an array with "name", "email", and "message" keys
				$formdata = $form->getData();
				
				$this->get('proiect_php_advanced_tema.service.comment')->commentsAction('add',$formdata,$data['id']);
			}
			return $this->render('ProiectPHPAdvancedTemaBundle:Default:article.html.twig',
				array('article' => $articles,'form'=> $form->createView()));
			
		}else{
			return $this->render('ProiectPHPAdvancedTemaBundle:Default:noarticle.html.twig',
				array('article' => $articles));
		}
		
	}
	/**
	 * @Route("/admin")
	 */
	public function adminAction()
	{
		$articles = $this->get('proiect_php_advanced_tema.service.article')->postsAction('list');
		//	var_dump($articles);
		return $this->render('ProiectPHPAdvancedTemaBundle:Default:admin.html.twig',array('articles'=>$articles));
	}
	
	/**
	 * @Route("/admin/addarticle")
	 */
	public function adminArticleAction(Request $request)
	{
		$defaultData = array('message' => 'Article Added');
		$form = $this->createFormBuilder($defaultData)
			->add('title', \Symfony\Component\Form\Extension\Core\Type\TextType::class)
			->add('content', TextareaType::class)
			->add('submit', SubmitType::class)
			->getForm();
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			// data is an array with "name", "email", and "message" keys
			$data = $form->getData();
			
			$this->get('proiect_php_advanced_tema.service.article')->addArticle($data);
		}
		//return $this->render('ProiectPHPAdvancedTemaBundle:ProiectPHPAdvancedTemaBundle:adminaddarticle.html.twig', array('form' => $form->createView()));
			return $this->render('ProiectPHPAdvancedTemaBundle:Default:adminaddarticle.html.twig', array('form' => $form->createView()));
	}
}

<?php
	
	namespace ProiectPHPAdvanced\TemaBundle\Form;
	/**
	 * Created by PhpStorm.
	 * User: root
	 * Date: 8/5/17
	 * Time: 6:04 PM
	 */
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolverInterface;
	
	class Article extends AbstractType
	{
		
		public function buildForm(FormBuilderInterface $builder, array $options)
		{
			$builder->add('title', 'string', array('label' => 'Title'))
				->add('content', 'string')
				->add('save', 'submit');
		}
		
		public function getName()
		{
			return 'article';
		}
		
		public function setDefaultOptions(OptionsResolverInterface $resolver)
		{
			$resolver->setDefaults(array(
				'data_class' => 'ProiectPHPAdvanced\TemaBundle\Entity\Articles',
			));
		}
		
	}
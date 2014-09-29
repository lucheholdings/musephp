<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * AuthorizationForm 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AuthorizationForm extends AbstractType
{
	/**
	 * buildForm 
	 * 
	 * @param FormBuilder $builder 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
    public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('client_id', 'hidden')
			->add('redirect_uri', 'hidden')
			->add('response_type', 'hidden')
			->add('allow', 'submit')
			->add('deny', 'submit')
		;
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return 'authorization_form';
	}
}


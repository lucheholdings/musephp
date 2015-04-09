<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type\Guesser;
use Clio\Component\Util\Type\MixedType;
use Clio\Component\Exception\UnsupportedException;

/**
 * MixedTypeResolver 
 *   MixedTypeResolver is a ChainResolver which resolver mixed before actual type is resolved. 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MixedTypeResolver extends TypeResolverChain 
{
    private $guesser;

    public function __construct(Guesser $guesser = null)
    {
        $this->guesser = $guesser;
    }
    /**
     * canResolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    public function canResolve($type, array $options = array())
    {
        return ('mixed' == (string)$type) && array_key_exists('data', $options);
    }

	protected function doResolve($type, array $options = array())
	{
		if(('mixed' == (string)$type) && array_key_exists('data', $options)) {
			$data = $options['data'];
		
            $guessed = $this->getGuesser()->guess($data);
            if(!$this->getRootResolver()->canResolve($guessed, $options)) {
                throw new UnsupportedException('MixedTypeResolver cannot guess the type from data. ActualType cannot be found.');
            }

			return $this->getRootResolver()->resolve($guessed, $options);
		}

		throw new UnsupportedException('MixedTypeResolver only support with MixedType and "data" in options.');
	}
    
    public function getGuesser()
    {
        if(!$this->guesser) {
            $this->guesser = SimpleGuesser::create($this->getRootResolver());
        }
        return $this->guesser;
    }
    
    public function setGuesser(Guesser $guesser)
    {
        $this->guesser = $guesser;
        return $this;
    }
}


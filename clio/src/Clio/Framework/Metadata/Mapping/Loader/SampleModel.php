<?php
namespace ;

/**
 * Class 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * 
 * @Solr\Schema("sample_model", version="1.1")
 * @Solr\Field(name="virtual_property", type="string")
 */
class SampleModel 
{
	/**
	 * field 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @Solr\Field(type="int", indexed=false)
	 * @Solr\CopyField(to="virtual_property")
	 */
	protected $field;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
	}
}


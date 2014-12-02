<?php
namespace Clio\Extra\Metadata\Config\Loader\Parser;

class XmlParser implements Parser 
{
	public function parse($data)
	{
		if($this->canParse($data)) {
			throw new \InvalidArgumentException('XMLParser only accept SimpleXMLElement or DOMNode.');
		}

		if($data instanceof DOMNode) {
			$data = simplexml_import_dom($data);
		} 

		return $this->doParse($data);
	}

	protected function doParse(SimpleXmlNode $data)
	{
		// fixme
		throw new \Exception('Not Impl yet');
	}

	/**
	 * canParse 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function canParse($data)
	{
		return ($data instanceof SimpleXMLElement) || ($data instanceof DOMNode);
	}
}


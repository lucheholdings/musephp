ArrayTool Coder
==========


ArrayTool Coder is a Encoder/Decoder tool from/to array and specified coded.

Ex)
  JsonCoder::encode(array) encode array to json
  JsonCoder::decode(json) decode json to array

  XmlCoder::encode(array) encode array to xml
  XmlCoder::decode(xml) decode xml to array


XmlCoder
----

XmlCoder support NodeCoder, which decide the strategy of encoding/decoding with its name.
You can create specified encode/decode logic for each Node type.

    $coder = new XmlCoder();
    $coder->addNodeCoder('node:name', $namespacedCoder);

	$coder->decode('<node:name>xxx</node:noame>');


#### Sample NodeCoder

	class MyNamespacedXmlCoder extends XmlNodeCoder
	{
		public function encode(array $data)
		{
			// Your logic here

			return new XmlNode();
		}

		public function decode($xml)
		{
			// Your logic here

			return array();
		}
	}

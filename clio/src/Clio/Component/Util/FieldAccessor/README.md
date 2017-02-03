# Clio.Component.Pce.FieldAccessor

FieldAccessor is a Package to provide class fields accessor. 



## Usage

	/************** Prepare to build **************/
	// Create ClassMapping 
	$mappingFactory = new BasicMappingFactory();
	$classMapping = $mappingFactory->createClassMapping(new \ReflectionClass('\Namespace\Class'));
	// Set the field "ignore" to be ignored
	$classMapping->getField('ignore')->setIgnore(true);
	
	// support "public_property" and "method" for AccessType
	$propertyAccessorFactory = new PropertyFieldCollectionAccessorFactory(array(
		'public_property' => new PublicPropertyAccessorFactory(),
		'method' => new MethodPropertyAccessorFactory(),
	));

	/************** Build Accessor **************/
	$accessorBuilder = new LayerFieldAccessorBuilder();
	$accessorBuilder
		->setClassMapping($classMapping)
		->addFieldLayer($propertyAccessorFactory)
		->addFieldLayer(new CustomAccessorFactory(), 128)
	;

	$fieldAccessor = $accessorBuilder->build();

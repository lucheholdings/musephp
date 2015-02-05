Muse Erato Project
=========


## Description

Muse Erato is a framework library focused on "SCHEMA."
Erato provides Schema-Based Metadata, such as SchemaAccessor, definition of Serializer, Normalizer and Schemifier.

The main component of the Erato is SchemaRegistry, which is a Registry of Schema-Based Metadata.
Each class or array has different schema, and so, Erato create the Metadata of it, and decorate the Metadata with component Mappings.

You can add any "Schema-Based" information into the Metadata as Mapping.

## Idea of Usage

    $classMetadata = $registry->get('Namespaced\Class\Path');

    if($clasMetadata->hasMapping('accessor')) {
         $schemaAccessor = $classMetadata->getMapping('accessor')->getAccessor();

         // Now you can use the class accessor
         // Show the fields(properties) on the schema
         echo $schemaAccessor->getFieldNames();

         // Set "Foo" on field "foo"
         $schemaAccessor->set($data, 'foo', 'Foo');

         // Instance based accessor
         $dataAccessor = $classMetadata->getMapping('accessor')->getAccessor($data);

         // So now the data accessor knows the data container
         $dataAccessor->set('foo', 'Foo');
    }

    // Normalize data?
    $normalizeInfo = $classMetadata->getMapping('normalizer');
    $data = $normalizer->normalize($data);

    $data = $normalizer->denormalize($data, $normalizeInfo);
    // or with default normalizer
    $data = $classMetadata->getMapping('normalizer')->normalize($data);

    // Schimifier
    $data = $classMetadata->getMapping('schemifier')->schemify(array('foo' => 'Foo'));
    $data = $classMetadata->getMapping('schemifier')->schemify(new Bar('foo' => 'Foo'));
    $data = $classMetadata->getMapping('schemifier')->schemify(new Hoge('foo' => 'Foo'));

    // Construct new Data
    $data = $classMetadata->construct(array('arg1', 'arg2'));

## Example - append Doctrine Information 

    $classMetadata->setMapping('doctrine', new DoctrineMapping($doctrineMetadata));
    // or use MappingFactory 
    
    $doctrineMappingFactory = new DoctrineMappingFactory($doctrine->getManager('default'));
    $metadataFactory = new GuessNamedSchemaMetadataFactory(
            array('array.schema.name' => 'array'), 
            new MappingFacotryCollection(array($doctrineMappingFactory))
        );
    
    $registry = new MetadataRegistry();
    $registry->addLoader(
            new MappedFactoryLoader($metadataFactory)
        );

    // Get Metadata with "doctrine" mapping if the Schema is supported by Doctrine 
    $metadata = $registry->get('Namespaced\Class\Name');

    $doctrineManager = $metadata->getMapping('doctrine')->getManager();
    $doctrineRepository = $metadata->getMapping('doctrine')->getRepository();


## Default Components

We implements components to use Clio Components over Erato.

  * Normalizer
  * Serializer
  * Schemifier
  * Accessor
  * Replacer
  * Merger

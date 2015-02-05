Muse Erato Project
=========


## 詳細

Muse Eratoは、スキーマに着眼したフレームワークライブラリです。
Eratoは、Schema基準となるメタデータ、アクセッサ、やSerializer、Normalizer、Schemifierの定義を設定できます。  

Eratoのメインは、Metadataを登録するSchemaRegistryです。
各クラス・配列の定義は、異なったSchemaを持ちます。そのため、各定義ごとに、Metadataを作成し、また、これをMappingで装飾することができます。


## 使い方

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

## 例） - Doctrine情報の追加

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

Erato上で、以下のClioのコンポーネントが標準で利用できます。

  * Normalizer
  * Serializer
  * Schemifier
  * Accessor
  * Replacer
  * Merger

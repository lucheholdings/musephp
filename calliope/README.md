Muse Calliope Projecct - PHP Usercase dependent Model Framework
====

CalliopeFramework is another Framework to focus on USECASE to map Metadata for each model schema, over EratoFramework.

Calliope is organized by following components.

  * ModelManager : manage access like fetch, save, delete...
  * Connection   : connection to the DataStore Layer as Doctrine, RestClient
  * Schemifier   : Array-to-Object, Object-to-Object converter

Why we need to use this? or why not just use the datastore-layer library? 

If the server is organized one-layer or standalone, and will never scale-up, you do not need to use this.
no. You should never use this framework.

But how many services are running on just a server?
How many services will never ask scale-up? 
If your server get chance to scale-up, is it simple?


If you get the limitation of the server, i'm sure you have to think about the server resource.
And so, you have to think about the organization of the services as well.

...brabrabra

## Idea of Usage

    $manager = $registry->get('nameof_model.in_usage');

	// get metadatas 
	$usecaseMetadata = $manager->getMetadata();
	$eratoSchemaMetadata = $usecaseMetadata->getSchema();

	// Schemify data to the model
	$model = $manager->schemifiy($data);
	// or 
	$model = $usecaseMetadata->getMapping('schemifier')->schemify($data);

	// fetch the data
	$models = $manager->fetch();

	// add filter to fetch
	$manager->getConnection()->filters->onPost(function($event){
		$event->setCondition(array('user_id' => 1));
	});
	// or use FilterClass
	$manager->getConnection()->filters->add(new FetchConditionFilter(array('user_id' => 1)));
	$modelsForUser1 = $manager->fetch();


	// save data - automatically schemify the data.
	$manager->save(array('user_id' => 1));
	$manager->save(new Bar());
	$manager->save(new Hoge());


	// add new Usecase
	$registry->addUsecase('nameof_model.in_usage.rest', new Metadata($schemaMetadata), new RestConnection($restClient));


	// Override Schema-Based mapping
	$usecaseMetadata->setMapping('identifier', new IdentifierMapping());
	// or with inherit
	$usecaseMetadata->setMapping('normalizer', new NormalizerUsecaseMapping());
	$usecaseMetadata->clean();


  
## Components 

 - Core: provides Framework Core Components
 - Adapter : use Calliope on other Frameworks.
 - Bridge : use Libraries on Calliope



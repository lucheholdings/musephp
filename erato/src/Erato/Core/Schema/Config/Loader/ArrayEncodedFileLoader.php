<?php
namespace Erato\Core\Schema\Config\Loader;

abstract class ArrayEncodedFileLoader extends FileLoader
{
    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct(FileLocator $locator)
    {
        parent::__construct();
        $this->parser = new ArrayParser();
    }
}


// SequentialSelectLoader 
SelectLoader
{

}

SequentialLoader::selectEither();

SequentialLoader::merge(array());

LoaderDispatcher

DispatchLoader 
{
    do {
        
    } while($loader->getDispatchIterator()->next());
}

if($loader instanceof LoaderCollection) {
    $iterator = $loader->getDispatchIterator();
    do {
        $iterator->dispatch();
    } while($iterator->next);
} else {
    return $loader->load();
}

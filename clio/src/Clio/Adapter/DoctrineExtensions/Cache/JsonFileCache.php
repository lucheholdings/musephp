<?php
namespace Clio\Adapter\DoctrineExtensions\Cache;

use Doctrine\Common\Cache\FileCache;

/**
 * JsonFileCache 
 * 
 * @uses FileCache
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class JsonFileCache extends FileCache
{
    const EXTENSION = '.json';

     /**
     * {@inheritdoc}
     */
    protected $extension = self::EXTENSION;

    /**
     * {@inheritdoc}
     */
    protected function doFetch($id)
    {
        $filename = $this->getFilename($id);

        if ( ! is_file($filename)) {
            return false;
        }

        $value = json_decode(include $filename);

        if ($value['lifetime'] !== 0 && $value['lifetime'] < time()) {
            return false;
        }

        return $value['data'];
    }

    /**
     * {@inheritdoc}
     */
    protected function doContains($id)
    {
        $filename = $this->getFilename($id);

        if ( ! is_file($filename)) {
            return false;
        }

        $value = json_decode(include $filename);

        return $value['lifetime'] === 0 || $value['lifetime'] > time();
    }

    /**
     * {@inheritdoc}
     */
    protected function doSave($id, $data, $lifeTime = 0)
    {
        if ($lifeTime > 0) {
            $lifeTime = time() + $lifeTime;
        }

        if (is_object($data) && ! method_exists($data, '__set_state')) {
            throw new \InvalidArgumentException(
                "Invalid argument given, JsonFileCache only allows objects that implement __set_state() " .
                "and fully support var_export(). You can use the FilesystemCache to save arbitrary object " .
                "graphs using serialize()/deserialize()."
            );
        }

        $filename   = $this->getFilename($id);
        $filepath   = pathinfo($filename, PATHINFO_DIRNAME);

        if ( ! is_dir($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $value = array(
            'lifetime'  => $lifeTime,
            'data'      => $data
        );

        $code   = json_encode($value);

        return file_put_contents($filename, $code) !== false;
    }
}

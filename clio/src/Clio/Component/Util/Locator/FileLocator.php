<?php
namespace Clio\Component\Util\Locator;

/**
 * FileLocator 
 * 
 * @uses AbstractLocator
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FileLocator extends AbstractLocator
{
	/**
	 * locate 
	 * 
	 * @param mixed $name 
	 * @param mixed $first 
	 * @access public
	 * @return void
	 */
	public function locate($name, $first = true)
	{
        if (empty($name)) {
            throw new \InvalidArgumentException('An empty file name is not valid to be located.');
        }

        if ($this->isAbsolutePath($name)) {
            if (!file_exists($name)) {
                throw new \InvalidArgumentException(sprintf('The file "%s" does not exist.', $name));
            }

            return $name;
        }

        $filepaths = array();

        foreach ($this->roots as $root) {
            if (file_exists($file = $root . DIRECTORY_SEPARATOR . $name)) {
                if (true === $first) {
                    return $file;
                }
                $filepaths[] = $file;
            }
        }

        if (!$filepaths) {
            throw new \InvalidArgumentException(sprintf('The file "%s" does not exist (in: %s).', $name, implode(', ', $this->roots)));
        }

        return array_values(array_unique($filepaths));
	}
}


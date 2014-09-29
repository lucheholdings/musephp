<?php
namespace Melete\Loader;

class CsvFileLoader extends FileLoader 
{
	public function __construct($locator, array $headers, $delimiter = ',', $enclosure = '"', $escape = '\\')
	{
		parent::__construct($locator);

		$this->headers = $headers;

		$this->delimiter = $delimiter;
		$this->enclosure = $enclosure;
		$this->escape = $escape;
	}
	
	public function loadFile($file)
	{
		if (!stream_is_local($file)) {
            throw new InvalidResourceException(sprintf('This is not a local file "%s".', $file));
        }

        if (!file_exists($file)) {
            throw new NotFoundResourceException(sprintf('File "%s" not found.', $file));
        }

        try {
            $file = new \SplFileObject($file, 'rb');
        } catch (\RuntimeException $e) {
            throw new NotFoundResourceException(sprintf('Error opening file "%s".', $file), 0, $e);
        }

        $file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
        $file->setCsvControl($this->delimiter, $this->enclosure, $this->escape);
		
		$contents = array();
        foreach ($file as $data) {
            if (substr($data[0], 0, 1) === '#') {
                continue;
            }

			$key = null;
			$temp = array();
			foreach(array_values($this->headers) as $idx => $header) {
				if('_' == $header) {
					$key = $data[$idx];
				} else if($header && !empty($data[$idx])) {
					$temp[] = urlencode($header).'='.urlencode($data[$idx]);
				}
			}

			if(empty($temp)) {
				continue;
			}
			$content = array();
			parse_str(implode('&', $temp), $content);

			if($key) {
				$contents[$key] = $content;
			} else {
				$contents[] = $content;
			}
        }

        return ArrayLoader::load($contents);
	}
}


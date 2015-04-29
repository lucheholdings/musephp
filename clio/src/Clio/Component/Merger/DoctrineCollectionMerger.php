<?php
namespace Clio\Component\Merger;

class DoctrineCollectionMerger implements Merger
{

	public function merge($oldValue, $newValue)
	{
		$removeSchedules = array_flip($oldValue->getKeys());

		foreach($newValue as $key => $value) {
			if($idx = $oldValue->contains($value)) {
				unset($removeSchedules[$idx]);
			} else {
				$oldValue->add($value);
			}
		}

		foreach($removeSchedules as $key => $nll) {
			$oldValue->remove($key);
		}

		return $oldValue;
	}
}


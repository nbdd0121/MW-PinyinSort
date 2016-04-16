<?php
namespace PinyinSort;

class PinyinCollationNoPrefix extends \Collation {

	private $collation;

	public function __construct() {
		$this->collation = new PinyinCollation();
	}

	private function process($string) {
		if (strpos($string, "\n") !== false) {
			return $string;
		} else {
			$parts = explode(':', $string, 2);
			if (!isset($parts[2]) || !$parts[2]) {
				return $string;
			} else {
				return $parts[1] . "\n" . $string;
			}
		}
	}

	public function getSortKey($string) {
		$string = $this->process($string);
		return $this->collation->getSortKey($string);
	}

	public function getFirstLetter($string) {
		$string = $this->process($string);
		return $this->collation->getFirstLetter($string);
	}
}

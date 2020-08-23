<?php
namespace PinyinSort;

class PinyinCollation extends \Collation {

	public function getSortKey($string) {
		if (strpos($string, "\n") === false) {
			$key = $string;
			$original = $string;
		} else {
			$parts = explode("\n", $string, 2);
			$key = $parts[0];
			$original = $parts[1];
		}

		$key = ucfirst(Converter::zh2pinyin($key));

		return $key . "\n" . $original;
	}

	public function getFirstLetter($string) {
		$firstChar = mb_substr($string, 0, 1, 'UTF-8');
		$pinyin = Converter::zh2pinyin($firstChar);
		return ucfirst($pinyin[0]);
	}
}

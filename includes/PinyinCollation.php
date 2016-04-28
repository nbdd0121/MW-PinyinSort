<?php
namespace PinyinSort;

class PinyinCollation extends \Collation {

	public static function getRawSortKey($string) {
		if (strpos($string, "\n") === false) {
			return $string;
		} else {
			$parts = explode("\n", $string, 2);
			return $parts[0];
		}
	}

	public static function getFinalSortKey($string, $processed) {
		if (strpos($string, "\n") === false) {
			return $processed . "\n" . $string;
		} else {
			$parts = explode("\n", $string, 2);
			return $processed . "\n" . $parts[1];
		}
	}

	public function getSortKey($string) {
		return static::getFinalSortKey(
			$string,
			ucfirst(
				Converter::zh2pinyin(
					static::getRawSortKey($string)
				)
			)
		);
	}

	public function getFirstLetter($string) {
		$firstChar = mb_substr($string, 0, 1, 'UTF-8');
		$pinyin = Converter::zh2pinyin($firstChar);
		return ucfirst($pinyin{0});
	}
}

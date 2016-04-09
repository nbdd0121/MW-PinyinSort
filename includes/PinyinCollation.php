<?php
namespace PinyinSort;

class PinyinCollation extends \Collation {

	public static function onFactory($collationName, &$collationObj) {
		if ($collationName === 'pinyin') {
			$collationObj = new PinyinCollation();
			return true;
		}
		return false;
	}

	public function getSortKey($string) {
		return ucfirst(Converter::zh2pinyin($string));
	}

	public function getFirstLetter($string) {
		$firstChar = mb_substr($string, 0, 1, 'UTF-8');
		$pinyin = Converter::zh2pinyin($firstChar);
		return ucfirst($pinyin{0});
	}
}

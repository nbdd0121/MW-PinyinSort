<?php
namespace PinyinSort;

class Hooks {

	public static function onFactory($collationName, &$collationObj) {
		if ($collationName === 'pinyin') {
			$collationObj = new PinyinCollation();
		} else if ($collationName === 'pinyin-noprefix') {
			$collationObj = new PinyinCollationNoPrefix();
		}
		return true;
	}

}

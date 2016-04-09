# PinyinSort 0.1.0
Add pinyin as a category sorting collation

## Install
* Clone the respository, rename it to PinyinSort and copy to extensions folder
* Add `wfLoadExtension('PinyinSort')`; to your LocalSettings.php
* Add `$wgCategoryCollation = 'pinyin';` to your LocalSettings.php to activate PinyinSort
	* You need to run `updateCollation.php` as an post-requisite for changing collation.
* You are done!

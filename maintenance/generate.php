<?php

// Maintenance script, only runnable from shell
if (php_sapi_name() !== 'cli') {
	exit;
}

function uchr($code) {
	return html_entity_decode('&#' . $code . ';', ENT_NOQUOTES, 'UTF-8');
}

$file = file_get_contents(__DIR__ . '/Unihan_Readings.txt');
$lines = explode("\n", $file);

$output = <<<EOT
<?php
/**
 * Chinese/Pinyin Conversion Table
 *
 * Automatically generated using maintenance/generate.php
 * Do not modify directly!
 *
 */

namespace PinyinSort;

class ConversionTable {
public static \$zh2pinyin = array(

EOT;

foreach ($lines as $line) {
	$line = trim($line);
	// Empty line
	if (!$line) {
		continue;
	}
	// Comment
	if ($line{0} === '#') {
		continue;
	}
	$comp = explode("\t", $line);
	// We only need mandarin
	if ($comp[1] !== 'kMandarin') {
		continue;
	}
	$code = hexdec(str_replace('U+', '', $comp[0]));
	$char = uchr($code);

	$pinyin = str_replace(array('ā', 'á', 'ǎ', 'à'), 'a', $comp[2]);
	$pinyin = str_replace(array('ī', 'í', 'ǐ', 'ì'), 'i', $pinyin);
	$pinyin = str_replace(array('ū', 'ú', 'ǔ', 'ù'), 'u', $pinyin);
	$pinyin = str_replace(array('ē', 'é', 'ě', 'è'), 'e', $pinyin);
	$pinyin = str_replace(array('ō', 'ó', 'ǒ', 'ò'), 'o', $pinyin);
	$pinyin = str_replace(array('ǖ', 'ǘ', 'ǚ', 'ǜ', 'ü'), 'v', $pinyin);

	$output .= "'{$char}' => '{$pinyin}',\n";
}

$output .= ");\n}";
file_put_contents(__DIR__ . '/../includes/ConversionTable.php', $output);

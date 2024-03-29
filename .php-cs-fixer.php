<?php

use PhpCsFixer\Config;
use System\Path\Path;

require_once __DIR__ . '/vendor/autoload.php';

$rules = [
	'@PhpCsFixer' => true,
	'multiline_whitespace_before_semicolons' => false,
	'php_unit_test_class_requires_covers' => false,
	'php_unit_internal_class' => false,
	'concat_space' => ['spacing' => 'one'],
	'ordered_class_elements' => false,
	'php_unit_method_casing' => ['case' => 'snake_case'],
	'explicit_string_variable' => false,
	'blank_line_before_statement' => [
		'statements' => [
			'continue',
			'declare',
			'default',
			'exit',
			'goto',
			'include',
			'include_once',
			'require',
			'require_once',
			'switch',
			'throw',
			'try',
		],
	],
];

return (new Config())
	->setRules($rules)
	->setFinder(Path::getProjectPHPFiles())
	->setIndent("\t")
	->setLineEnding("\r\n");

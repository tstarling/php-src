--TEST--
libxml_set_external_entity_loader() returns previous handler
--SKIPIF--
<?php if (!extension_loaded('dom')) die('skip dom extension not available'); ?>
--FILE--
<?php

class Handler {
	private $name;

	public function __construct($name) {
		$this->name = $name;
	}

	public function handle($public, $system, $context) {
		return null;
	}

	public function __toString() {
		return "Handler#{$this->name}";
	}
}

var_dump(libxml_set_external_entity_loader([new Handler('A'), 'handle']));
print libxml_set_external_entity_loader([new Handler('B'), 'handle'])[0] . "\n";
print libxml_set_external_entity_loader(null)[0] . "\n";
var_dump(libxml_set_external_entity_loader(null));

--EXPECT--
NULL
Handler#A
Handler#B
NULL

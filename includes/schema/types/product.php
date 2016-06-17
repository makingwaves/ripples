<?php
echo json_encode((object) [
	"@context"    => "http://schema.org/",
	"@type"       => "Product",
	"name"        => $value,
	"image"       => "myimage.jpg",
	"description" => "En desc",
	"brand"       => (object) [
		"@type" => "Thing",
		"name"  => "MyBrand"
	]
]);

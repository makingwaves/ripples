<?php
//https://schema.org/Product
echo json_encode((object) [
	"@context"    => "http://schema.org/",
	"@type"       => "Product",
	"name"        => $value,
	"image"       => "http://domain.com/myimage.jpg",
	"description" => "En desc",
	"brand"       => (object) [
		"@type" => "Thing",
		"name"  => "MyBrand"
	]
]);

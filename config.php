<?php

return array(
	'meta_tags' => 'list1,list2', // list of the meta tags that should be converted from comma separated into html lists
	'list_element' => 'ul', // this can be changed between 'ul' for unordered and 'ol' for ordered lists
	'list_class' => 'list', // the class applied to the list object
	'title_element' => 'h3', // this can be changed between 'ul' for unordered and 'ol' for ordered lists
	'title_class' => 'list_title', // the class applied to the header of the list object (auto populated using the metatag title)
	'title_case' => 'true', // metatags are always set to lowercase, so this will change the first letter back to uppercase if desired
	'title_character' => ':', // adds additional characters to the end of the list title
	'item_class' => 'list_item' // the class applied to the individual objects of the list object
);

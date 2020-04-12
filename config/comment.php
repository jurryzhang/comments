<?php

return [

	'models' => [
		'comment' => Jurryzhang\Comment\Models\Comment::class,
		'thumb'   => Jurryzhang\Comment\Models\Thumb::class,
	],

	'table_names' => [
		'comments' => 'comments',
		'thumbs'   => 'thumbs',
	],

];

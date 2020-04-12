<?php

return [

	'models' => [
		'comment' => Spatie\Permission\Models\Comment::class,
		'thumb'   => Spatie\Permission\Models\Thumb::class,
	],

	'table_names' => [
		'comments' => 'comments',
		'thumbs'   => 'thumbs',
	],

];

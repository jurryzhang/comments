<?php

namespace Spatie\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Thumb extends Model {

	protected $guarded = ['id'];

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);

		$this->setTable(config('comment.table_names.thumb'));
	}

	public function model()
	{
		return $this->belongsTo('model');
	}

	public function user(): MorphTo
	{
		return $this->MorphTo('user');
	}
}

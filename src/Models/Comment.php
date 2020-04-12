<?php

namespace Spatie\Permission\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Permission\Traits\HasThumbs;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	use HasThumbs;

	protected $guarded = ['id'];

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);

		$this->setTable(config('comment.table_names.commentss'));
	}

	public function parent(): BelongsTo
	{
		return $this->belongsTo(self::class, 'id', 'parent_id');
	}

	public function children(): HasMany
	{
		return $this->hasMany(self::class, 'parent_id', 'id');
	}

	public function top(): BelongsTo
	{
		return $this->belongsTo(self::class, 'id', 'top_id');
	}

	public function downs(): HasMany
	{
		return $this->hasMany(self::class, 'top_id', 'id');
	}

	public function model()
	{
		return $this->belongsTo('model');
	}

	/**
	 * 评论的被点赞数.
	 */
	public function thumbs(): HasMany
	{
		return $this->HasMany(
			config('comment.models.thumbs'),
			config('comment.table_names.thumbs')
		);
	}

	public function user(): MorphTo
	{
		return $this->MorphTo('user');
	}

}

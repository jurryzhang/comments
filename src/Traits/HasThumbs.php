<?php

namespace Spatie\Permission\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Jurryzhang\Comments\CommentRegistrar;

trait HasThumbs {

	private $thumbClass;

	public function getThumbClass()
	{
		if ( ! isset($this->thumbClass))
		{
			$this->thumbClass = app(CommentRegistrar::class)->getRoleClass();
		}

		return $this->thumbClass;
	}

	/**
	 * A model may have multiple roles.
	 */
	public function thumbs(): HasMany
	{
		return $this->morphToMany(
			config('comment.models.thumb'),
			'model'
		);
	}

}

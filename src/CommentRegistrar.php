<?php

namespace Jurryzhang\Comment;

use Jurryzhang\Comment\Models\Comment;
use Jurryzhang\Comment\Models\Thumb;

class CommentRegistrar {

	/** @var string */
	protected $commentClass;

	/** @var string */
	protected $thumbClass;

	/**
	 * CommentRegistrar constructor.
	 *
	 */
	public function __construct()
	{
		$this->commentClass = config('permission.models.comment');
		$this->thumbClass   = config('permission.models.thumb');
	}

	/**
	 * Get an instance of the permission class.
	 *
	 * @return Comment
	 */
	public function getCommentClass(): Comment
	{
		return app($this->commentClass);
	}

	public function setCommentClass($commentClass)
	{
		$this->commentClass = $commentClass;

		return $this;
	}

	/**
	 * Get an instance of the role class.
	 *
	 * @return Thumb
	 */
	public function getThumbClass(): Thumb
	{
		return app($this->thumbClass);
	}
}

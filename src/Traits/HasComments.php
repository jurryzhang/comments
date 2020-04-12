<?php

namespace Spatie\Permission\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Jurryzhang\Comments\CommentRegistrar;

trait HasComments
{
    private $commentClass;


    public function getCommentClass()
    {
        if (! isset($this->commentClass)) {
            $this->commentClass = app(CommentRegistrar::class)->getCommentClass();
        }

        return $this->commentClass;
    }

    /**
     * A model may have multiple direct permissions.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(
            config('comment.models.comment'),
            'model'
        );
    }
}

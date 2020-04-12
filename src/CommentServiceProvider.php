<?php

namespace Jurryzhang\Comments;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Comment;
use Spatie\Permission\Models\Thumb;

class CommentServiceProvider extends ServiceProvider {

	public function boot(CommentRegistrar $commentRegistrar, Filesystem $filesystem)
	{
		if (function_exists('config_path'))
		{ // function not available and 'publish' not relevant in Lumen
			$this->publishes([
				__DIR__.'/../config/comments.php' => config_path('comments.php'),
			], 'config');

			$this->publishes([
				__DIR__
				.'/../database/migrations/create_comment_tables.php.stub' => $this->getMigrationFileName($filesystem),
			], 'migrations');
		}

		$this->commands([]);

		$this->registerModelBindings();

		$this->app->singleton(CommentRegistrar::class, function ($app) use ($commentRegistrar) {
			return $commentRegistrar;
		});
	}

	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__.'/../config/comments.php',
			'comments'
		);
	}

	protected function registerModelBindings()
	{
		$config = $this->app->config['permission.models'];

		$this->app->bind(Comment::class, $config['comment']);
		$this->app->bind(Thumb::class, $config['thumb']);
	}

	/**
	 * Returns existing migration file if found, else uses the current timestamp.
	 *
	 * @param Filesystem $filesystem
	 *
	 * @return string
	 */
	protected function getMigrationFileName(Filesystem $filesystem): string
	{
		$timestamp = date('Y_m_d_His');

		return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
			->flatMap(function ($path) use ($filesystem) {
				return $filesystem->glob($path.'*_create_comment_tables.php');
			})->push($this->app->databasePath()."/migrations/{$timestamp}_create_comment_tables.php")
			->first();
	}
}

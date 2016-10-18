<?php
/**
 * Danone StrongKids.
 *
 * @since 01/08/16 14:12
 */

namespace Harrysbaraini\Loggable\Models;

use Harrysbaraini\Loggable\Events\ModelWasCreated;
use Harrysbaraini\Loggable\Events\ModelWasUpdated;
use Harrysbaraini\Loggable\Events\ModelWasRemoved;
use Harrysbaraini\Loggable\Events\ModelWasRestored;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Loggable
{
    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            event(new ModelWasCreated($model));
        });

        static::updated(function ($model) {
            event(new ModelWasUpdated($model));
        });

        static::deleted(function ($model) {
            event(new ModelWasRemoved($model));
        });

        static::restored(function ($model) {
            event(new ModelWasRestored($model));
        });
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }
}

<?php
namespace Harrysbaraini\Loggable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Log extends Model
{
    use SoftDeletes;

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [ 'user_id', 'metadata' ];

    /**
     * Date fields.
     *
     * @var array
     */
    protected $dates = [ 'created_at', 'updated_at', 'deleted_at' ];

    /**
     * Casts.
     *
     * @var mixed
     */
    protected $casts = [
        'metadata' => 'object'
    ];

    /**
     * Validation Rules.
     *
     * @var array
     */
    protected $rules = [
        'metadata' => 'required',
        'metadata.ip' => 'required|ip',
        'metadata.action' => 'required|string',
        'metadata.useragent' => 'required|string',
    ];

    /**
     * Each logging entry is associated to an user.
     *
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(config('loggable.user_model'));
    }

    /**
     * Get all of the owning loggable models.
     *
     * @return MorphTo
     */
    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }
}

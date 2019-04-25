<?php

namespace gpibarra\ActivitylogSession\Traits;

use Spatie\Activitylog\ActivitylogServiceProvider;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasActivity
{
    public function actions(): HasManyThrough
    {
        return $this->hasManyThrough(ActivitylogServiceProvider::determineActivityModel(),
                    'gpibarra\ActivitylogSession\Models\TrackerSession',
                    'authenticatable_id',
                    'causer_id')
                ->where('authenticatable_type', static::class)
                ->where('causer_type','gpibarra\ActivitylogSession\Models\TrackerSession')
                    ;
    }
}

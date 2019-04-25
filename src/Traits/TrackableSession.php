<?php

namespace gpibarra\ActivitylogSession\Traits;

use gpibarra\ActivitylogSession\Models\TrackerSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait TrackableSession
{
    /**
     * Get the entity's authentications.
     */
    public function authentications() :MorphMany
    {
        return $this->morphMany(TrackerSession::class, 'authenticatable')->latest('login_at');
    }

    /**
     * Get the entity's last login at.
     */
    public function lastLogin() :?Model
    {
        return $this->authentications()->first();
    }
}

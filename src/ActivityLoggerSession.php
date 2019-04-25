<?php

namespace gpibarra\ActivitylogSession;

use Spatie\Activitylog\ActivityLogger;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Exceptions\CouldNotLogActivity;
use gpibarra\ActivitylogSession\Models\TrackerSession;

class ActivityLoggerSession extends ActivityLogger
{

    protected function normalizeCauser($modelOrId): Model
    {
        if ($modelOrId instanceof Model) {
            return $modelOrId;
        }

        $model = $this->getCauserById($modelOrId);

        if ($model instanceof Model) {
            return $model;
        }

        throw CouldNotLogActivity::couldNotDetermineUser($modelOrId);
    }

    protected function getActivity(): ActivityContract
    {
        if (! $this->activity instanceof ActivityContract) {
            $this->activity = ActivitylogServiceProvider::getActivityModelInstance();
            $this
                ->useLog($this->defaultLogName)
                ->withProperties([])
                ->causedBy($this->getCauserDefault());
        }

        return $this->activity;
    }

    protected function getCauserById($id) :?Model
    {
/*
 * Default Spatie
        $guard = $this->auth->guard($this->authDriver);
        $provider = method_exists($guard, 'getProvider') ? $guard->getProvider() : null;
        $model = method_exists($provider, 'retrieveById') ? $provider->retrieveById($id) : null;
        return $model;
*/
        return TrackerSession::find($id);
    }

    protected function getCauserDefault() :?Model
    {
/*
 * Default Spatie
        return $this->auth->guard($this->authDriver)->user();
*/
        return \Session::get(config('tracker-session.cookie_name_object'));
    }
}

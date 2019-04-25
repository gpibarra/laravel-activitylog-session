<?php

namespace gpibarra\ActivitylogSession\Models;

use Spatie\Activitylog\Traits\CausesActivity;
use gpibarra\TrackerSession\Models\TrackerSession as TrackerSessionModel;

class TrackerSession extends TrackerSessionModel
{
    use CausesActivity;

}

<?php

namespace Samsin33\Foundation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Samsin33\Foundation\Events\EventCreatedCallback;
use Samsin33\Foundation\Events\EventCreatingCallback;
use Samsin33\Foundation\Events\EventDeletedCallback;
use Samsin33\Foundation\Events\EventDeletingCallback;
use Samsin33\Foundation\Events\EventForceDeletedCallback;
use Samsin33\Foundation\Events\EventReplicatingCallback;
use Samsin33\Foundation\Events\EventRestoredCallback;
use Samsin33\Foundation\Events\EventRestoringCallback;
use Samsin33\Foundation\Events\EventRetrievedCallback;
use Samsin33\Foundation\Events\EventSavedCallback;
use Samsin33\Foundation\Events\EventSavingCallback;
use Samsin33\Foundation\Events\EventTrashedCallback;
use Samsin33\Foundation\Events\EventUpdatedCallback;
use Samsin33\Foundation\Events\EventUpdatingCallback;
use Samsin33\Foundation\Traits\CacheTrait;
use Samsin33\Foundation\Traits\DateTrait;
use Samsin33\Foundation\Traits\EventCallbackTrait;
use Samsin33\Foundation\Traits\GuzzleHttpTrait;
use Samsin33\Foundation\Traits\MailerTrait;
use Samsin33\Foundation\Traits\QueueTrait;
use Samsin33\Foundation\Traits\RequestTypeTrait;
use Samsin33\Foundation\Traits\UserSessionTrait;
use Samsin33\Foundation\Traits\ValidationTrait;

abstract class BaseModel extends Model
{
    use HasFactory, CacheTrait, DateTrait, EventCallbackTrait, GuzzleHttpTrait, MailerTrait, QueueTrait, RequestTypeTrait, UserSessionTrait, ValidationTrait;

    protected $dispatchesEvents = [
        'retrieved' => EventRetrievedCallback::class,
        'creating' => EventCreatingCallback::class,
        'created' => EventCreatedCallback::class,
        'updating' => EventUpdatingCallback::class,
        'updated' => EventUpdatedCallback::class,
        'saving' => EventSavingCallback::class,
        'saved' => EventSavedCallback::class,
        'deleting' => EventDeletingCallback::class,
        'deleted' => EventDeletedCallback::class,
        'trashed' => EventTrashedCallback::class,
        'forceDeleted' => EventForceDeletedCallback::class,
        'restoring' => EventRestoringCallback::class,
        'restored' => EventRestoredCallback::class,
        'replicating' => EventReplicatingCallback::class,
    ];

    //---------------------- Events ---------------------------------
    public function savingEvent()
    {
        if (!$this->getSkipValidation()) {
            if (!$this->validateObject()) {
                return false;
            }
        }
        return $this;
    }

    //----------------------- Other Important Functions -------------

    /**
     * @return bool|$this
     */
    public function saveWithoutValidate(): bool|static
    {
        $this->setSkipValidation(true);
        if ($this->save()) {
            $return = $this;
        } else {
            $return = false;
        }
        $this->setSkipValidation(false);
        return $return;
    }
}

<?php

namespace Samsin33\Foundation\Observers;

use Samsin33\Foundation\Models\BaseModel;

class BaseModelObserver
{
    /**
     * @var bool $afterCommit
     */
    public bool $afterCommit = true;

    /**
     * @param BaseModel $baseModel
     * @return void
     */
    public function retrieved(BaseModel $baseModel): void
    {
        $baseModel->retrievedObserverEvent();
    }

    /**
     * @param BaseModel $baseModel
     * @return void
     */
    public function created(BaseModel $baseModel): void
    {
        $baseModel->createdObserverEvent();
    }

    /**
     * @param BaseModel $baseModel
     * @return void
     */
    public function updated(BaseModel $baseModel): void
    {
        $baseModel->updatedObserverEvent();
    }

    /**
     * @param BaseModel $baseModel
     * @return void
     */
    public function saved(BaseModel $baseModel): void
    {
        $baseModel->savedObserverEvent();
    }

    /**
     * @param BaseModel $baseModel
     * @return void
     */
    public function deleted(BaseModel $baseModel): void
    {
        $baseModel->deletedObserverEvent();
    }

    /**
     * @param BaseModel $baseModel
     * @return void
     */
    public function trashed(BaseModel $baseModel): void
    {
        $baseModel->trashedObserverEvent();
    }

    /**
     * @param BaseModel $baseModel
     * @return void
     */
    public function forceDeleted(BaseModel $baseModel): void
    {
        $baseModel->forceDeletedObserverEvent();
    }

    /**
     * @param BaseModel $baseModel
     * @return void
     */
    public function restored(BaseModel $baseModel): void
    {
        $baseModel->restoredObserverEvent();
    }
}

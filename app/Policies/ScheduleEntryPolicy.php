<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ScheduleEntry;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScheduleEntryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ScheduleEntry');
    }

    public function view(AuthUser $authUser, ScheduleEntry $scheduleEntry): bool
    {
        return $authUser->can('View:ScheduleEntry');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ScheduleEntry');
    }

    public function update(AuthUser $authUser, ScheduleEntry $scheduleEntry): bool
    {
        return $authUser->can('Update:ScheduleEntry');
    }

    public function delete(AuthUser $authUser, ScheduleEntry $scheduleEntry): bool
    {
        return $authUser->can('Delete:ScheduleEntry');
    }

    public function restore(AuthUser $authUser, ScheduleEntry $scheduleEntry): bool
    {
        return $authUser->can('Restore:ScheduleEntry');
    }

    public function forceDelete(AuthUser $authUser, ScheduleEntry $scheduleEntry): bool
    {
        return $authUser->can('ForceDelete:ScheduleEntry');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ScheduleEntry');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ScheduleEntry');
    }

    public function replicate(AuthUser $authUser, ScheduleEntry $scheduleEntry): bool
    {
        return $authUser->can('Replicate:ScheduleEntry');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ScheduleEntry');
    }

}
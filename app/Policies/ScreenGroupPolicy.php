<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ScreenGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScreenGroupPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ScreenGroup');
    }

    public function view(AuthUser $authUser, ScreenGroup $screenGroup): bool
    {
        return $authUser->can('View:ScreenGroup');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ScreenGroup');
    }

    public function update(AuthUser $authUser, ScreenGroup $screenGroup): bool
    {
        return $authUser->can('Update:ScreenGroup');
    }

    public function delete(AuthUser $authUser, ScreenGroup $screenGroup): bool
    {
        return $authUser->can('Delete:ScreenGroup');
    }

    public function restore(AuthUser $authUser, ScreenGroup $screenGroup): bool
    {
        return $authUser->can('Restore:ScreenGroup');
    }

    public function forceDelete(AuthUser $authUser, ScreenGroup $screenGroup): bool
    {
        return $authUser->can('ForceDelete:ScreenGroup');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ScreenGroup');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ScreenGroup');
    }

    public function replicate(AuthUser $authUser, ScreenGroup $screenGroup): bool
    {
        return $authUser->can('Replicate:ScreenGroup');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ScreenGroup');
    }

}
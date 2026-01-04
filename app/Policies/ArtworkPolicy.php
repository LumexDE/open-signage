<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Artwork;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtworkPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Artwork');
    }

    public function view(AuthUser $authUser, Artwork $artwork): bool
    {
        return $authUser->can('View:Artwork');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Artwork');
    }

    public function update(AuthUser $authUser, Artwork $artwork): bool
    {
        return $authUser->can('Update:Artwork');
    }

    public function delete(AuthUser $authUser, Artwork $artwork): bool
    {
        return $authUser->can('Delete:Artwork');
    }

    public function restore(AuthUser $authUser, Artwork $artwork): bool
    {
        return $authUser->can('Restore:Artwork');
    }

    public function forceDelete(AuthUser $authUser, Artwork $artwork): bool
    {
        return $authUser->can('ForceDelete:Artwork');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Artwork');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Artwork');
    }

    public function replicate(AuthUser $authUser, Artwork $artwork): bool
    {
        return $authUser->can('Replicate:Artwork');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Artwork');
    }

}
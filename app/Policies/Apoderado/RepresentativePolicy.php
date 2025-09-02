<?php

namespace App\Policies\Apoderado;

use App\Models\Representative;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class RepresentativePolicy
{
    use HandlesAuthorization;

    // The first parameter must be the authenticated user for the guard.
    public function viewAny(Authenticatable $user): bool
    {
        return $user->can('view_any_representative');
    }

    public function view(Authenticatable $user, Representative $representative): bool
    {
        return $user->can('view_representative');
    }

    public function create(Authenticatable $user): bool
    {
        return $user->can('create_representative');
    }

    public function update(Authenticatable $user, Representative $representative): bool
    {
        return $user->can('update_representative');
    }

    public function delete(Authenticatable $user, Representative $representative): bool
    {
        return $user->can('delete_representative');
    }

    public function deleteAny(Authenticatable $user): bool
    {
        return $user->can('delete_any_representative');
    }

    public function forceDelete(Authenticatable $user, Representative $representative): bool
    {
        return $user->can('force_delete_representative');
    }

    public function forceDeleteAny(Authenticatable $user): bool
    {
        return $user->can('force_delete_any_representative');
    }

    public function restore(Authenticatable $user, Representative $representative): bool
    {
        return $user->can('restore_representative');
    }

    public function restoreAny(Authenticatable $user): bool
    {
        return $user->can('restore_any_representative');
    }

    public function replicate(Authenticatable $user, Representative $representative): bool
    {
        return $user->can('replicate_representative');
    }

    public function reorder(Authenticatable $user): bool
    {
        return $user->can('reorder_representative');
    }
}

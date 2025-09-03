<?php

namespace App\Policies;

use App\Models\Cuota;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class CuotaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Authenticatable $user): bool
    {
        return $user->can('view_any_cuota');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Authenticatable $user, Cuota $cuota): bool
    {
        return $user->can('view_cuota');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Authenticatable $user): bool
    {
        return $user->can('create_cuota');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Authenticatable $user, Cuota $cuota): bool
    {
        return $user->can('update_cuota');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Authenticatable $user, Cuota $cuota): bool
    {
        return $user->can('delete_cuota');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(Authenticatable $user): bool
    {
        return $user->can('delete_any_cuota');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(Authenticatable $user, Cuota $cuota): bool
    {
        return $user->can('force_delete_cuota');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(Authenticatable $user): bool
    {
        return $user->can('force_delete_any_cuota');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(Authenticatable $user, Cuota $cuota): bool
    {
        return $user->can('restore_cuota');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(Authenticatable $user): bool
    {
        return $user->can('restore_any_cuota');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(Authenticatable $user, Cuota $cuota): bool
    {
        return $user->can('replicate_cuota');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(Authenticatable $user): bool
    {
        return $user->can('reorder_cuota');
    }
}

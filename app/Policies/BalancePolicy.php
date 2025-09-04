<?php

namespace App\Policies;


use App\Models\Balance;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class BalancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Authenticatable $user): bool
    {
        return $user->can('view_any_balance');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Authenticatable $user, Balance $balance): bool
    {
        return $user->can('view_balance');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Authenticatable $user): bool
    {
        return $user->can('create_balance');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Authenticatable $user, Balance $balance): bool
    {
        return $user->can('update_balance');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Authenticatable $user, Balance $balance): bool
    {
        return $user->can('delete_balance');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(Authenticatable $user): bool
    {
        return $user->can('delete_any_balance');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(Authenticatable $user, Balance $balance): bool
    {
        return $user->can('force_delete_balance');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(Authenticatable $user): bool
    {
        return $user->can('force_delete_any_balance');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(Authenticatable $user, Balance $balance): bool
    {
        return $user->can('restore_balance');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(Authenticatable $user): bool
    {
        return $user->can('restore_any_balance');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(Authenticatable $user, Balance $balance): bool
    {
        return $user->can('replicate_balance');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(Authenticatable $user): bool
    {
        return $user->can('reorder_balance');
    }
}

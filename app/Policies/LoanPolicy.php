<?php

namespace App\Policies;

use App\Models\Loan;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class LoanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Authenticatable $user): bool
    {
        return $user->can('view_any_loan');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Authenticatable $user, Loan $loan): bool
    {
        return $user->can('view_loan');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Authenticatable $user): bool
    {
        return $user->can('create_loan');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Authenticatable $user, Loan $loan): bool
    {
        return $user->can('update_loan');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Authenticatable $user, Loan $loan): bool
    {
        return $user->can('delete_loan');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(Authenticatable $user): bool
    {
        return $user->can('delete_any_loan');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(Authenticatable $user, Loan $loan): bool
    {
        return $user->can('force_delete_loan');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(Authenticatable $user): bool
    {
        return $user->can('force_delete_any_loan');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(Authenticatable $user, Loan $loan): bool
    {
        return $user->can('restore_loan');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(Authenticatable $user): bool
    {
        return $user->can('restore_any_loan');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(Authenticatable $user, Loan $loan): bool
    {
        return $user->can('replicate_loan');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(Authenticatable $user): bool
    {
        return $user->can('reorder_loan');
    }
}

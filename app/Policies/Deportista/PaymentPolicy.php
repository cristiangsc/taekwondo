<?php

namespace App\Policies\Deportista;

use App\Models\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;
class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Authenticatable $user): bool
    {
        return $user->can('view_any_payment');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Authenticatable $user, Payment $payment): bool
    {
        return $user->can('view_payment');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Authenticatable $user): bool
    {
        return $user->can('create_payment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Authenticatable $user, Payment $payment): bool
    {
        return $user->can('update_payment');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Authenticatable $user, Payment $payment): bool
    {
        return $user->can('delete_payment');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(Authenticatable $user): bool
    {
        return $user->can('delete_any_payment');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(Authenticatable $user, Payment $payment): bool
    {
        return $user->can('force_delete_payment');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(Authenticatable $user): bool
    {
        return $user->can('force_delete_any_payment');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(Authenticatable $user, Payment $payment): bool
    {
        return $user->can('restore_payment');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(Authenticatable $user): bool
    {
        return $user->can('restore_any_payment');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(Authenticatable $user, Payment $payment): bool
    {
        return $user->can('replicate_payment');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(Authenticatable $user): bool
    {
        return $user->can('reorder_payment');
    }
}

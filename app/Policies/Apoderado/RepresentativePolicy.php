<?php

namespace App\Policies\Apoderado;

use App\Models\Representative;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepresentativePolicy
{
    use HandlesAuthorization;

    public function viewAny(Representative $user): bool
    {
        return $user->can('view_any_representative');
    }

    public function view(Representative $user, Representative $representative): bool
    {
        return $user->can('view_representative');
    }

    public function create(Representative $user): bool
    {
        return $user->can('create_representative');
    }

    public function update(Representative $user, Representative $representative): bool
    {
        return $user->can('update_representative');
    }

    public function delete(Representative $user, Representative $representative): bool
    {
        return $user->can('delete_representative');
    }

    public function deleteAny(Representative $user): bool
    {
        return $user->can('delete_any_representative');
    }

    public function forceDelete(Representative $user, Representative $representative): bool
    {
        return $user->can('force_delete_representative');
    }

    public function forceDeleteAny(Representative $user): bool
    {
        return $user->can('force_delete_any_representative');
    }

    public function restore(Representative $user, Representative $representative): bool
    {
        return $user->can('restore_representative');
    }

    public function restoreAny(Representative $user): bool
    {
        return $user->can('restore_any_representative');
    }

    public function replicate(Representative $user, Representative $representative): bool
    {
        return $user->can('replicate_representative');
    }

    public function reorder(Representative $user): bool
    {
        return $user->can('reorder_representative');
    }
}

<?php

namespace App\Policies\Deportista;

use App\Models\User;
use App\Models\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Student $student): bool
    {
        return $student->can('view_any_student');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Student $user, Student $student): bool
    {
        return $user->can('view_student');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Student $user): bool
    {
        return $user->can('create_student');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Student $user, Student $student): bool
    {
        return $user->can('update_student');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Student $user, Student $student): bool
    {
        return $user->can('delete_student');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(Student $student): bool
    {
        return $student->can('delete_any_student');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(Student $user, Student $student): bool
    {
        return $user->can('force_delete_student');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(Student $student): bool
    {
        return $student->can('force_delete_any_student');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(Student $user, Student $student): bool
    {
        return $user->can('restore_student');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(Student $student): bool
    {
        return $student->can('restore_any_student');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(Student $user, Student $student): bool
    {
        return $user->can('replicate_student');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(Student $student): bool
    {
        return $student->can('reorder_student');
    }
}

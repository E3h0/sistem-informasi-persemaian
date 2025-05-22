<?php

namespace App\Policies;

use App\Models\PersediaanAlatKerja;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PersediaanAlatKerjaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor() || $user->isViewer();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PersediaanAlatKerja $persediaanAlatKerja): bool
    {
        return $user->isAdmin() || $user->isEditor() || $user->isViewer();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PersediaanAlatKerja $persediaanAlatKerja): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PersediaanAlatKerja $persediaanAlatKerja): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PersediaanAlatKerja $persediaanAlatKerja): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PersediaanAlatKerja $persediaanAlatKerja): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restoreAny(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }
}

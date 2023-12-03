<?php

namespace App\Policies;

use App\Models\PendidikanInstansi;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PendidikanInstansiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PendidikanInstansi $pendidikanInstansi): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PendidikanInstansi $pendidikanInstansi): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PendidikanInstansi $pendidikanInstansi): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PendidikanInstansi $pendidikanInstansi): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PendidikanInstansi $pendidikanInstansi): bool
    {
        return $user->role === 'admin';
    }
}

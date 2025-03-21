<?php

namespace App\Policies;

use App\Models\Offre;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;


class OffrePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Offre $offre): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Offre $offre): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('recruiter');

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Offre $offre): bool
    {
        return $user->hasRole('recruiter') && $user->id === $offre->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Offre $offre): bool
    {
        return $user->hasRole('recruiter') && $user->id === $offre->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function apply(User $user)
    {
        return $user->hasRole('candidate');
    }
}

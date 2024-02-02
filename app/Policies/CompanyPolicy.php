<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function view(User $user, Company $company)
    {
        return $user->company_id === $company->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function update(User $user, Company $company): bool
    {
        if ($user->isOwner() && $user->company_id === $company->id) {
            return true;

        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function delete(User $user, Company $company)
    {
        if ($user->isOwner() && $user->company_id === $company->id) {
            return true;

        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function restore(User $user, Company $company)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Company $company
     * @return Response|bool
     */
    public function forceDelete(User $user, Company $company)
    {
        if ($user->isOwner() && $user->company_id === $company->id) {
            return true;

        }
        return false;
    }
}
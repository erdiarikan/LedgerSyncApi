<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Company $company): bool
    {
        return $user->companies->contains($company);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Company $company): bool
    {
        return $user->companies->contains($company);
    }

    public function delete(User $user, Company $company): bool
    {
        return $user->companies()
            ->where('company_id', $company->id)
            ->wherePivot('role', 'admin')
            ->exists();
    }
}

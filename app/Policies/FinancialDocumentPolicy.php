<?php

namespace App\Policies;

use App\Models\FinancialDocument;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinancialDocumentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, FinancialDocument $financialDocument): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, FinancialDocument $financialDocument): bool
    {
    }

    public function delete(User $user, FinancialDocument $financialDocument): bool
    {
    }

    public function restore(User $user, FinancialDocument $financialDocument): bool
    {
    }

    public function forceDelete(User $user, FinancialDocument $financialDocument): bool
    {
    }
}

<?php

namespace App\Policies;

use App\Models\ChartOfAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChartOfAccountPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, ChartOfAccount $chartOfAccount): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, ChartOfAccount $chartOfAccount): bool
    {
    }

    public function delete(User $user, ChartOfAccount $chartOfAccount): bool
    {
    }

    public function restore(User $user, ChartOfAccount $chartOfAccount): bool
    {
    }

    public function forceDelete(User $user, ChartOfAccount $chartOfAccount): bool
    {
    }
}

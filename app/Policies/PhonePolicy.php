<?php

namespace App\Policies;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhonePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Phone $phone): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Phone $phone): bool
    {
    }

    public function delete(User $user, Phone $phone): bool
    {
    }

    public function restore(User $user, Phone $phone): bool
    {
    }

    public function forceDelete(User $user, Phone $phone): bool
    {
    }
}

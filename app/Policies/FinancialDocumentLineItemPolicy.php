<?php

namespace App\Policies;

use App\Models\FinancialDocumentLineItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinancialDocumentLineItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, FinancialDocumentLineItem $financialDocumentLineItem): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, FinancialDocumentLineItem $financialDocumentLineItem): bool
    {
    }

    public function delete(User $user, FinancialDocumentLineItem $financialDocumentLineItem): bool
    {
    }

    public function restore(User $user, FinancialDocumentLineItem $financialDocumentLineItem): bool
    {
    }

    public function forceDelete(User $user, FinancialDocumentLineItem $financialDocumentLineItem): bool
    {
    }
}

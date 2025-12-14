<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Cppt;
use Illuminate\Auth\Access\HandlesAuthorization;

class CpptPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Cppt');
    }

    public function view(AuthUser $authUser, Cppt $cppt): bool
    {
        return $authUser->can('View:Cppt');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Cppt');
    }

    public function update(AuthUser $authUser, Cppt $cppt): bool
    {
        return $authUser->can('Update:Cppt');
    }

    public function delete(AuthUser $authUser, Cppt $cppt): bool
    {
        return $authUser->can('Delete:Cppt');
    }

}
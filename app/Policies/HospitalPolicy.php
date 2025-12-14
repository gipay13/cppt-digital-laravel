<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Hospital;
use Illuminate\Auth\Access\HandlesAuthorization;

class HospitalPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Hospital');
    }

    public function view(AuthUser $authUser, Hospital $hospital): bool
    {
        return $authUser->can('View:Hospital');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Hospital');
    }

    public function update(AuthUser $authUser, Hospital $hospital): bool
    {
        return $authUser->can('Update:Hospital');
    }

    public function delete(AuthUser $authUser, Hospital $hospital): bool
    {
        return $authUser->can('Delete:Hospital');
    }

}
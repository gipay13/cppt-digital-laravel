<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Diagnose;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Diagnose');
    }

    public function view(AuthUser $authUser, Diagnose $diagnose): bool
    {
        return $authUser->can('View:Diagnose');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Diagnose');
    }

    public function update(AuthUser $authUser, Diagnose $diagnose): bool
    {
        return $authUser->can('Update:Diagnose');
    }

    public function delete(AuthUser $authUser, Diagnose $diagnose): bool
    {
        return $authUser->can('Delete:Diagnose');
    }

}
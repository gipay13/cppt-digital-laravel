<?php

namespace App\Policies;

use App\Models\Diagnose;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Diagnose');
    }

    public function view(AuthUser $authUser, Diagnose $cppt): bool
    {
        return $authUser->can('View:Diagnose');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Diagnose');
    }

    public function update(AuthUser $authUser, Diagnose $cppt): bool
    {
        return $authUser->can('Update:Diagnose');
    }

    public function delete(AuthUser $authUser, Diagnose $cppt): bool
    {
        return $authUser->can('Delete:Diagnose');
    }

    public function viewPdf(AuthUser $authUser, Diagnose $cppt): bool
    {
        return $authUser->can('ViewPdf:Diagnose');
    }
}

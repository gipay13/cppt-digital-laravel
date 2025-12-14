<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SoapTemplate;
use Illuminate\Auth\Access\HandlesAuthorization;

class SoapTemplatePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SoapTemplate');
    }

    public function view(AuthUser $authUser, SoapTemplate $soapTemplate): bool
    {
        return $authUser->can('View:SoapTemplate');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SoapTemplate');
    }

    public function update(AuthUser $authUser, SoapTemplate $soapTemplate): bool
    {
        return $authUser->can('Update:SoapTemplate');
    }

    public function delete(AuthUser $authUser, SoapTemplate $soapTemplate): bool
    {
        return $authUser->can('Delete:SoapTemplate');
    }

}
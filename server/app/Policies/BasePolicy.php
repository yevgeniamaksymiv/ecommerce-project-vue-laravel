<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    protected $module;

    const ACTION_ACCESS = 'access';
    const ACTION_CREATE = 'create';
    const ACTION_UPDATE = 'update';
    const ACTION_DELETE = 'delete';

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user,  $entity): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, $entity): bool
    {
        return true;
    }

    public function delete(User $user, $entity): bool
    {
        return true;
    }

}

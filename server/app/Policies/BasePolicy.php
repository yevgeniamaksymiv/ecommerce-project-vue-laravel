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

    protected function getPermission(string $action): string
    {
        return $this->module . '.' . $action;
    }

    public function viewAny(User $user): bool
    {
        $permission = $this->getPermission(self::ACTION_ACCESS);
        return $user->hasPermission($permission);
    }

    public function view(User $user,  $entity): bool
    {
        $permission = $this->getPermission(self::ACTION_ACCESS);
        return $user->hasPermission($permission);
    }

    public function create(User $user): bool
    {
        $permission = $this->getPermission(self::ACTION_CREATE);
        return $user->hasPermission($permission);
    }

    public function update(User $user, $entity): bool
    {
        $permission = $this->getPermission(self::ACTION_UPDATE);
        return $user->hasPermission($permission);
    }

    public function delete(User $user, $entity): bool
    {
        $permission = $this->getPermission(self::ACTION_DELETE);
        return $user->hasPermission($permission);
    }

}

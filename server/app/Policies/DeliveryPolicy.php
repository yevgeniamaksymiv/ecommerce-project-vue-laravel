<?php

namespace App\Policies;

use App\Models\Delivery;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DeliveryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role_id, [Role::IS_ADMIN, Role::IS_MANAGER]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Delivery $delivery): bool
    {
        return in_array($user->role_id, [Role::IS_ADMIN, Role::IS_MANAGER]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role_id, [Role::IS_ADMIN, Role::IS_MANAGER]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Delivery $delivery): bool
    {
        return in_array($user->role_id, [Role::IS_ADMIN, Role::IS_MANAGER]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Delivery $delivery): bool
    {
        return $user->role_id === Role::IS_ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Delivery $delivery): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Delivery $delivery): bool
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\AvailableModel;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;

class AvaliableModelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AvailableModel  $availableModel
     * @return mixed
     */
    public function view(User $user, AvailableModel $availableModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(Seller $user)
    {

        return auth()->guard('seller')->user();

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AvailableModel  $availableModel
     * @return mixed
     */
    public function update(User $user, AvailableModel $availableModel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AvailableModel  $availableModel
     * @return mixed
     */
    public function delete(User $user, AvailableModel $availableModel)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AvailableModel  $availableModel
     * @return mixed
     */
    public function restore(User $user, AvailableModel $availableModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AvailableModel  $availableModel
     * @return mixed
     */
    public function forceDelete(User $user, AvailableModel $availableModel)
    {
        //
    }
}

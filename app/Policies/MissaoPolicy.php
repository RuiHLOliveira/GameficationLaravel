<?php

namespace App\Policies;

use App\Models\Missao;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MissaoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Missao  $missao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Missao $missao)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Missao  $missao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Missao $missao)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Missao  $missao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Missao $missao)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Missao  $missao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Missao $missao)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Missao  $missao
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Missao $missao)
    {
        //
    }
}

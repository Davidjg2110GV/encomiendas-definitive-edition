<?php

namespace App\Policies;

use App\Models\Encomienda;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EncomiendaPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Encomienda $encomienda)
    {
        return $user->id === $encomienda->remitente_id || $user->rol === 'admin';
    }

    public function create(User $user)
    {
        return $user->rol === 'remitente';
    }

    public function update(User $user, Encomienda $encomienda)
    {
        return $user->id === $encomienda->remitente_id || $user->rol === 'admin';
    }

    public function delete(User $user, Encomienda $encomienda)
    {
        return $user->rol === 'admin' && $encomienda->estado === 'pendiente';
    }
}
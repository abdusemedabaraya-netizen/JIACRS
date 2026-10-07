<?php

namespace App\Http\Controllers;

abstract class Controller
{
<<<<<<< HEAD
    protected function isAdmin(): bool
    {
        return auth()->user()?->hasAnyRole(['Admin', 'Super Admin']) ?? false;
    }

    protected function adminOnly(): void
    {
        abort_unless($this->isAdmin(), 403);
    }
}
=======
    //
}
>>>>>>> be38a6dd75183943501997739ad1d99c484cc4e9

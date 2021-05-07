<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;


class ProfilesController extends Controller
{
    public function show(User $user) {

        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->paginate(30)
        ]);

    }

    public function edit(User $user) {

        // if ($user->isNot(auth()->user() )) {
        //     abort(403);
        // }

        return view('profiles.edit', compact('user'));

    }
    
    public function update(User $user) {
        
        $attributes = request()->validate([
            'username' => ['string', 'required','max:255', 'alpha_dash', Rule::unique('users')->ignore($user), ],
            'name' => ['string', 'required', 'max:255'],
            'avatar' => ['image', ],            
            'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user), ],
            'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed', ],
        ]);

        if (request('avatar'))  {
            
            $attributes['avatar'] = request('avatar')->store('avatars');

        }

            $user->update($attributes);

            return redirect(route('profile', $user )); 
    }

}



<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login2(Request $request){
        $incomingFields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);
    
        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/admin');
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas. Por favor, inténtelo de nuevo.');
        }
    }
    
    

    public function logout() {
        auth()->logout();
        return redirect('/');
    }



    
}

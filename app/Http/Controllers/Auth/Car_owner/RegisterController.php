<?php

namespace App\Http\Controllers\Auth\Car_owner;


use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\Car_owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    // public function create(): View
    // {
    //     return view('admin.auth.register');
    // }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Car_owner::class],
            'password' => ['required', 'confirmed', 'min:8'],
            'photo' => 'image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'gender' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        if ($image = $request->file('photo')) {
            $destinationPath = 'images/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $photo = $destinationPath . $postImage;
        } else {
            $photo = 'images/nophoto.jpg';
        }

        $car_owner = Car_owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => $photo,
        ]);

        Auth::guard('car_owner')->login($car_owner);

        return redirect(RouteServiceProvider::CAR_OWNER_DASHBOARD);
    }
}

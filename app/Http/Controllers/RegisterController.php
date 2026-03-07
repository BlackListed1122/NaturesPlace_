<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\View\Components\Search;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use phpDocumentor\Reflection\Location;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): View
    {
        //@desc Show menu listings
        //@route GET / menu

        $cart = session()->get('cart', []);
        $cart = session()->get('cart') ?? [];
        $count = count($cart);

        $users = User::all();

        // return view('account.signup')->with('user', $user);
        return view('account.signup', [
            'users' => $users,
            'count' => $count,
            'cart' => $cart,





        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //@desc Show menu listings
        //@route GET / menu

        $cart = session()->get('cart', []);
        $cart = session()->get('cart') ?? [];
        $count = count($cart);

        $users = User::all();

        // return view('account.signup')->with('user', $user);
        return view('account.signup', [
            'users' => $users,
            'count' => $count,
            'cart' => $cart,

        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $validatedData = $request->validatecreate([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'contact_phone' => $request->contact_phone,
    //         'user_level' => $request->user_level,

    //         // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);
    //     // // Use function
    //     // $path = $request->file('avatar')->store('avatar', 'public');

    //     // // Add path to validated data
    //     // $validatedData['avatar'] = $path;
    //     //hash password
    //     $validatedData['password'] = Hash::make($validatedData['password']);
    //     User::create($validatedData);

    //     return redirect()->route('menu.index');
    // }


    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'contact_phone' => 'nullable|string|max:20',
            'user_level' => 'required|in:Cashier,Admin',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $path;
        }

        // Create user
        User::create($validatedData);

        return redirect()->route('account.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Delete avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect('/staff')->with('success', 'User deleted successfully');
    }
}

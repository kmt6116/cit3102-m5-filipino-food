<?php

namespace App\Http\Controllers;

use App\Models\FilipinoFood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FilipinoFoodController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function index(Request $request)
    {
        $query = FilipinoFood::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('availability')) {
            $query->where('availability', filter_var($request->availability, FILTER_VALIDATE_BOOLEAN));
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(['Meals', 'Snacks', 'Drinks'])],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'availability' => ['required', 'boolean'],
        ]);

        $food = FilipinoFood::create($validated);

        return response()->json($food, 201);
    }

    public function show(string $id)
    {
        $food = FilipinoFood::findOrFail($id);

        return response()->json($food);
    }

    public function update(Request $request, string $id)
    {
        $food = FilipinoFood::findOrFail($id);

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'category' => ['sometimes', 'required', Rule::in(['Meals', 'Snacks', 'Drinks'])],
            'description' => ['sometimes', 'required', 'string'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'availability' => ['sometimes', 'required', 'boolean'],
        ]);

        $food->update($validated);

        return response()->json($food->fresh());
    }

    public function destroy(string $id)
    {

    //
        $food = FilipinoFood::findOrFail($id);
        $food->delete();

        return response()->json(null, 204);
    }
}

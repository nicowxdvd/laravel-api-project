<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = User::with('role')->select('id', 'first_name', 'last_name', 'email', 'is_active', 'role_id');
        // 1. Filtrar por el estado del USUARIO (is_active)
        if ($request->has('user_active')) {
            $userActive = filter_var($request->query('user_active'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($userActive !== null) {
                $query->where('is_active', $userActive);
            }
        }

        // 2. Filtrar por el estado del ROL asociado (has('role') / whereHas)
        if ($request->has('role_active')) {
            $roleActive = filter_var($request->query('role_active'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if ($roleActive !== null) {
                $query->whereHas('role', function ($q) use ($roleActive) {
                    $q->where('is_active', $roleActive);
                });
            }
        }

        // 3. Orden alfabético y límite estricto de 100 registros máximos
        $query->orderBy('first_name', 'asc')->limit(100);

        return response()->json($query->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json($user->load('role'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function destroy(string $id)
    {
        //
    }
}

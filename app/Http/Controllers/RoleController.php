<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $query = Role::query()->select('id', 'name', 'description', 'is_active');
        // Si viene el parámetro 'is_active', filtramos por su valor booleano
        if ($request->has('is_active')) {
            // filter_var convierte los strings 'true', '1', 'false', '0' a booleanos reales
            $isActive = filter_var($request->query('is_active'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

            if ($isActive !== null) {
                $query->where('is_active', $isActive);
            }
        }
        // Orden alfabético ascendente (A-Z) por el campo 'name'
        $query->orderBy('name', 'asc')->limit(100);

        return response()->json($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): JsonResponse
    {
        $role = Role::create($request->validated());

        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): JsonResponse
    {
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->validated());

        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return response()->json(null, 204);
    }
}

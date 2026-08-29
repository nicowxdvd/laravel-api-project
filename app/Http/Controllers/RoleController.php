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
        return response()->json(Role::all());
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

<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class UserController extends Controller
{
    public function show(int $id): JsonResponse
    {
        try {

            $user = User::findOrFail($id);

            return new JsonResponse([
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong in UserController.show',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        try {

            $user = User::findOrFail($id);

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            // $user->email = $request->email;
            // $user->description = $request->description;

            $user->save();

            return new JsonResponse('User details updated', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong in UserController.update',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}

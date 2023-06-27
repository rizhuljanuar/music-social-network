<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostByUserController extends Controller
{
    public function show(int $user_id): JsonResponse
    {
        try {

            $posts = Post::where('user_id', $user_id)->get();

            return new JsonResponse($posts, 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong PostByUserController.show',
                'error' => $e->getMessage()
            ]);
        }
    }
}

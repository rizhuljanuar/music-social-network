<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Post\StoreRequest;
use App\Http\Requests\API\Post\UpdateRequest;
use App\Models\Post;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $postPerPage = 3;
            $post = Post::with('user')
                ->orderBy('updated_at', 'desc')
                ->simplePaginate($postPerPage);

            $pageCount = count(Post::all()) / $postPerPage;

            return new JsonResponse([
                'paginate' => $post,
                'page_count' => ceil($pageCount)
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong PostController.index',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            if ($request->hasFile('image') === false) {
                return new JsonResponse([
                    'error' => 'There is no image to upload'
                ], 400);
            }

            $post = new Post;

            (new ImageService)->updateImage($post, $request, '/images/posts/', 'store');

            $post->title = $request->get('title');
            $post->location = $request->get('location');
            $post->description = $request->get('description');

            $post->save();

            return new JsonResponse('New post created', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong PostController.store',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $post = Post::with('user')->findOrFail($id);

            return new JsonResponse($post, 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong PostController.show',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);

            if ($request->hasFile('image')) {
                (new ImageService)->updateImage($post, $request, '/images/posts', 'update');
            }

            $post->title = $request->get('title');
            $post->location = $request->get('location');
            $post->description = $request->get('description');

            $post->save();

            return new JsonResponse('Post with id',  $id . ' was updated!', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong PostController.update',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);

            if (!empty($post->image)) {
                $currentPage = public_path() . '/images/posts' . $post->image;

                if (file_exists($currentPage)) {
                    unlink($currentPage);
                }
            }

            $post->delete();

            return new JsonResponse('Post deleted', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong PostController.destroy',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

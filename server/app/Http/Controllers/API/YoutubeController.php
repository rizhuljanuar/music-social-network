<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Youtube\StoreRequest;
use App\Models\Youtube;
use Illuminate\Http\JsonResponse;

class YoutubeController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $yt = new Youtube;

            $yt->user_id = $request->get('user_id');
            $yt->title = $request->get('title');
            $yt->url = env("YT_EMBED_URL") . $request->get('url') . '?autoplay=0';

            $yt->save();

            return new JsonResponse('New Youtube link saved!', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong in YoutubeController.store',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $user_id): JsonResponse
    {
        try {
            $videoByUser = Youtube::where('user_id', $user_id)->get();

            return new JsonResponse([
                'videos_by_user' => $videoByUser
            ], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong in YoutubeController.show',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $yt = Youtube::findOrFail($id);
            $yt->delete();

            return new JsonResponse('Video deleted', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong in YoutubeController.destroy',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Song\StoreRequest;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class SongController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $file = $request->file;

            if (empty($file)) {
                return new JsonResponse('No song uploaded', 400);
            }

            $user = User::findOrFail($request->get('user_id'));

            $song = $file->getClientOriginalName();
            $file->move('songs/' . $user->id, $song);

            Song::create([
                'user_id' => $request->get('user_id'),
                'title' => $request->get('title'),
                'song' => $song
            ]);

            return new JsonResponse('Song saved!', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong in SongController.store',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(int $id, int $user_id): JsonResponse
    {
        try {
            $song = Song::findOrFail($id);

            $currentSong = public_path() . '/songs/' . $user_id . '/' . $song->song;
            if (file_exists($currentSong)) {
                unlink($currentSong);
            }

            $song->delete();

            return new JsonResponse('Song delete', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => 'Something went wrong in SongController.destroy',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

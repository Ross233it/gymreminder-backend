<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\AppMedia;
use Illuminate\Support\Facades\Storage;

class AppMediaController extends Controller
{
    use HttpResponses;

public function setExerciseMedia(Request $request, int $exerciseId){
    $request->validate([
        'files.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    foreach ($request->file('files') as $file) {
       // $random = substr((string) time(), -3);
        $random = uniqid();
        $hashedRandom = md5($random);
        $hashedRandom = substr($hashedRandom, -5);
        $fileName = 'esercizio-'.
                    $request->exercise_id.
                    "-".$hashedRandom.
                    ".".$file->getClientOriginalExtension();

        $filePath = $file->storeAs('public/exercises/exercise-'.$request->exercise_id, $fileName);
        $fileUrl = '/storage/exercises/exercise-'.$request->exercise_id.'/'.$fileName;

        $fileEntry = new AppMedia();
        $fileEntry->exercise_id = $request->exercise_id;
        $fileEntry->name = $fileName;
        $fileEntry->path = $fileUrl;
        $fileEntry->save();
    }
    return $this->success("", "File salvati con successo");
}

public function delete(int $mediaId){
    $toDelete = AppMedia::find($mediaId);

    if($toDelete) {
        $path = $toDelete->path;
        $path = str_replace('/storage/', '/public/', $path);
        $deleted = $toDelete->delete();
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return $this->success($deleted, "Il file è stato cancellato con successo");
        }
        return $this->error('', "Si è verificato un errore durante la cancellazione", 500);
    }
}
}

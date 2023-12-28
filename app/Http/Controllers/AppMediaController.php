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
    public function test(){

//        $collection = collect(['primo'=>1, 2, 3, 4, 5]);
//
//        $collection->contains(function (int $value, int $key) {
//            return 'primo';
//        });

// false
           $test  = collect([
                            ['name'=>'tizio',
                             'surname'=> 'caio',
                              'nickName'=>'sempronio',
                              'subCollection'=>collect([
                                    'localita' => 'Milano',
                                    'indrizzo'=>'via tal dei tali',
                                    'numeroCivico' =>44
                              ])
                            ],
                            ['name'=>'mario',
                             'surname'=> 'rossi',
                              'nickName'=>'sempronio55',
                              'subCollection'=>collect([
                                    'localita' => 'Parma',
                                    'indrizzo'=>'via seconda via',
                                    'numeroCivico' =>66
                              ])
                            ]
                    ]);
           $appendedCollection = collect([
                'added1'=>10,
                'added2'=>50,
                'added3'=>30,
                'added4'=>70,
               ]);
           $test['pippo'] = collect([3,5,7,44]);
           $test = $test->concat($appendedCollection);
          //  return $appendedCollection->avg();
          //  return $test->contains('localita', 'Milano');
//            return $test->only(["pippo", 'subCollection']);
//         $test = $test->filter(function($value, $key){
//             return ($value === "caio" && $key == 'surname') ||
//                    ($key == 'subCollection["localita"]' && $value['localita'] == 'Milano');
//         });
//         $test = $test->where('surname', '!==','rossi')->keys();
//         $test = collect($test[0]['subCollection'])->keys();
            $removed = $test->pop();
//            return $removed;
//        $test->prepend('Ciao sono aggiunto');
      //  $test->prepend( 'Ciao sono aggiunto in fondo', 'surname');
        $test = $test->except('surname');
            return $test->all();
    }
}

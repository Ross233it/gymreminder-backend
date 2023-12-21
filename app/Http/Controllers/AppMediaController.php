<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppMediaController extends Controller
{
    public function upload(Request $request){
        $request->validate([
            'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        foreach ($request->file('files') as $file) {
            // Generazione di un nome unico per il file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Salvataggio del file nello storage pubblico
            $filePath = $file->storeAs('public', $fileName);

            // Salvataggio delle informazioni del file nel database
            $fileEntry = new FileEntry();
            $fileEntry->file_name = $fileName;
            $fileEntry->file_path = $filePath;
            $fileEntry->save();
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

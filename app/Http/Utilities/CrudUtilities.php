<?php

namespace App\Http\Utilities;

use App\Traits\HttpResponses;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CrudUtilities{
    use HttpResponses;

    public function indexRecord(Model | User $model, String $orderby, String $order ='DESC'){
        $data = $model::orderBy($orderby, $order)->get();
        if (isset($data))
            return $this->success($data, 'Dati Recuperati', 200);
        else
            return $this->error('', 'Impossibile recuperare dati');
    }

    public function showRecord(Model | User $model, int $currentId){
        $data = $model::where('id', $currentId)->get();
        if (isset($data))
            return $this->success($data, 'Dati Recuperati', 200);
        else
            return $this->error('', 'Impossibile recuperare dati');
    }

    public function deleteRecord(Model|User $model, int $currentId)
    {
        $toDelete = $model::find($currentId);
        if($toDelete) {
            $deleted = $toDelete->delete();
            return $this->success($deleted, "Record correttamente eliminato");
        }else
            return $this->error('', "Si è verificato un errore - non eliminato", 500);
    }

    public function editRecord(Model | User $model, int $currentId, array $data){
        $updated = $model::where('id', $currentId)->update($data);
        if ($updated === 1)
            return $this->success($updated, 'Record modificato', 200);
        else
            return $this->error('', 'Impossibile modificare utente', 500);
    }
}

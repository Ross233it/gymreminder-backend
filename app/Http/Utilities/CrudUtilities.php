<?php

namespace App\Http\Utilities;

use App\Traits\HttpResponses;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CrudUtilities{
    use HttpResponses;

    public function deleteRecord(Model|User $model, int $currentId)
    {
        $toDelete = $model::find($currentId);
        if($toDelete) {
            $deleted = $toDelete->delete();
            return $this->success($deleted, "Record correttamente eliminato");
        }else
            return $this->error('', "Si è verificato un errore - non eliminato", 500);
    }



}

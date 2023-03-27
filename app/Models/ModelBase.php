<?php

namespace App\Models;

use App\Jobs\JobCreatePokemon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class ModelBase extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $baseExternalUrl = '';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getPrimaryIndexAttribute()
    {
        return $this->attributes[$this->getKeyName()];
    }
    
    public function getDataById($id)
    {
        $data = $this->find($id);
        return $this->getData($data, $id);
    }

    public function getDataByName($name)
    {
        $data = $this->where('pkm_name','ilike', $name)->first();
        return $this->getData($data, $name);
    }
    
    public function getData($data, $index)
    {
        if (!$data) {
            preg_match('/.+\//', $this->baseExternalUrl, $this->baseExternalUrl);
            $url = $this->baseExternalUrl[0].$index;
            $data = Http::get($url);
            $response = array_merge((array) $data->json() ?? [], ['url' => $url]);
            $data = [];
            if (@$response['id']) {
                JobCreatePokemon::dispatch($response);
                $data = createPokemonByApi($response);
                $data = new Pokemon($data);
            }
        }
        
        return $data;
    }
}

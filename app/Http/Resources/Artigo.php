<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Artigo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'=>$this->id,
            'titulo'=>$this->titulo,
            'conteudo'=>$this->conteudo //Porque esse this se refere ao $request? E não a classe em si
            //make:controller --resource???

            //Resource in laravel, what is?
        ];
    }
}

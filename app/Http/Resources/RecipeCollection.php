<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RecipeCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return $this->collection->transform(function ($data) {
            return [ 
                'id' => $data->id,
                'recipe_name' => $data->name,
                'ingredients' => $data->ingredients,
                'method_of_preparation' => $data->method,
                'cloudinary_image_public_id' => $data->image,
                'upvotes' => $data->upvotes,
                'downvotes' => $data->downvotes,
                'created_at' => (string)$data->created_at
            ]; 
        });
    }

}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'recipe_name' => $this->name,
            'ingredients' => $this->ingredients,
            'method_of_preparation' => $this->method,
            'cloudinary_image_public_id' => $this->image,
            'upvotes' => $this->upvotes,
            'downvotes' => $this->downvotes,
            'created_at' => (string)$this->created_at,
        ];
    }
}


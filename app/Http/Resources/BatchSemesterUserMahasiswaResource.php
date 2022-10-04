<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchSemesterUserMahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'semester_status_id' => $this->semester_status->id ?? '',
            'semester_status_color' => $this->semester_status->color ?? '',
            'semester_status_name' => $this->semester_status->name ?? '',
        ];
    }
}

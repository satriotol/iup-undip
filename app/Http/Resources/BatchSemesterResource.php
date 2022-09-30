<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchSemesterResource extends JsonResource
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
            'semester' => $this->semester,
            'year' => $this->year,
            'semester_status_id' => $this->batch_semester_user_mahasiswas->first()->semester_status_id ?? 0
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_mahasiswa_id' => $this->user_mahasiswa->id,
            'code' => $this->user_mahasiswa->country->code,
            'country' => $this->user_mahasiswa->country->name,
            'major' => $this->user_mahasiswa->major->name,
            'batch' => $this->user_mahasiswa->batch->year,
            'nim' => $this->user_mahasiswa->nim,
            'name' => $this->name,
            'batch_semester_user_mahasiswas' => BatchSemesterUserMahasiswaResource::collection($this->user_mahasiswa->batch_semester_user_mahasiswas),
            'international_mahasiswas' => $this->user_mahasiswa->international_mahasiswa,
            'notes' => $this->user_mahasiswa->notes
        ];
    }
}

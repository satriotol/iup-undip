<?php

namespace App\Http\Resources;

use App\Models\UserMahasiswa;
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
        $userId = request()->segment(count(request()->segments()));
        $user_mahasiswa = UserMahasiswa::where('user_id', $userId)->first();
        return [
            'id' => $this->id,
            'semester' => $this->semester,
            'year' => $this->year,
            'semester_status_id' => $this->batch_semester_user_mahasiswas->where('user_mahasiswa_id', $user_mahasiswa->id)->first()->semester_status_id ?? 0
        ];
    }
}

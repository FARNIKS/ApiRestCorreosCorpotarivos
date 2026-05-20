<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewEmployeeReportRhConfigResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'intro_text'   => $this->intro_text,
            'closing_text' => $this->closing_text,
            'sign_off'     => $this->sign_off,
            'updated_at'   => $this->updated_at ? $this->updated_at->toIso8601String() : null,
        ];
    }
}

<?php

namespace App\Resources;

use App\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/**
 * Class EmployeeResource
 * @package App\Resources
 */
class EmployeeResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Employee $employee */
        $employee = $this->resource;

        return [
            'id' => $employee->id,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'birth_date' => $employee->birth_date,
            'employment_date' => $employee->employment_date,
            'boss_id' => $employee->boss_id,
            'boss' => $this->whenLoaded('boss', EmployeeResource::make($employee->boss)),
            'home_address' => $employee->home_address,
            'role' => $employee->role,
            'created_at' => $employee->created_at,
            'updated_at' => $employee->updated_at,
        ];
    }
}

<?php

namespace Bundles\EmployeeBundle\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Employee
 * @package Bundles\EmployeeBundle\Models
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon $birth_date
 * @property Carbon $employment_date
 * @property int $boss_id
 * @property Employee $boss
 * @property string $home_address
 * @property string $role
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Employee extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'employment_date',
        'boss_id',
        'home_address',
        'role'
    ];

    /**
     * @return BelongsTo
     */
    public function boss(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'boss_id');
    }
}

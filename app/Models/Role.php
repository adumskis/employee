<?php

namespace App\Models;

/**
 * Class Role
 * @package App\Models
 */
class Role
{
    const NAME_CEO = 'ceo';
    const NAME_PROJECT_MANAGER = 'project_manager';
    const NAME_QA_SPECIALIST = 'qa_specialist';
    const NAME_SUPPORT_SPECIALIST = 'support_specialist';
    const NAME_DEVELOPER = 'developer';

    const NAMES_LIST = [
        self::NAME_CEO,
        self::NAME_PROJECT_MANAGER,
        self::NAME_QA_SPECIALIST,
        self::NAME_SUPPORT_SPECIALIST,
        self::NAME_DEVELOPER,
    ];

}

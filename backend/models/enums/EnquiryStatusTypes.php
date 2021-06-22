<?php
/**
 * Created by VS Code.
 * User: Rajesh
 * Date: 02-06-2021
 * Time: 13:29
 */

namespace backend\models\enums;


class EnquiryStatusTypes {
    const INACTIVE = 0;
    const CLOSED = 2;
    const JOINED = 3;
    const POTENTIAL = 6;
    const ACTIVE = 10;

    public static $constants = [
        'inactive' => self::INACTIVE,
        'closed' => self::CLOSED,
        'joined' => self::JOINED,
        'potential' => self::POTENTIAL,
        'active' => self::ACTIVE
    ];

    public static $titles = [
        self::INACTIVE => 'Inactive',
        self::CLOSED => 'Closed',
        self::JOINED => 'Joined',
        self::POTENTIAL => 'Potential',
        self::ACTIVE => 'Active'
    ];

    public static $headers = [
        self::INACTIVE => 'Inactive',
        self::CLOSED => 'Closed',
        self::JOINED => 'Joined',
        self::POTENTIAL => 'Potential',
        self::ACTIVE => 'Active'
    ];
}
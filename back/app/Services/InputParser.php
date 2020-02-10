<?php


namespace App\Services;


class InputParser
{
    const INDIVIDUAL_TRANSPORTATION = 'individual';
    const GROUP_TRANSPORTATION = 'group';

    const TRANSPORTATION_TYPE_TRANSLATION = [
        self::INDIVIDUAL_TRANSPORTATION => 'individuálna',
        self::GROUP_TRANSPORTATION => 'skupinová',
    ];

    /**
     * @param array $input
     * @return string
     */
    public static function getTripDateInterval($input) {
        $index = $input['trip']['selected'] - $input['trip']['options'][0]['value'];
        $term = explode(';', $input['trip']['options'][$index]['text'])[0];
        return $term;
    }

    /**
     * @param array $input
     * @return string
     */
    public static function getGroupTransportPickUpLocation($input) {
        if ($input['groupTransport']['selected'] && $input['transportation'] = 'group') {
            $index = $input['groupTransport']['selected'] - $input['groupTransport']['options'][0]['value'];
            return $input['groupTransport']['options'][$index]['text'];
        }

        return '';
    }
}
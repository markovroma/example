<?php

/**
 * Сервис списка туров
 *
 * @author markov
 * @Service("serviceTourRoll")
 */
class Service_Tour_Roll extends Service_Tour_Roll_Abstract
{
    protected $config = array(
        'strategies'    => array(
            'Strict', 
            'Strict_Additional_About_Date',
            'Strict_Additional_About_Date_Duration',
            'Strict_Additional_About_Date_Duration_Adult',
            'About_Resort',
            'About_Resort_Additional_About_Date',
            'About_Resort_Additional_About_Date_Duration',
            'About_Resort_Additional_About_Date_Duration_Adult',
            'About_City',
            'About_City_Additional_About_Date',
            'About_City_Additional_About_Date_Duration',
            'About_City_Additional_About_Date_Duration_Adult',
            'About_City_About_Resort',
            'About_City_About_Resort_Additional_About_Date',
            'About_City_About_Resort_Additional_About_Date_Duration',
            'About_City_About_Resort_Additional_About_Date_Duration_Adult',
            'Capital',
            'Capital_Additional_About_Date',
            'Capital_Additional_About_Date_Duration',
            'Capital_Additional_About_Date_Duration_Adult',
        ),
        'minCount' => 150,
        'defaultParams' => array(
            'dateInterval'  => 'P14D',
            'durationFrom'  => 1,
            'durationTo'    => 14,
            'resortId'      => 0,
            'beginDateAsc' => false,
            'priceAsc'  => true
        ),
        'tourSearchStrategies' => ['Tour_Sletat']
    );
}

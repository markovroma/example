<?php

/**
 * Сервис списка туров (горящих)
 *
 * @author markov
 * @Service("serviceTourRollHot")
 */
class Service_Tour_Roll_Hot extends Service_Tour_Roll_Abstract
{
    protected $config = array(
        'strategies'    => array(
            'Strict'
        ),
        'minCount' => 0,
        'defaultParams' => array(
            'durationNotUsed'  => true,
            'dateNotUsed'   => true,
            'resortId'      => 0
        ),
        'tourSearchStrategies' => ['Tour_Hot_Cache_Tour']
    );
}

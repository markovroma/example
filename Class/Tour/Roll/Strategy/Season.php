<?php

/**
 * Cтратегия списка туров по сезонам
 *
 * @author markov
 */
class Tour_Roll_Strategy_Season extends Tour_Roll_Strategy_Abstract
{
    /**
     * Конфиг
     */
    protected $config = [
        'maxCount' => 1500 
    ];
    
    /**
     * @inheritdoc
     */
    public function isSatisfiedBy()
    {
        return isset($this->params['Tour_Season__id']);
    }
    
    /**
     * @inheritdoc
     */
    public function getTourSearchStorage($params)
    {
        $storage = App::serviceTourRollSeason()->get($params);
        if (!$storage->getCounts()) {
            $cityId = $params['inputParams']['cityId'];
            $cityIdsOther = App::serviceCityClosest()->getClosestIds($cityId);
            if (!$cityIdsOther) {
                return $storage;
            }
            $params['inputParams']['cityId'] = $cityIdsOther[0];
            $storage = App::serviceTourRollSeason()->get($params);
        }
        return $storage;
    }
}

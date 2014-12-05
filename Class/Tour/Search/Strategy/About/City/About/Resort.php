<?php

/**
 * Стратегия для ближайших городов и всех курортов страны
 *
 * @author markov
 */
class Tour_Search_Strategy_About_City_About_Resort extends Tour_Search_Strategy_Abstract
{
    /**
     * @inheritdoc
     */
    public function isSatisfiedBy()
    {
        return isset($this->params['inputParams']['resortId']) && 
            $this->params['inputParams']['resortId'];
    }
    
    /**
     * @inheritdoc
     */
    public function prepareParams()
    {
        $locator = IcEngine::serviceLocator();
        $cityId = $this->params['inputParams']['cityId'];
        $serviceCityClosest = $locator->getService('serviceCityClosest');
        $cityIds = $serviceCityClosest->getClosestIds($cityId);
        $this->params['inputParams']['cityId'] = $cityIds;
        $this->params['inputParams']['notResortId'] = $this->params['inputParams']['resortId'];
        unset($this->params['inputParams']['resortId']);
        
    }
}

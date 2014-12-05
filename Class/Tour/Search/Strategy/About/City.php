<?php

/**
 * Стратегия поиска туров по ближайшим городам вылета
 *
 * @author markov
 */
class Tour_Search_Strategy_About_City extends Tour_Search_Strategy_Abstract
{
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
    }
}

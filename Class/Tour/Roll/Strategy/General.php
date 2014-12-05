<?php

/**
 * Cтратегия списка туров (основной)
 *
 * @author markov
 */
class Tour_Roll_Strategy_General extends Tour_Roll_Strategy_Abstract
{
    /**
     * @inheritdoc
     */
    public function isSatisfiedBy()
    {
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function getTourSearchStorage($params)
    {
        $locator = IcEngine::serviceLocator();
        $serviceTourRoll = $locator->getService('serviceTourRoll');
        return $serviceTourRoll->get($params);
    }
}

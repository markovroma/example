<?php

/**
 * Стратегия поиска туров по Москве для текущего курорта
 *
 * @author markov
 */
class Tour_Search_Strategy_Capital extends Tour_Search_Strategy_Abstract
{
    /**
     * @inheritdoc
     */
    public function isSatisfiedBy()
    {
        return $this->params['inputParams']['cityId'] != City::MOSCOW_ID;
    }
    
    /**
     * @inheritdoc
     */
    public function prepareParams()
    {
        $this->params['inputParams']['cityId'] = City::MOSCOW_ID;
    }
}

<?php

/**
 * Стратегия поиска туров по всем курортам страны кроме текущего
 *
 * @author markov
 */
class Tour_Search_Strategy_About_Resort extends Tour_Search_Strategy_Abstract
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
        $this->params['inputParams']['notResortId'] = $this->params['inputParams']['resortId'];
        unset($this->params['inputParams']['resortId']);
    }
}

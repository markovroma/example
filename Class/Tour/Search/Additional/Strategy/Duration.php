<?php

/**
 * Дополнительная стратегия поиска туров, которая расширяет диапазон прибывания
 *
 * @author markov
 */
class Tour_Search_Additional_Strategy_Duration extends Tour_Search_Additional_Strategy_Abstract
{
    /**
     * @inheritdoc
     */
    public function prepareParams()
    {
        $this->params['inputParams']['notDurationRange'] = array(
            'durationFrom'  => $this->params['inputParams']['durationFrom'],
            'durationTo'    => $this->params['inputParams']['durationTo']
        );
        $this->params['inputParams']['durationFrom'] = 1;
        $this->params['inputParams']['durationTo'] = 30;
    }
}
<?php

/**
 * Дополнительная стратегия поиска туров, которая расширяет количество людей
 *
 * @author markov
 */
class Tour_Search_Additional_Strategy_Adult extends Tour_Search_Additional_Strategy_Abstract
{
    /**
     * @inheritdoc
     */
    public function isSatisfiedBy()
    {
        return isset($this->params['inputParams']['adultCount']);
    }
    
    /**
     * @inheritdoc
     */
    public function prepareParams()
    {
        $nowFormated = (new DateTime())->format('Y-m-d');
        $dateFormated = isset($this->params['inputParams']['date']) ? 
            $this->params['inputParams']['date'] : $nowFormated; 
        $dateToFormated = isset($this->params['inputParams']['dateTo']) ? 
            $this->params['inputParams']['dateTo'] : $nowFormated; 
        $date = DateTime::createFromFormat('Y-m-d', $dateFormated);
        $date->sub(new DateInterval('P14D'));
        $dateTo = DateTime::createFromFormat('Y-m-d', $dateToFormated);
        $dateTo->add(new DateInterval('P14D'));
        $this->params['inputParams']['date'] = max([
            $date->format('Y-m-d'), $nowFormated
        ]);
        $this->params['inputParams']['dateTo'] = max([
            $dateTo->format('Y-m-d'), $nowFormated
        ]);
        $this->params['inputParams']['durationFrom'] = 1;
        $this->params['inputParams']['durationTo'] = 30;
        
        $this->params['inputParams']['notAdultCount'] = $this->params['inputParams']['adultCount'];
        unset($this->params['inputParams']['adultCount']);
    }
}
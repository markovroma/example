<?php

/**
 * Дополнительная стратегия поиска туров, которая расширяет диапазон дат
 *
 * @author markov
 */
class Tour_Search_Additional_Strategy_Date extends Tour_Search_Additional_Strategy_Abstract
{
    /**
     * @inheritdoc
     */
    public function prepareParams()
    {
        $nextDate = (new DateTime())->add(new DateInterval('P1D'));
        $nextDateFormated = $nextDate->format('Y-m-d');
        $dateFormated = isset($this->params['inputParams']['date']) ? 
            $this->params['inputParams']['date'] : $nextDateFormated; 
        $dateToFormated = isset($this->params['inputParams']['dateTo']) ? 
            $this->params['inputParams']['dateTo'] : $nextDateFormated; 
        $this->params['inputParams']['notDateRange'] = array(
            'dateFrom'  => $dateFormated,
            'dateTo'    => $dateToFormated
        );
        $date = DateTime::createFromFormat('Y-m-d', $dateFormated);
        $date->sub(new DateInterval('P14D'));
        $dateTo = DateTime::createFromFormat('Y-m-d', $dateToFormated);
        $dateTo->add(new DateInterval('P14D'));
        $this->params['inputParams']['date'] = max([
            $date->format('Y-m-d'), $nextDateFormated
        ]);
        $this->params['inputParams']['dateTo'] = max([
            $dateTo->format('Y-m-d'), $nextDateFormated
        ]);
    }
}
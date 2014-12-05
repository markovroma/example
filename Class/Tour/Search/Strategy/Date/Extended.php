<?php

/**
 * По расширенному диапозону дат для сезонов
 *
 * @author markov
 */
class Tour_Search_Strategy_Date_Extended extends Tour_Search_Strategy_Abstract
{
    /**
     * @inheritdoc
     */
    public function prepareParams()
    {
        $now = new DateTime();
        $dateFormated = $now->format('Y-m-d');
        $now->add(new DateInterval('P2M'));
        $dateToFormated = $now->format('Y-m-d');
        $notDateFormated = $this->params['inputParams']['date']; 
        $notDateToFormated = $this->params['inputParams']['dateTo'];
        $this->params['inputParams']['notDateRange'] = array(
            'dateFrom'  => $notDateFormated,
            'dateTo'    => $notDateToFormated
        );
        $this->params['inputParams']['date'] = $dateFormated;
        $this->params['inputParams']['dateTo'] = $dateToFormated;
    }
}

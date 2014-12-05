<?php

/**
 * Дополнительная стратегия поиска туров по расширенному диапазону прибывания и даты
 *
 * @author markov
 */
class Tour_Search_Strategy_About_City_Additional_About_Date_Duration extends 
    Tour_Search_Strategy_About_City
{
    /**
     * @inheritdoc
     */
    protected function getAdditionalStrategyNames()
    {
        return array('Date', 'Duration');
    }
}

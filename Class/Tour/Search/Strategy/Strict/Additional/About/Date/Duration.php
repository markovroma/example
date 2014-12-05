<?php

/**
 * Дополнительная стратегия поиска туров по расширенному диапазону прибывания и даты
 *
 * @author markov
 */
class Tour_Search_Strategy_Strict_Additional_About_Date_Duration extends Tour_Search_Strategy_Strict
{
    /**
     * @inheritdoc
     */
    protected function getAdditionalStrategyNames()
    {
        return array('Date', 'Duration');
    }
}

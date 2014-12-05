<?php

/**
 * Дополнительная стратегия поиска туров по большему диапазону дат
 *
 * @author markov
 */
class Tour_Search_Strategy_Capital_Additional_About_Date extends 
    Tour_Search_Strategy_Capital
{
    /**
     * @inheritdoc
     */
    protected function getAdditionalStrategyNames()
    {
        return array('Date');
    }
}

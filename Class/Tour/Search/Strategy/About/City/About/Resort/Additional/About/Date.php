<?php

/**
 * Дополнительная стратегия поиска туров по большему диапазону дат
 *
 * @author markov
 */
class Tour_Search_Strategy_About_City_About_Resort_Additional_About_Date extends 
    Tour_Search_Strategy_About_City_About_Resort
{
    /**
     * @inheritdoc
     */
    protected function getAdditionalStrategyNames()
    {
        return array('Date');
    }
}

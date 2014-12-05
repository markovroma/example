<?php

/**
 * Дополнительная стратегия поиска туров по расширенному диапазону прибывания и даты и 
 * количества людей
 *
 * @author markov
 */
class Tour_Search_Strategy_Strict_Additional_About_Date_Duration_Adult extends 
    Tour_Search_Strategy_Strict
{
    /**
     * @inheritdoc
     */
    protected function getAdditionalStrategyNames()
    {
        return array('Adult');
    }
}

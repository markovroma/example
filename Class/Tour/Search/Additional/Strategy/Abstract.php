<?php

/**
 * Абстрактная дополнительная стратегия поиска туров
 *
 * @author markov
 */
abstract class Tour_Search_Additional_Strategy_Abstract
{
    /**
     * Параметры 
     */
    protected $params = array();
    
    /**
     * Устанавливает параметры
     */
    public function setParams($params)
    {
        $this->params = $params;
    }
    
    /**
     * Возвращает параметры
     */
    public function getParams()
    {
        return $this->params;
    }
    
    /**
     * @inheritdoc
     */
    public function isSatisfiedBy()
    {
        return true;
    }
    
    /**
     * Подготавливает данные для поиска
     */
    abstract public function prepareParams();
}
<?php

/**
 * Абстрактная стратегий списка туров
 *
 * @author markov
 */
abstract class Tour_Roll_Strategy_Abstract
{
    /**
     * Параметры
     */
    protected $params;
    
    /**
     * Устанавливает параметры
     * 
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Возвращает название стратегии
     *
     * @return string
     */
    public function getName()
    {
        return substr(get_class($this), strlen('Tour_Roll_Strategy_'));
    }
    
    /**
     * Удволетворяет ли условию
     */
    abstract public function isSatisfiedBy();
    
    /**
     * Получает хранилище туров
     * 
     * @param array $params параметры
     * @return Tour_Search_Storage
     */
    abstract public function getTourSearchStorage($params);
}

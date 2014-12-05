<?php

/**
 * Абстрактная стратегия поиска туров
 *
 * @author markov
 */
abstract class Tour_Search_Strategy_Abstract
{
    /**
     * Параметры
     * 
     * @var array
     */
    protected $params = array();
    
    /**
     * Хранилище данных
     * 
     * @var array 
     */
    protected $storage = null; 
    
    /**
     * Возвращает названия дополнительных стратегий
     * 
     * @return array
     */
    protected function getAdditionalStrategyNames()
    {
        return array();
    }

    /**
     * Возвращает дополнительные стратегии
     * 
     * @return array
     */
    public function getAdditionalStrategies()
    {
        $locator = IcEngine::serviceLocator();
        $tourSearchAdditionalStrategyManager = $locator->getService(
            'tourSearchAdditionalStrategyManager'
        );
        $strategies = array();
        foreach ($this->getAdditionalStrategyNames() as $name) {
            $strategies[] = $tourSearchAdditionalStrategyManager->get($name);
        }
        return $strategies;
    }
    
    /**
     * Преобразуем данные
     */
    abstract public function prepareParams();
    
    /**
     * Возвращает параметры
     * 
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
    
    /**
     * Устанавливает параметры
     */
    public function setParams($params)
    {
        $this->params = $params;
    }
    
    /**
     * Получает данные
     * 
     * @return array
     */
    public function getData()
    {
        if ($this->storage === null) {
            $this->prepareParams();
            $params = $this->params;
            foreach ($this->getAdditionalStrategies() as $strategy) {
                $strategy->setParams($params);
                $strategy->prepareParams();
                $params = $strategy->getParams();
            }
            $this->params = $params;
            $this->storage = $this->load();
        }
        return $this->storage;
    }
    
    /**
     * Удволетворяет ли спецификации
     * 
     * @return boolean
     */
    public function isOk()
    {
        $isAdditionalSatisfiedBy = true;
        $params = $this->params;
        foreach ($this->getAdditionalStrategies() as $strategy) {
            $strategy->setParams($params);
            if (!$strategy->isSatisfiedBy()) {
                $isAdditionalSatisfiedBy = false;
                break;
            }
        }
        return $this->isSatisfiedBy() && $isAdditionalSatisfiedBy;
    }
    
    /**
     * Удволетворяет ли базовой спецификации
     * 
     * @return boolean
     */
    protected function isSatisfiedBy()
    {
        return true;
    }
    
    /**
     * Загружает данные
     * 
     * @return array
     */
    protected function load()
    {
        $locator = IcEngine::serviceLocator();
        $helperModelCollection = $locator->getService('helperModelCollection');
        $tourSearchManager = $locator->getService('tourSearchManager');
        $result = array(
            'collections'   => array(),
            'total'         => 0
        );
        foreach ($this->params['tourSearchStrategies'] as $type) {   
            $tourSearch = $tourSearchManager->get($type);
            $tourCollection = $tourSearch->getCollection($this->params);
            $tourCount = $helperModelCollection->getCount($tourCollection);
            $result['collections'][] = array(
                'collection'    => $tourCollection,
                'count'         => $tourCount
            );
            $result['total'] += $tourCount;
        }
        return $result;
    }
}

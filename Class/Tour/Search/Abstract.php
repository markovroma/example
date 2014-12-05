<?php

/**
 * Абстрактный поиск туров
 *
 * @author markov
 */
abstract class Tour_Search_Abstract 
{
    /**
     * Конфиг
     */
    protected $config = array();
    
    /**
     * Возвращает название стратегии поиска по типу туров (горящие, от турвизора...)
     * 
     * @return string
     */
    abstract public function getName();
    
    /**
     * Получает данные поиска
     * 
     * @param array $params параметры поиска
     * @return array
     */
    public function getCollection($params)
    {
        $locator = IcEngine::serviceLocator();
        $options = $this->config['options'];
        $inputParams = $params['inputParams'];
        $name = $this->getName();
        $tourCollection = $locator->getService('collectionManager')->create($name)
            ->addOptions('::Count');
        if ($options['after']) {
            foreach ($options['after'] as $optionName) {
                $tourCollection->addOptions($optionName);
            }
        }
        if ($options['before']) {
            foreach ($options['before'] as $field => $option) {
                if (!isset($inputParams[$field])) {
                    continue;
                }
                $optionData = [
                    'name'  => $option['name']
                ];
                if (isset($option['param'])) {
                    $optionData[$option['param']] = $inputParams[$field];
                }
                if (isset($option['optionParams'])) {
                    $optionData = array_merge($optionData, $option['optionParams']);
                }
                $tourCollection->addOptions($optionData);
            }
        }
        return $tourCollection;
    }
    
    /**
     * Накладывает условия для коллекции
     * 
     * @param array $collection коллекция
     * @param $params дополнительные параметры
     * @return array
     */
    public function filter($collection, $params)
    {
        $options = $this->config['options'];
        foreach ($options['before'] as $field => $option) {
            if (!isset($params[$field])) {
                continue;
            }
            $collection->addOptions(array(
                'name'  => $option['name'],
                $option['param']    => $params[$field]
            ));
        }
        return $collection;
    }
}

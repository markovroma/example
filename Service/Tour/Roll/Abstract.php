<?php

/**
 * Абстрактный сервис списка туров
 *
 * @author markov
 */
class Service_Tour_Roll_Abstract extends Service_Abstract
{
    /**
     * Получает данные
     * 
     * @param array $params параметры
     * @return Tour_Search_Storage
     */
    public function get($params)
    {
        $config = $this->config();
        $paramsWithDefault = $this->setDefaultParams($params['inputParams']);
        $paramsModification = $this->inputModification($paramsWithDefault);
        $tourSearchStrategyManager = $this->getService('tourSearchStrategyManager');
        $tourSearchStorage = $this->getService('tourSearchStorage')->newInstance();
        $total = 0;
        foreach ($config->strategies as $strategyName) {
            $strategy = $tourSearchStrategyManager->get($strategyName);
            $strategy->setParams(array(
                'inputParams'          => $paramsModification,
                'tourSearchStrategies' => $config->tourSearchStrategies->__toArray()
            )); 
            if (!$strategy->isOk()) {
                continue;
            }
            $strategyResult = $strategy->getData();
            if (!$strategyResult['total']) {
                continue;
            }
            $total += $strategyResult['total'];
            $tourSearchStorage->addItem($strategyName, $strategyResult['collections']);
            if ($total > $config['minCount']) {
                break;
            }
        }
        return $tourSearchStorage;
    }
    
    /**
     * Возвращает отфильтрованные коллекции
     * 
     * @return Tour_Search_Storage
     */
    public function filter($tourSearchStorage, $params)
    {
        if (!$params) {
            return $tourSearchStorage;
        }
        $paramsModification = $this->inputModification($params);
        $tourSearchManager = $this->getService('tourSearchManager');
        $helperModelCollection = $this->getService('helperModelCollection');
        $resultStorage = $this->getService('tourSearchStorage')->newInstance();
        foreach ($tourSearchStorage->get() as $strategyName => $collections) {
            $items = array();
            foreach ($collections as $data) {
                $collection = $data['collection'];
                $tourSearch = $tourSearchManager->get($collection->modelName());
                $collectionFiltered = $tourSearch->filter($collection, $paramsModification);  
                $count = $helperModelCollection->getCount($collectionFiltered);
                if (!$count) {
                    continue;
                }
                $items[] = array(
                    'collection'    => $collectionFiltered,
                    'count'         => $count
                );
            }
            if ($items) {
                $resultStorage->addItem($strategyName, $items);
            }
        }
        return $resultStorage;
    }
    
    /**
     * Устанавливает параметры по умолчанию к искомым
     * 
     * @param array $params параметры
     * @return array
     */
    public function setDefaultParams($params)
    {
        $defaultParams = $this->config()->defaultParams->__toArray();
        $params = array_merge($defaultParams, $params);
        if (isset($params['durationNotUsed']) && $params['durationNotUsed']) {
            unset($params['durationFrom']);
            unset($params['durationTo']);
        }
        if (isset($params['dateNotUsed']) && $params['dateNotUsed']) {
            unset($params['date']);
            unset($params['dateTo']);
        } else {
            if (!isset($params['date'])) {
                $params['date'] = (new DateTime())->format('d.m.Y');
            }
            if (!isset($params['dateTo'])) {
                $dateFrom = DateTime::createFromFormat('d.m.Y', $params['date']);
                $dateFrom->add(new DateInterval($defaultParams['dateInterval']));
                $params['dateTo'] = $dateFrom->format('d.m.Y');
            }
        }
        return $params;
    }
    
    /**
     * Модифицирует данные
     * 
     * @param array $params параметры
     * @return array
     */
    public function inputModification($params)
    {
        $locator = IcEngine::serviceLocator();
        $collectionManager = $locator->getService('collectionManager');
        $paramsModification = $params;
        foreach ($paramsModification as $key => $value) {
            if (!$value) {
                unset($paramsModification[$key]);
            }
        }
        if (isset($paramsModification['date'])) {
            $date = DateTime::createFromFormat(
                'd.m.Y', $paramsModification['date']
            );
            $now = new DateTime();
            if ($date < $now) {
                $paramsModification['date'] = $now->format('Y-m-d');
            } else {
                $paramsModification['date'] = $date->format('Y-m-d');
            }
        } 
        if (isset($paramsModification['dateTo'])) {
            $dateTo = DateTime::createFromFormat(
                'd.m.Y', $paramsModification['dateTo']
            );
            $paramsModification['dateTo'] = $dateTo->format('Y-m-d');
        } 
        if (isset($paramsModification['hotelCategoryId'])) {
            $hotelCategories = $collectionManager->create('Hotel_Category')
                ->addOptions('::Active')
                ->raw();
            if (count($hotelCategories) == count($paramsModification['hotelCategoryId'])) {
                unset($paramsModification['hotelCategoryId']);
            }
        }
        if (isset($paramsModification['foodTypeId'])) {
            $hotelCategories = $collectionManager->create('Food_Type')
                ->raw();
            if (count($hotelCategories) == count($paramsModification['foodTypeId'])) {
                unset($paramsModification['foodTypeId']);
            }
        }
        return $paramsModification;
    }
    
    /**
     * Группирует туры для вывода
     * 
     * @param array $tours массив коллекций туров
     * @return array
     */
    public function tourGroups($tours)
    {
        $tourGroups = array();
        $toursNameChanged = true;
        $tourLast = null;
        $group = array();
        foreach ($tours as $tour) {
            $toursNameChanged = $tourLast && $tourLast->modelName() != $tour->modelName();
            if ($toursNameChanged) {
                $tourGroups[] = array(
                    'tours'     => $group,
                    'modelName' => $tourLast->modelName()
                );
                $group = array();
                $toursNameChanged = false;
            }
            $group[] = $tour;
            $tourLast = $tour;
        }
        if ($tourLast) {
            $tourGroups[] = array(
                'tours'     => $group,
                'modelName' => $tourLast->modelName()
            );
        }
        return $tourGroups;
    }
    
    /**
     * Делит туры на точные и похожие
     * 
     * @param array $data
     * @return array
     */
    public function separateTours($data)
    {
        $storage = $data['storage'];
        $page = $data['page'];
        $perPage = $data['perPage'];
        $tours = $data['tours'];
        $storageData = $storage->get();
        $strictCount = 0;
        if (isset($storageData['Strict'])) {
            $strictCount = $storage->getCountsByItemName('Strict');
        }
        $step = $strictCount - ($page-1) * $perPage;
        if ($step > 0) {
            $toursStrict = array_slice($tours, 0, $step);
            $toursSimilar = array_slice($tours, $step, count($tours) - $step);
        } else {
            $toursStrict = array();
            $toursSimilar = $tours;
        }
        return array(
            $toursStrict,
            $toursSimilar
        );
    }
    
    /**
     * Добавляет блоки между турами
     * 
     * @param array $data
     * @return array
     */
    public function appendBlocks($data)
    {
        $formPlace = 7;
        $storage = $data['storage'];
        $page = $data['page'];
        $perPage = $data['perPage'];
        $tours = $data['tours'];
        $storageData = $storage->get();
        $strictCount = 0;
        if (isset($storageData['Strict'])) {
            $strictCount = $storage->getCountsByItemName('Strict');
        }
        $step = $strictCount - ($page - 1) * $perPage;
        $toursWithBlocks = [];
        $tourCountHalf = (int) (count($tours) / 2);
        $i = 0;
        foreach ($tours as $tour) {
            if ($i == $tourCountHalf) {
                $toursWithBlocks[] = [
                    'type'  => 'banner'
                ];
            }
            if ($i == $step) {
                $toursWithBlocks[] = [
                    'type'  => 'similar'
                ];
            }
            if ($i == $formPlace) {
                $toursWithBlocks[] = [
                    'type'  => 'order'
                ];
            }
            $toursWithBlocks[] = [
                'type'  => 'tour',
                'tour'  => $tour,
                'modelName' => $tour->modelName()
            ];
            $i++;
        }
        return $toursWithBlocks;
    }
}

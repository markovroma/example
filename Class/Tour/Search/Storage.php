<?php

/**
 * Результат поиска туров
 *
 * @author markov
 * @Service("tourSearchStorage")
 */
class Tour_Search_Storage
{
    /**
     * Данные
     */
    protected $storage = array();
    
    /**
     * Создает новый объект
     */
    public function newInstance()
	{
		return new self();
	}
    
    /**
     * Устанавливает значения
     * 
     * @param array $data данные
     */
    public function set($data)
    {
        $this->storage = $data;
    }
    
    /**
     * Добавляет элемент
     * 
     * @param string название элемента
     * @param array $item данные 
     */
    public function addItem($name, $item)
    {
        $this->storage[$name] = $item;
    }
    
    /**
     * Возвращает данные
     * 
     * @return array данные туров
     */
    public function get()
    {
        return $this->storage;
    }
    
    /**
     * Возвращает коллекции
     * 
     * @return array
     */
    public function getCollections()
    {
        $collections = array();
        foreach ($this->storage as $items) {
            foreach ($items as $item) {
                $collections[] = $item['collection'];
            }
        }
        return $collections;
    }
    
    /**
     * Возвращает количества элементов в коллекциях
     * 
     * @return array
     */
    public function getCounts()
    {
        $counts = array();
        foreach ($this->storage as $items) {
            foreach ($items as $item) {
                $counts[] = $item['count'];
            }
        }
        return $counts;
    }
    
    /**
     * Возвращает количество элементов в коллекциях по имени стратегии 
     * 
     * @param string $name
     * @return integer
     */
    public function getCountsByItemName($name)
    {
        $items = $this->storage[$name];
        $count = 0;
        foreach ($items as $item) {
            $count += $item['count'];
        }
        return $count;
    }
}

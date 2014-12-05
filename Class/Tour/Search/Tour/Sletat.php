<?php

/**
 * Поиск туров от слетать
 *
 * @author markov
 */
class Tour_Search_Tour_Sletat extends Tour_Search_Abstract 
{
    /**
     * @inheritdoc
     */
    protected $config = array(
        'options'   => array(
            'before'    => array(
                'notTourSletatId'    => array(
                    'name'  => '::Not_Id',
                    'param' => 'id'  
                ),
                'agencyCityId'  => [
                    'name'  => 'Agency_City',
                    'param' => 'id'
                ],
                'notDateRange'    => array(
                    'name'  => 'Not_Date_Range',
                    'param' => 'range'  
                ),
                'notDurationRange'    => array(
                    'name'  => 'Not_Duration_Range',
                    'param' => 'range'  
                ),
                'notAdultCount' => array(
                    'name'  => 'Not_Adult_Count',
                    'param' => 'count'
                ),
                'date'      => array(
                    'name'  => 'Begin_Date_Min',
                    'param' => 'date'
                ),  
                'dateTo'    => array(
                    'name'  => 'Begin_Date_Max',
                    'param' => 'date'
                ),
                'durationFrom'  => array(
                    'name'  => 'Duration_Min',
                    'param' => 'duration'
                ),
                'durationTo'    => array(
                    'name'  => 'Duration_Max',
                    'param' => 'duration'
                ),
                'priceFrom' => array(
                    'name'  => 'Price_Min',
                    'param' => 'price'
                ),
                'priceTo'   => array(
                    'name'  => 'Price_Max',
                    'param' => 'price'
                ),
                'adultCount'    => array(
                    'name'  => 'Count_Adult',
                    'param' => 'count'
                ),
                'childrenCount' => array(
                    'name'  => 'Count_Children',
                    'param' => 'count'
                ),
                'countryId' => array(
                    'name'  => '::Country',
                    'param' => 'id'
                ),
                'resortId' => array(
                    'name'  => '::Resort',
                    'param' => 'id'
                ),
                'notResortId' => array(
                    'name'  => '::Not_Resort',
                    'param' => 'id'
                ),
                'cityId'    => array(
                    'name'  => '::City',
                    'param' => 'id'
                ),
                'hotelId'   => array(
                    'name'  =>  '::Hotel',
                    'param' => 'id'
                ),
                'hotelCategoryId'   => array(
                    'name'  => 'Hotel_Category',
                    'param' => 'id'
                ),
                'foodTypeId'    => array(
                    'name'  => 'Food_Type',
                    'param' => 'id'
                ),
                'id'    => array(
                    'name'  => '::Key',
                    'param' => 'key'
                ),
                'tourOperatorId' => array(
                    'name'  => '::Tour_Sletat_Operator',
                    'param' => 'id'
                ),
                'beginDateAsc'    => array(
                    'name'  => '::Order_Asc',
                    'optionParams' => [
                        'field' => 'beginDate'
                    ]
                ),
                'countryAsc'    => [
                    'name'  => '::Order_Asc',
                    'optionParams' => [
                        'field' => 'countryTitle'
                    ]
                ],
                'countryDesc'    => [
                    'name'  => '::Order_Desc',
                    'optionParams' => [
                        'field' => 'countryTitle'
                    ]
                ],
                'cityAsc'    => [
                    'name'  => '::Order_Asc',
                    'optionParams' => [
                        'field' => 'cityTitle'
                    ]
                ],
                'cityDesc'    => [
                    'name'  => '::Order_Desc',
                    'optionParams' => [
                        'field' => 'cityTitle'
                    ]
                ],
                'durationAsc'    => [
                    'name'  => '::Order_Asc',
                    'optionParams' => [
                        'field' => 'duration'
                    ]
                ],
                'durationDesc'    => [
                    'name'  => '::Order_Desc',
                    'optionParams' => [
                        'field' => 'duration'
                    ]
                ],
                'priceAsc'    => [
                    'name'  => '::Order_Asc',
                    'optionParams' => [
                        'field' => 'priceForOne'
                    ]
                ],
                'priceDesc'    => [
                    'name'  => '::Order_Desc',
                    'optionParams' => [
                        'field' => 'priceForOne'
                    ]
                ]
            ),
            'after' => array(
                'Attach_Place_Description', 
                'Date_Format', 
                '::Attach_Resort_Image_Random',
                'Is_Hot'
            )
        )
    );
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Tour_Sletat';
    }
}

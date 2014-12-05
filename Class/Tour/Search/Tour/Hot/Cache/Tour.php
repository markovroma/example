<?php

/**
 * Поиск туров по таблице с кэшем горящих
 *
 * @author markov
 */
class Tour_Search_Tour_Hot_Cache_Tour extends Tour_Search_Abstract 
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
                    'name'  => 'Tour_Sletat::Agency_City',
                    'param' => 'id'
                ],
                'notDateRange'    => array(
                    'name'  => 'Tour_Sletat::Not_Date_Range',
                    'param' => 'range'  
                ),
                'notDurationRange'    => array(
                    'name'  => 'Tour_Sletat::Not_Duration_Range',
                    'param' => 'range'  
                ),
                'notAdultCount' => array(
                    'name'  => 'Tour_Sletat::Not_Adult_Count',
                    'param' => 'count'
                ),
                'date'      => array(
                    'name'  => 'Tour_Sletat::Begin_Date_Min',
                    'param' => 'date'
                ),  
                'dateTo'    => array(
                    'name'  => 'Tour_Sletat::Begin_Date_Max',
                    'param' => 'date'
                ),
                'durationFrom'  => array(
                    'name'  => 'Tour_Sletat::Duration_Min',
                    'param' => 'duration'
                ),
                'durationTo'    => array(
                    'name'  => 'Tour_Sletat::Duration_Max',
                    'param' => 'duration'
                ),
                'priceFrom' => array(
                    'name'  => 'Tour_Sletat::Price_Min',
                    'param' => 'price'
                ),
                'priceTo'   => array(
                    'name'  => 'Tour_Sletat::Price_Max',
                    'param' => 'price'
                ),
                'adultCount'    => array(
                    'name'  => 'Tour_Sletat::Count_Adult',
                    'param' => 'count'
                ),
                'childrenCount' => array(
                    'name'  => 'Tour_Sletat::Count_Children',
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
                    'name'  => 'Tour_Sletat::Hotel_Category',
                    'param' => 'id'
                ),
                'foodTypeId'    => array(
                    'name'  => 'Tour_Sletat::Food_Type',
                    'param' => 'id'
                ),
                'id'    => array(
                    'name'  => '::Key',
                    'param' => 'key'
                ),
                'agencyId'  => [
                    'name'  => '::Agency',
                    'param' => 'id'
                ],
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
                'Tour_Sletat::Attach_Place_Description', 
                'Tour_Sletat::Date_Format', 
                '::Attach_Resort_Image_Random'
            )
        )
    );
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Tour_Hot_Cache_Tour';
    }
}

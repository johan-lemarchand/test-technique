<?php
namespace App\Data;

use App\Entity\avis;

class SearchData
{
    /**
     * @var string
     */
    public $q = '';

    /**
     * @var Avis[]
     */
    public $avis = [];

    /**
     * @var null|integer
     */
    public $rate;

    /**
     * @var date
     */
    public $date ;

}

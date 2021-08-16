<?php

namespace Api\Newsreader;

require_once "./vendor/autoload.php";
class GNewsEndpoint
{
    public $searchText;
    public $lang;
    public $country;
    public $fromDate;
    public $toDate;

    /**
     * @param $searchText
     * @param $lang
     * @param $country
     * @param $fromDate
     * @param $toDate
     */
    public function __construct($searchText, $lang, $country, $fromDate, $toDate)
    {
        $this->searchText = $searchText;
        $this->lang = $lang;
        $this->country = $country;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }


    /**
     * create filter string from properties.
     */
    public function GetFilterString(){
        $result = '';
        if (!empty($this->searchText)){
            $result .= 'q='.$this->searchText;
        }
        if (!empty($this->country)){
            if (!empty($result)){
                $result .= '&';
            }
            $result .= 'country='.$this->country;
        }
        if (!empty($this->lang)){
            if (!empty($result)){
                $result .= '&';
            }
            $result .= 'lang='.$this->lang;
        }
        if (!empty($this->fromDate)){
            if (!empty($result)){
                $result .= '&';
            }
            $result .= 'from='.$this->fromDate;
        }
        if (!empty($this->toDate)){
            if (!empty($result)){
                $result .= '&';
            }
            $result .= 'to='.$this->toDate;
        }
        return 'search?'.$result;
    }

}
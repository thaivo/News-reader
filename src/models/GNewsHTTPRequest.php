<?php

namespace Api\Newsreader;
use Api\Newsreader\GNewsEndpoint;

require_once 'vendor/autoload.php';

class GNewsHTTPRequest
{
    public $link;
    public $apiToken;
    public $gnews;

    /**
     * @param string $link
     * @param string $apiToken
     * @param GNewsEndpoint $gnews
     */
    public function __construct($link, $apiToken, $gnews)
    {
        $this->link = $link;
        $this->apiToken = $apiToken;
        $this->gnews = $gnews;
    }

    public function createHTTPRequest(){
        return $this->link.$this->gnews->GetFilterString().'&token='.$this->apiToken;
    }

}
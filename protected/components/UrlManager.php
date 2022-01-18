<?php
class UrlManager extends CUrlManager{
    
    /*
    * rewriten behavior
    */
    public function createUrl($route, $params = array(), $ampersand = '&') {
        if(empty($params['lang']) ){
        $params['lang'] = Controller::processUrl();
        }
        return parent::createUrl($route, $params, $ampersand);
    }
    
    
}

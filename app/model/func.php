<?php

class func {
    /**
     * Func returns URI to knihovny.cz from query string.
     *
     * @param string $URIqueryString
     * @return string
     */
    static public function link_to_knihovnycz(string $URIqueryString){
        //add tracking data to the URI
        $URIqueryString = strpos($URIqueryString, '?') > -1 ? $URIqueryString . '&campaign=42' : $URIqueryString . '?campaign=42';

        return 'https://www.knihovny.cz/' . $URIqueryString;
    }
}
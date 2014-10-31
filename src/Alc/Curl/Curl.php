<?php

namespace Alc\Curl;

/**
 * Curl
 */
class Curl {

    private $url = null;
    private $postData = null;
    private $options = null;

    // Cookies
    private $cookie = null;
    private $cookieJar = null;

    /**
     * Constructor
     *
     * @param string url
     */ 
    public function __construct() {

        if( !function_exists('curl_init') ) {

            throw new \Exception('php5-curl not installed');
        }
    }

    /**
     * Set url
     *
     * @param string url
     */
    public function setUrl( $url ) {

        $this->url = $url;

        return $this;
    }

    /**
     * Set post data
     *
     * @param array postData
     */
    public function setPostData( $postData ) {

        $this->postData = $postData;

        return $this;
    }

    /**
     * Set cookie jar file
     *
     * @param string filepath
     */ 
    public function setCookieJar( $path ) {

        $this->cookieJar = $path;

        return $this;
    }
    
    /**
     * Cookie jar getter
     */
    public function getCookieJar() {

        return $this->cookieJar;
    }

    /**
     * Set Cookie
     *
     * @param string cookie
     */
    public function setCookie( $cookie ) {

        return $this->cookie = $cookie;
    }

    /**
     * Set single option
     *
     * @param string key
     * @param string value
     */
    public function setOption( $key, $value ) {

        if( $this->options === null ) {
            $this->options = array();
        }

        $this->options[$key] = $value;

        return $this;
    }

    /**
     * Set options
     *
     * @param array options
     */
    public function setOptions( $options ) {

        $this->options = $options;

        return $this;
    }

    /**
     * Add options
     *
     * @param array options
     */
    public function addOptions( $options ) {

        if( !empty($options) ) {

            foreach( $options as $key => $value ) {

                $this->setOption( $key, $value );
            }
        }

        return $this;
    }

    /**
     * Default options
     */
    public function useDefaultConfig() {

        $this->setOptions(array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_AUTOREFERER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 30,
            //CURLOPT_REFERER => '',
            CURLOPT_ENCODING => 'gzip',
            CURLOPT_USERAGENT => $this->getFirefoxUserAgent(),
        ));

        return $this;
    }

    /**
     * Chrome useragent
     *
     * @return string useragent
     */
    public function getFirefoxUserAgent() {

        return 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:33.0) Gecko/20100101 Firefox/33.0';
    }

    /**
     * Firefox options
     */
    public function useFirefox() {

        $this->setOptions(array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_AUTOREFERER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_ENCODING => 'gzip',
            CURLOPT_HTTPHEADER => array(
                'User-Agent: '.$this->getFirefoxUserAgent(),
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: fr,fr-fr;q=0.8,en-us;q=0.5,en;q=0.3',
                'Accept-Encoding: gzip, deflate',
                'DNT: 1',
                'Connection: keep-alive',
            ),
        ));

        return $this;
    }

    /**
     * Get Chrome useragent
     *
     * @return string useragent
     */
    public function getChromeUserAgent() {

        return 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.104 Safari/537.36';
    }

    /**
     * Chrome options
     */
    public function useChrome( $lang = 'en' ) {

        if( $lang == 'en' ) { // en

            $headers = array(
                'Connection: keep-alive',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'User-Agent: '.$this->getChromeUserAgent(),
                'DNT: 1',
                'Accept-Encoding: gzip,deflate,sdch',
                'Accept-Language: en-US,en;q=0.8,fr-FR;q=0.6,fr;q=0.4',
            );
        }
        else { // fr

            $headers = array(
                'Connection: keep-alive',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'User-Agent: '.$this->getChromeUserAgent(),
                'DNT: 1',
                'Accept-Encoding: gzip,deflate,sdch',
                'Accept-Language: fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
            );
        }

        $this->setOptions(array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_AUTOREFERER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 5,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_ENCODING => 'gzip',
            CURLOPT_HTTPHEADER => $headers,
        ));

        return $this;
    }

    /**
     * Perform http request
     *
     * @return CurlResponse reponse
     */ 
    public function exec() {

        if( $this->options === null ) {

            $this->useDefaultConfig();          
        }
        
        if( $this->postData != null ) {

            $this->options[CURLOPT_POST] = true;
            $this->options[CURLOPT_POSTFIELDS] = $this->postData;
        }
        
        if( $this->cookie !== null ) {

            $this->options[CURLOPT_COOKIE] = $this->cookie;
        }
        elseif( $this->cookieJar !== null ) {

            $this->options[CURLOPT_COOKIEFILE] = $this->cookieJar;
            $this->options[CURLOPT_COOKIEJAR] = $this->cookieJar;
        }
        
        $this->options[CURLOPT_URL] = $this->url;

        $ch = curl_init();
        curl_setopt_array($ch, $this->options);

        $content = curl_exec($ch);

        $response = new CurlResponse( $this );

        $response->url = $this->url;
        $response->content = $content;

        $response->error = curl_error($ch);
        $response->errno = curl_errno($ch);
        $response->info = curl_getinfo($ch);
        
        $this->url = null;
        $this->postData = null;

        return $response;
    }

    /**
     * Perform GET request
     *
     * @param string url
     * @param array options
     *
     * @return CurlResponse reponse
     */
    public function get( $url, $options = null ) {

        $this->setUrl( $url );
        if( $options ) $this->setOptions( $options );

        return $this->exec();
    }

    /**
     * Perform POST request
     *
     * @param string url
     * @param array postDate
     * @param array options
     *
     * @return CurlResponse reponse
     */
    public function post( $url, $postData = array(), $options = null ) {

        $this->setUrl( $url );
        $this->setPostData( $postData );
        if( $options ) $this->setOptions( $options );

        return $this->exec();
    }

    /**
     * Perform GET request and return his content
     *
     * @param string url
     * @param array options
     *
     * @return string content
     */
    public function getContent( $url, $options = null ) {

        return $this->get( $url, $options )->getContent();
    }

    /**
     * Perform GET request and return decoded json
     *
     * @param string url
     * @param array options
     *
     * @return array json
     */
    public function getJson( $url, $options = null ) {

        return $this->get( $url, $options )->getJson();
    }

    /**
     * Download a file
     *
     * @param string url
     * @param string fullpath
     * @param boolean override
     *
     * @return CurlResponse response
     */
    public function download( $url, $fullpath = null, $override = true ) {

        if( $fullpath === null )
            $fullpath = __DIR__;

        if( is_dir($fullpath) ) {

            $dir = rtrim($fullpath, '/');
            $filename = substr($url, strripos($url, '/')+1);
            $fullpath = $dir.'/'.$filename;
        }

        if( $override === false && file_exists($fullpath) )
            throw new \Exception('File allready exist');

        $fp = fopen($fullpath, 'w+');

        $this->setUrl( $url );
        $this->useChrome();

        $this->addOptions(array(
            CURLOPT_FILE => $fp,
        ));

        $response = $this->exec();

        return $response;
    }

    /**
     * Get server http headers
     *
     * @param string url
     *
     * @return array header
     */
    public function getHttpHeaders( $url ) {

        $this->setUrl( $url );
        $this->useDefaultConfig();

        $this->addOptions(array(
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true,
        ));

        $response = $this->exec();
        $headers = $response->getContent();

        return explode("\r\n", trim($headers));
    }

    /**
     * Unshort url
     *
     * @param string url
     *
     * @return string url
     */
    public function unshortUrl( $url ) {

        $this->setUrl( $url );

        if( preg_match('/^https?:\/\/t\.co\//i', $url) ) {

          $this->setOptions(array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_NOBODY => true,
            CURLOPT_AUTOREFERER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT => 30,
          ));
        }
        else {

            $this->useChrome();

            $this->addOptions(array(
                CURLOPT_NOBODY => true,
            ));
        }

        $response = $this->exec();

        return $response->getUrl();
    }
}

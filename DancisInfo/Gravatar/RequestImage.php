<?php
/**
 * Gravatar related class.
 */
namespace DancisInfo\Gravatar;

/**
 * Class RequestImage
 * @package DancisInfo\Gravatar
 *
 * Params for construct the URL are listed as follows.
 * s, size (= '80')
 * d, default (= null), ['404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank']
 * f, forcedefault, ['y']
 * r, rating (= 'g'), ['g', 'pg', 'r', 'x']
 */
class RequestImage
{
    /**
     * The most simple method but not perfect to get the URL.
     * @param $email Email address
     * @param $default Default image
     * @param $size Image size
     * @return URL
     * @link http://zh-tw.gravatar.com/site/implement/images/php/
     */
    public static function simpleURL($email, $default, $size)
    {
        return '//www.gravatar.com/avatar' . md5(strtolower(trim($email))) . "?d=$default&s=$size";
    }

    /**
     * Get either a Gravatar URL or complete HTML image tag for a specified email address.
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80 px [1 ~ 2048]
     * @param string $d Default imageset to use ['404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank']
     * @param string $r Maximum rating (inclusive) ['g', 'pg', 'r', 'x']
     * @param boolean $img True to return a complete HTML image tag or false for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the HTML image tag
     * @param boolean $fSSL Optional, forcing HTTPS forcely
     * @return string Containing either just a URL or a complete HTML image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    public static function getGravatarImage($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array(), $forceSSL = false)
    {
        (!($s >= 1 && $s <= 2048)) ? $s = (int) $s : exit('error at arg $s');

        $url = $fSSL ? 'https:' : null;
        $url = '//www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '" ';
            foreach ($atts as $key => $val) {
                $url .= $key . '="' . $val . '" ';
            }
            $url .= '/>';
        }
        return $url;
    }
}

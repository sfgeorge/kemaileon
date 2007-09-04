<?php

/****************************
Kemaileon
Version: 0.0.1
Author: Stephen F. George [sfgeorge (at) g m a i l <dot> com]
Adapted from scripts by
  pedram at redhive dot com <http://www.php.net/bin2hex#11027>
  And merwetta_at_hotmail.com <http://www.php.net/function.ord#24475>
****************************/

class Kemaileon
{
    private static $_showPHPHint = false;


    /** Author: Stephen F. George
    */
    function mask($email, $printAnchorAttributes = '')
    {
        $email .= '';
        return self::maskAnchor($email, $printAnchorAttributes . '')
            . self::maskWithoutAnchor($email)
            . '</a>'
            . self::generatePHPHint($email);
    }

    /** Author: Stephen F. George
    */
    function maskAnchor($email, $printAnchorAttributes = '')
    {
        if ($printAnchorAttributes)
        {
            $printAnchorAttributes = ' ' . $printAnchorAttributes;
        }

        return '<a href="' . 'mailto:' . self::hexEncode($email) . '"' . $printAnchorAttributes . '>';
    }

    /** Author: Stephen F. George 
    */
    function maskWithoutAnchor($email)
    {
        $len = strlen($email);

        $splitText = $email;
        for ($i = 0; $i < 2; $i++)
        {
            $chopLocation = rand(1, $len - 1);
            $splitText = substr($splitText, 0, $chopLocation) . ':' . substr($splitText, $chopLocation);
        }

        list($part1, $part2, $part3) = split(':', $splitText, 3);
        
        return self::asciiEncode($part1) . '<span>' . self::asciiEncode($part2) . '</span>' . self::asciiEncode($part3);
    }
    
    function getShowPHPHint()
    {
        return self::$_showPHPHint;
    }
    
    function setShowPHPHint($show)
    {
        self::$_showPHPHint = $show ? true : false;
    }

    function generatePHPHint($email)
    {
        if (self::$_showPHPHint)
        {
            return '<?php /* [' . $email . '] */ ?>';
        }
        return '';
    }

    /** Author: pedram at redhive dot com <http://www.php.net/bin2hex#11027>
      * Modified by Stephen F. George
    */
    function hexEncode($email_address)
    {
        $encoded = bin2hex($email_address . '');
        $encoded = chunk_split($encoded, 2, '%');
        $encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);
        return $encoded;
    }

    /** Author: pedram at redhive dot com <http://www.php.net/function.ord#24475>
      * Modified by Stephen F. George
    */
    function asciiEncode($string)
    {
        $encoded = '';
        for ($i=0; $i < strlen($string); $i++)
        {
            $encoded .= '&#'.ord(substr($string,$i)).';';    
        }
        return $encoded;
    }

}

?>

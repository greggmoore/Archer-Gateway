<?php

/**
 * Generates meta tags from an array of key/values
 *
 * @access  public
 * @param   array
 * @return  string
 */
if ( ! function_exists('meta'))
{
    function open_graph($property = '', $content = '', $type = 'property', $newline = "\n")
    {
        // Since we allow the data to be passes as a string, a simple array
        // or a multidimensional one, we need to do a little prepping.
        if ( ! is_array($property))
        {
            $property = array(array('property' => $property, 'content' => $content, 'type' => $type, 'newline' => $newline));
        }
        else
        {
            // Turn single array into multidimensional
            if (isset($property['property']))
            {
                $property = array($property);
            }
        }

        $str = '';
        foreach ($property as $meta)
        {
            $type       = ( ! isset($meta['type']) OR $meta['type'] == 'property') ? 'property' : 'http-equiv';
            $property       = ( ! isset($meta['property']))     ? ''    : $meta['property'];
            $content    = ( ! isset($meta['content']))  ? ''    : $meta['content'];
            $newline    = ( ! isset($meta['newline']))  ? "\n"  : $meta['newline'];

            $str .= '		<meta '.$type.'="'.$property.'" content="'.$content.'" />'.$newline;
        }

        return $str;
    }
}
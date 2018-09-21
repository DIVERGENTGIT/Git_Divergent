<?php

class MY_Config extends CI_Config
{
    function MY_Config()
    {
        parent::CI_Config();
    }

    function secure_site_url($uri = '')
    {
        if (is_array($uri))
        {
            $uri = implode('/', $uri);
        }

        if ($uri == '')
        {
            return $this-&gt;slash_item('secure_base_url').$this-&gt;item('index_page');
        }
        else
        {
            $suffix = ($this-&gt;item('url_suffix') == FALSE) ? '' : $this-&gt;item('url_suffix');
            return $this-&gt;slash_item('secure_base_url').$this-&gt;slash_item('index_page').preg_replace("|^/*(.+?)/*$|", "\\1", $uri).$suffix;
        }
    }
}

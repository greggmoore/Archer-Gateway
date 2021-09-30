<?php 
	
	/**
 * public function on_duplicate
 * Compiles an on duplicate key update string and runs the query
 * 
 * @access public
 * @param string - the table to retrieve the results from
 * @param array - an associative array of update value
 * @return object
 */
function on_duplicate($table = '', $set = NULL )
{
    if ( ! is_null($set))
    {
        $this->set($set);
    }

    if (count($this->ar_set) == 0)
    {
        if ($this->db_debug)
        {
            return $this->display_error('db_must_use_set');
        }
        return FALSE;
    }

    if ($table == '')
    {
        if ( ! isset($this->ar_from[0]))
        {
            if ($this->db_debug)
            {
                return $this->display_error('db_must_set_table');
            }
            return FALSE;
        }

        $table = $this->ar_from[0];
    }


    $sql = $this->_duplicate_insert($this->_protect_identifiers($this->dbprefix.$table), $this->ar_set );

    $this->_reset_write();
    return $this->query($sql);
}
?>
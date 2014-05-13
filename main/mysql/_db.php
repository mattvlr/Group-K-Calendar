<?php
//68.47.128.17
$base_url = 'http://10.0.0.12:220';
abstract class db_info
{	
	////////////////////////////////////////////
	// Our MySql Connection information
	// $base_url - used for link generation
	////////////////////////////////////////////
	const DB_SERVER = '10.0.0.12';
	const DB_PORT = '';
	const DB_USERNAME = 'root';
	const DB_PASSWORD = 'K';
	const DB_DATABASE = 'calendar';
    const BASE_URL = 'http://10.0.0.12:220';
	
	public $failed = false;
	protected $cur_query = "";
	public $query_id = null;
	protected $connection_id = null;
}
?>
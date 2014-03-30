<?php

$base_url = 'http://72.204.14.125:220';
abstract class db_info
{	
	////////////////////////////////////////////
	// Our MySql Connection information
	// $base_url - used for link generation
	////////////////////////////////////////////
	const DB_SERVER = '72.204.14.125';
	const DB_PORT = '';
	const DB_USERNAME = 'root';
	const DB_PASSWORD = 'K';
	const DB_DATABASE = 'calendar';
    const BASE_URL = 'http://72.204.14.125:220';
	
	public $failed = false;
	protected $cur_query = "";
	public $query_id = null;
	protected $connection_id = null;
}
?>
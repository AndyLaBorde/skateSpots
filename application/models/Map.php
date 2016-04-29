<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Model {

	function create($post)
	{
		$this->db->query("INSERT INTO maps (lng, lat) VALUES (?,?)", array($post['lng'], $post['lat']));
		
	}
	function show()
	{
		return $this->db->query("SELECT 
					spots.id as 'spot_id',
				    spots.user_id as 'spot_user_id',
				    spots.title,
				    spots.description,
				    spots.created_at,
				    spots.updated_at,
				    users.id as 'user_id',
				    CONCAT(users.first_name, ' ', users.last_name) as 'name',
				    users.username,
				    spots.map_id as 'spot_map_id',
				    maps.id as 'map_id',
				    maps.lng,
				    maps.lat
				FROM users
				JOIN spots ON users.id = spots.user_id
				JOIN maps ON spots.map_id = maps.id;")->result_array();
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spot extends CI_Model {

	function create($post)
	{
		$map_id = $this->db->query("SELECT * FROM maps ORDER BY id DESC LIMIT 1")->row_array();
		$query = "INSERT INTO spots (title, description, created_at, updated_at, user_id, map_id) VALUES (?,?,NOW(),NOW(),?,?)";
		$values = array($post['title'], $post['description'], $this->session->userdata('user_id'),$map_id['id']);
		$this->db->query($query, $values);
	}
	function search($post)
	{
		$search_term = $post['search'] . "%";
		return $this->db->query("SELECT
								spots.title,
							    maps.lng,
							    maps.lat
							from spots
							join maps on maps.id = spots.map_id
							where spots.title like ? limit 1;", array(htmlspecialchars($search_term)))->result_array();
	}
	function show($map_id)
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
				JOIN maps ON spots.map_id = maps.id
				WHERE maps.id = ?;", array($map_id))->row_array();
	}
	function show_all_spots()
	{
		return $this->db->query("SELECT * from spots order by id DESC")->row_array();
	}
}
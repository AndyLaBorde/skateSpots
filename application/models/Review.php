<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Model {

	function create($post, $spot_id, $session)
	{
		$query = "INSERT into reviews (rating, spot_id, user_id, created_at, updated_at) VALUES (?,?,?, NOW(), NOW())";
		$values = array($post['rating'], $spot_id, $session['user_id']);
		$this->db->query($query, $values);
	}
	function average($map_id)
	{
		return $this->db->query("SELECT 
									AVG(reviews.rating) as 'avg',
								    maps.id as 'map_id',
								    spots.id as 'spot_id',
								    users.id as 'user_id'
								    from reviews
								join spots on spots.id = reviews.spot_id
								join maps on maps.id  = spots.map_id
								join users on users.id = reviews.user_id
								where maps.id = ?", array($map_id))->row_array();
	}
}
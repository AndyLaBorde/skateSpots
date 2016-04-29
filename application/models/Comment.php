<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Model {

	function create($post, $session)
	{
		$query = "INSERT INTO comments (content, user_id, spot_id, created_at, updated_at) VALUES (?,?,?, NOW(), NOW())";
		$values = array($post['comment'], $session['user_id'], $post['spot_id']);
		$this->db->query($query, $values);
	}
	function show_by_map_id($map_id)
	{
		$query = "SELECT
					users.username,
				    comments.content,
				    comments.updated_at,
				    comments.id,
				    spots.id,
				    maps.id
				from users join comments on users.id = comments.user_id
				join spots on spots.id = comments.spot_id
				join maps on maps.id = spots.map_id
				where maps.id = ?
				ORDER BY comments.id DESC;";
		$values = array($map_id);
		return $this->db->query($query, $values)->result_array();
	}
}

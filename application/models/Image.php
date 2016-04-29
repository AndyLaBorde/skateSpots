<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Model {

	public function upload($image, $post, $session)
	{
		$query = "INSERT into images (file_path, spot_id, user_id) VALUES (?,?,?)";
		$values = array("/assets/img/" . $image['client_name'], $post['spot_id'], $session['user_id']);
		$this->db->query($query, $values);
	}
	function show_by_map_id($map_id)
	{
		return $this->db->query("SELECT
									images.file_path,
								    maps.id,
								    spots.id as 'spot_id'
								from images
								join spots on spots.id = images.spot_id
								join maps on maps.id = spots.map_id
								where maps.id = ?;", array($map_id))->result_array();
	}
}
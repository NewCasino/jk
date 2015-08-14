<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cms
 *
 * @author	ASRII
 */

class Cms extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
	}

	/**
	 * Get cms banner
	 *
	 * $bannerType int
	 * @return	$array
	 */
	public function getCmsBanner($bannerType) {
		$this->db->select('bannerName')
					->from('cmsbanner');
		$this->db->where('cmsbanner.category', $bannerType);
		$this->db->where('cmsbanner.status', 'active');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}
			
			return $data;
		}
		return false;
	}


	/**
	 * Get cms footer links
	 *
	 * @return	$array
	 */
	public function getCmsFooterLinks() {
		$language = $this->session->userdata('currentLanguage');

		$this->db->select('footercontentId,footercontentName')->from('cmsfootercontent');
		$this->db->where('cmsfootercontent.status', 'active');
		$this->db->where('cmsfootercontent.category', 'footer');
		$this->db->where('cmsfootercontent.language', $language);	
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}

	/**
	 * Get cms footer links
	 *
	 * $footerlinkId int
	 * @return	$array
	 */
	public function getCmsFooterContent($footerlinkId) {
		$language = $this->session->userdata('currentLanguage');

		$this->db->select('footercontentId,footercontentName,content')->from('cmsfootercontent');
		$this->db->where('cmsfootercontent.footercontentId', $footerlinkId);	
		$this->db->where('cmsfootercontent.language', $language);	

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}

	/**
	 * Get cms footer links
	 *
	 * $footerlinkId int
	 * @return	$array
	 */
	public function getCmsFooterContentData() {
		$language = $this->session->userdata('currentLanguage');

		$this->db->select('content')->from('cmsfootercontent');
		$this->db->where('cmsfootercontent.footercontentId', 1);	
		$this->db->where('cmsfootercontent.language', $language);		

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data[] = $row;
			}

			return $data;
		}
		return false;
	}

}
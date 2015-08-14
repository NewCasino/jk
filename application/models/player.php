<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * Player
 *
 * This model represents ip data. It operates the following tables:
 * - player
 * - playerdetails
 *
 * @author	Johann Merle
 */

class Player extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
	}

	function getPlayerByLogin($login) {
		$this->db->where('LOWER(username)=', strtolower($login));

		$query = $this->db->get('player');
		if ($query->num_rows() == 1) {
			return $query->row();
		}

		return NULL;
	}

	/**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function updateLoginInfo($player_id, $record_ip, $record_time) {
		if ($record_ip) {
			$this->db->set('lastLoginIp', $this->input->ip_address());
		}

		if ($record_time) {
			$this->db->set('lastLoginTime', date('Y-m-d H:i:s'));
		}

		$this->db->where('playerId', $player_id);
		$this->db->update('player');
	}

	/**
	 * Update user login info, such as logout time.
	 *
	 * @param	int
	 * @param	array
	 * @return	void
	 */
	function setLogout($player_id, $data) {

		$this->db->where('playerId', $player_id);
		$this->db->update('player', $data);
	}

	function getGameHistoryDetails($gameHistoryId) {
		$query = $this->db->query("SELECT * FROM playergamehistorydetails
			WHERE gameHistoryId = '" . $gameHistoryId . "'
			ORDER BY historyDetailsId DESC
		");

		$result = $query->result_array();
		if (!$result) {
			return false;
		} else {
			return $result;
		}
	}

	function addGameHistory($data) {
		$this->db->insert('playergamehistory', $data);

		$query = $this->db->query('SELECT * from playergamehistory ORDER BY gameHistoryId DESC');

		return $query->row_array();
	}

	function addGameHistoryDetails($data) {
		$result = $this->db->insert('playergamehistorydetails', $data);
	}

	function updateGameHistory($data, $gameHistoryId) {
		$this->db->where('gameHistoryId', $gameHistoryId);
		$this->db->update('playergamehistory', $data);
	}

	function updateCurrentMoney($data, $player_id) {
		$where = "playerId = '" . $player_id . "' AND type = 'wallet'";
		$this->db->where($where);
		$this->db->update('playeraccount', $data);
	}

	/**
	 * Will get all players
	 *
	 * @param 	int
	 * @param 	int
	 * @return 	array
	 */
	public function getAllPlayers($limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT p.*, t.tagName FROM player as p LEFT JOIN playertag as pt on p.playerId = pt.playerId LEFT JOIN tag as t on pt.tagId = t.tagId $limit $offset");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}

	/**
	 * Will get player given the Id
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerById($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT p.*, t.*, pd.*,
										p.playerId AS playerId,
										p.status AS playerStatus,
										p.createdOn AS playerCreatedOn,
										t.createdOn AS tagCreatedOn,
										t.status AS tagStatus
									FROM player AS p
									LEFT JOIN playerdetails AS pd
										ON p.playerId = pd.playerId
									LEFT JOIN playertag AS pt
										ON p.playerId = pt.playerId
									LEFT JOIN tag AS t
										ON pt.tagId = t.tagId
	 								WHERE p.playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerAccount($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT *, SUM(wa.amount) as totalBalance FROM player AS p LEFT JOIN playeraccount AS pa ON p.playerId = pa.playerId LEFT JOIN walletaccount AS wa ON pa.playeraccountid = wa.playeraccountid LEFT JOIN walletaccountdetails AS wad ON wa.walletaccountid = wad.walletaccountid WHERE p.playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get player main wallet
	 *
	 * @param $transactionId - int
	 * @return array
	 */

	public function getPlayerMainWallet($player_id) {
		$this->db->select('playeraccount.totalBalanceAmount')
		     ->from('playeraccount')->where('playeraccount.type', 'wallet');

		$this->db->where('playeraccount.playerId', $player_id);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data['mainwallet'] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/**
	 * Will get player username
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerUsername($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT username FROM player AS p WHERE p.playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerAccountByPlayerId($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM player AS p INNER JOIN playeraccount AS pa ON p.playerId = pa.playerId WHERE p.playerId = '" . $player_id . "' AND type = 'wallet'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerAccountByPlayerIdOnly($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT playerAccountId FROM player AS p INNER JOIN playeraccount AS pa ON p.playerId = pa.playerId WHERE p.playerId = '" . $player_id . "' AND type = 'wallet'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerAccountDetails($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM player AS p INNER JOIN playeraccount AS pa ON p.playerId = pa.playerId INNER JOIN walletaccount AS wa ON pa.playeraccountid = wa.playerAccountId INNER JOIN walletaccountdetails AS wad ON wa.walletaccountid = wad.walletaccountid WHERE p.playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerAccountHistory($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM player AS p INNER JOIN playeraccount AS pa ON p.playerId = pa.playerId INNER JOIN playeraccounthistory AS pdd ON pa.playerAccountId = pdd.playerAccountId WHERE p.playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get note given the Id
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerNotes($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT pn.*, au.username FROM player AS p INNER JOIN playernotes AS pn ON p.playerId = pn.playerId INNER JOIN adminusers AS au ON pn.userId = au.userId WHERE p.playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertPlayer($data) {
		//var_dump($data);exit();

		//$this->db = $this->load->database('default', TRUE);
		$this->db->insert('player', $data);
		//$playerId = $this->db->insert_id();

		// $playerLevel['playerId'] = $playerId;
		// $playerLevel['playerGroupId'] = 1;
		// $this->insertPlayerLevel($playerLevel);
	}

	/**
	 * Inserts data to playerLevel
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertPlayerLevel($data) {
		$this->db->insert('playerlevel', $data);
	}

	/**
	 * get data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function getPlayerDetails($player_id) {
		$query = $this->db->query("SELECT language, country, address, city, zipcode, contactNumber, imAccount, imAccountType, imAccount2, imAccountType2
			FROM playerdetails
			WHERE playerId = '" . $player_id . "'
		");

		return $query->row_array();
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertPlayerDetails($data) {
		$this->db->insert('playerdetails', $data);
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function editPlayerDetails($data, $player_id) {
		$this->db->where('playerId', $player_id);
		$this->db->update('playerdetails', $data);
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertPlayerTag($data) {
		$this->db->insert('playertag', $data);
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertTag($data) {
		$this->db->insert('tag', $data);
	}

	public function checkUsernameExist($username) {
		$query = $this->db->query("SELECT * FROM player WHERE username = '" . $username . "'");
		return $query->row_array();
	}

	public function checkEmailExist($email) {
		$query = $this->db->query("SELECT * FROM player WHERE email = '" . $email . "'");
		return $query->row_array();
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertPlayerNote($data) {
		$this->db->insert('playernotes', $data);
	}

	/**
	 * Delete data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function deleteNote($user_id, $note_id) {
		$where = "userId = '" . $user_id . "' AND noteId = '" . $note_id . "'";
		$this->db->where($where);
		$this->db->delete('playernotes');
	}

	/**
	 * Edit data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function editNote($user_id, $note_id, $data) {
		$where = "userId = '" . $user_id . "' AND noteId = '" . $note_id . "'";
		$this->db->where($where);
		$this->db->update('playernotes', $data);
	}

	/**
	 * Will get note based on the passed parameter
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getNoteById($note_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM playernotes WHERE noteId ='" . $note_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will search players based on the passed parameters
	 *
	 * @param 	string
	 * @param 	int
	 * @param 	int
	 * @param 	string
	 * @return	array
	 */
	public function searchPlayerList($search, $limit, $offset, $type) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		if ($type == 'vip') {
			$type = "AND vipStatus > 0";
		} elseif ($type == 'blacklist') {
			$type = "AND blocked != 0";
		} else {
			$type = "";
		}

		$query = $this->db->query("SELECT p.*, t.tagName FROM player as p LEFT JOIN playertag as pt on p.playerId = pt.playerId LEFT JOIN tag as t on pt.tagId = t.tagId
			where username LIKE
			'%" . $search . "%'
			$type
			$limit
			$offset
		");

		return $query->result_array();
	}

	/**
	 * Will sort players based on the passed parameters
	 *
	 * @param 	string
	 * @param 	int
	 * @param 	int
	 * @param 	string
	 * @return	array
	 */
	public function sortPlayerList($sort, $limit, $offset, $type) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		if ($type == 'vip') {
			$type = "where vipStatus > 0";
		} elseif ($type == 'blacklist') {
			$type = "where blocked != 0";
		} else {
			$type = "";
		}

		$query = $this->db->query("SELECT p.*, t.tagName FROM player as p LEFT JOIN playertag as pt on p.playerId = pt.playerId LEFT JOIN tag as t on pt.tagId = t.tagId
			$type ORDER BY $sort ASC
			$limit
			$offset
		");

		return $query->result_array();
	}

	/**
	 * Will get all vip players
	 *
	 * @param 	int
	 * @param 	int
	 * @return	array
	 */
	public function getVIPPlayers($limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT p.*, t.tagName FROM player as p LEFT JOIN playertag as pt on p.playerId = pt.playerId LEFT JOIN tag as t on pt.tagId = t.tagId WHERE
			 vipStatus > 0
			 $limit
			 $offset
		 ");

		return $query->result_array();
	}

	/**
	 * Will get all blacklist players
	 *
	 * @param 	int
	 * @param 	int
	 * @return	array
	 */
	public function getBlacklist($limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT p.*, t.tagName FROM player as p LEFT JOIN playertag as pt on p.playerId = pt.playerId LEFT JOIN tag as t on pt.tagId = t.tagId WHERE
			 blocked != 0
			 $limit
			 $offset
		 ");

		return $query->result_array();
	}

	/**
	 * Will get all affiliate players
	 *
	 * @param 	int
	 * @param 	int
	 * @return	array
	 */
	public function getAffiliate($limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM playeraffiliate
			 $limit
			 $offset
		 ");

		return $query->result_array();
	}

	/**
	 * Will search account process players based on the passed parameter
	 *
	 * @param 	string
	 * @param 	int
	 * @param 	int
	 * @return	array
	 */
	public function searchAccountProcessList($search, $limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM
			playeraffiliate where
			name LIKE
			'%" . $search . "%'
			$limit
			$offset
		");

		return $query->result_array();
	}

	/**
	 * Will sort account process players based on the passed parameter
	 *
	 * @param 	string
	 * @param 	int
	 * @param 	int
	 * @return	array
	 */
	public function sortAccountProcessList($sort, $limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM
			playeraffiliate ORDER BY $sort ASC
			$limit
			$offset
		");

		return $query->result_array();
	}

	/**
	 * Will get affiliate code based on the passed parameter
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getAffiliateCode($user_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT affiliateCode FROM adminusers where userId = '" . $user_id . "'");

		return $query->row_array();
	}

	/**
	 * Will add players affiliate based on the passed parameter
	 *
	 * @param 	array
	 * @return	array
	 */
	public function addPlayerAffiliate($data) {
		$this->db->insert('playeraffiliate', $data);

		$query = $this->db->query("SELECT playerAffiliateId FROM playeraffiliate ORDER BY playerAffiliateId DESC");

		return $query->row_array();
	}

	/**
	 * Will check if batch is already existing
	 *
	 * @param 	string
	 * @return	array
	 */
	public function checkBatchExist($name) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM playeraffiliate where name = '" . $name . "'");

		if (!empty($query->row_array())) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Will get player based on affiliate code
	 *
	 * @param 	int
	 * @param 	int
	 * @param 	int
	 * @return	array
	 */
	public function viewPlayerByAffiliateCode($affiliate_id, $limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM player where playerAffiliateId = '" . $affiliate_id . "' $limit $offset");

		return $query->result_array();
	}

	/**
	 * Will get affiliate based on affiliate id
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getAffiliateByPlayerAffiliateId($player_affiliate_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM playeraffiliate where playerAffiliateId = '" . $player_affiliate_id . "'");

		return $query->row_array();
	}

	/**
	 * Will edit player affiliate based on passed parameters
	 *
	 * @param 	array
	 * @param 	int
	 * @return	array
	 */
	public function editPlayerAffiliate($data, $player_affiliate_id) {
		$where = "playerAffiliateId = '" . $player_affiliate_id . "'";
		$this->db->where($where);
		$this->db->update('playeraffiliate', $data);
	}

	/**
	 * Will delete player affiliate based on passed parameter
	 *
	 * @param 	int
	 */
	public function deletePlayerAffiliate($player_affiliate_id) {
		$this->db->where('playerAffiliateId', $player_affiliate_id);
		$this->db->delete('playeraffiliate');
	}

	/**
	 * Will edit player affiliate based on passed parameters
	 *
	 * @param 	int
	 */
	public function deletePlayerByPlayerAffiliateId($player_affiliate_id) {
		$this->db->where('playerAffiliateId', $player_affiliate_id);
		$this->db->delete('player');
	}

	/**
	 * Will get player using the passed parameter
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerByPlayerId($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM player where playerId = '" . $player_id . "'");

		return $query->row_array();
	}

	/**
	 * Will edit player using the passed parameter
	 *
	 * @param 	array
	 * @param 	int
	 */
	public function editPlayer($data, $player_id) {
		$this->db->where('playerId', $player_id);
		$this->db->update('player', $data);
	}

	/**
	 * Will delete player using the passed parameter
	 *
	 * @param 	int
	 */
	public function deletePlayer($player_id) {
		$this->db->where('playerId', $player_id);
		$this->db->delete('player');
	}

	/**
	 * Will get all tags
	 *
	 * @return 	array
	 */
	public function getAllTags() {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM tag");

		if (!$query->result_array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}

	/**
	 * Will get tag based on the player id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getPlayerTag($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM playertag AS pt INNER JOIN tag AS t ON pt.tagId = t.tagId WHERE pt.playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get tag based on the name of the tag
	 *
	 * @param 	string
	 * @return 	array
	 */
	public function getPlayerTagByName($tag_name) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM tag WHERE tagName = '" . $tag_name . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get tag based on the id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getPlayerTagById($tag_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM playertag AS pt INNER JOIN tag AS t ON pt.tagId = t.tagId WHERE pt.tagId = '" . $tag_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will change the player's tag based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function changeTag($player_id, $data) {
		$this->db = $this->load->database('default', TRUE);

		$this->db->where('playerId', $player_id);
		$this->db->update('playertag', $data);
	}

	/**
	 * Will change the player's tag based on the passed parameters
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getReferralByPlayerId($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM player AS p INNER JOIN playerfriendreferral AS pfr ON p.playerId = pfr.playerId WHERE p.playerId = '" . $player_id . "'");

		if (!$query->result_array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}

	/**
	 * Will block the players based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function blockPlayer($player_id, $data) {
		$this->db->where('playerId', $player_id);
		$this->db->update('player', $data);
	}

	/**
	 * Will get the chat history
	 *
	 * @param 	int
	 * @param 	int
	 * @return 	array
	 */
	public function getChatHistory($limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM `playerchat` GROUP BY
			session ORDER BY
			chatId ASC
			$limit
			$offset
		");

		return $query->result_array();
	}

	/**
	 * Will search chat history based on the passed parameter
	 *
	 * @param 	string
	 * @param 	int
	 * @param 	int
	 * @return 	array
	 */
	public function searchChatHistoryList($search, $limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM
			`playerchat` where
			sender LIKE
			'%" . $search . "%' OR
			recepient LIKE
			'%" . $search . "%'  GROUP BY
			session
			$limit
			$offset
			$offset
		");

		return $query->result_array();
	}

	/**
	 * Will sort chat history based on the passed parameter
	 *
	 * @param 	string
	 * @param 	int
	 * @param 	int
	 * @return 	array
	 */
	public function sortChatHistoryList($sort, $limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM `playerchat` GROUP BY
			session ORDER BY
			$sort ASC
			$limit
			$offset
		");

		return $query->result_array();
	}

	/**
	 * Will get chat history based on the session
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getChatHistoryByPlayerId($session) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM `playerchat` where session = '" . $session . "'");

		return $query->result_array();
	}

	/**
	 * Will delete chat history based on the session
	 *
	 * @param 	int
	 */
	public function deleteChatHistory($session) {
		$where = "session = '" . $session . "'";
		$this->db->where($where);
		$this->db->delete('playerchat');
	}

	/**
	 * Will get all game history
	 *
	 * @param 	int
	 * @param 	int
	 * @return 	array
	 */
	public function getAllGameHistory($limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM player AS p INNER JOIN playergamehistory AS pgh ON p.playerId = pgh.playerId INNER JOIN playergamehistorydetails AS pghd ON pgh.gameHistoryId = pghd.gameHistoryId $limit $offset");

		return $query->result_array();
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getGameHistoryById($game_history_id) {

		$query = $this->db->query("SELECT * FROM player AS p INNER JOIN playergamehistory AS pgh ON p.playerId = pgh.playerId INNER JOIN playergamehistorydetails AS pghd ON pgh.gameHistoryId = pghd.gameHistoryId WHERE pgh.gameHistoryId = '" . $game_history_id . "'");

		return $query->row_array();
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function searchGameHistory($search, $limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM player AS p INNER JOIN playergamehistory AS pgh ON p.playerId = pgh.playerId INNER JOIN playergamehistorydetails AS pghd ON pgh.gameHistoryId = pghd.gameHistoryId WHERE p.username LIKE '%" . $search . "%' OR pgh.gameType LIKE '%" . $search . "%' $limit $offset");

		return $query->result_array();
	}

	/**
	 * Will sort game history based on the passed parameter
	 *
	 * @param 	string
	 * @param 	int
	 * @param 	int
	 * @return 	array
	 */
	public function sortGameHistory($sort, $limit, $offset) {
		$this->db = $this->load->database('default', TRUE);

		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT * FROM player AS p INNER JOIN playergamehistory AS pgh ON p.playerId = pgh.playerId INNER JOIN playergamehistorydetails AS pghd ON pgh.gameHistoryId = pghd.gameHistoryId ORDER BY $sort ASC $limit $offset");

		return $query->result_array();
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function changePlayerStatus($player_id, $data) {
		$this->db->where('playerId', $player_id);
		$this->db->update('player', $data);
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function createAccount($data) {
		$this->db->insert('playeraccount', $data);
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function createAccountDetails($data) {
		$result = $this->db->insert('walletaccount', $data);
		$walletAccountId = $this->db->insert_id();
		$this->session->set_userdata('depositWalletAccountId', $walletAccountId);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function depositThirdPartyAccount($data) {
		$result = $this->db->insert('walletaccount', $data);
		$walletAccountId = $this->db->insert_id();
		//$this->session->set_userdata('depositWalletAccountId', $walletAccountId);

		//$this->insertPaypalPaymentMethodDeatils();
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * manual 3rd party deposit
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function manual3rdPartyDeposit($walletAccountData, $manual3rdPartyDepositDetails) {
		$result = $this->db->insert('walletaccount', $walletAccountData);

		if ($result) {
			//insert manual 3rd party deposit
			$walletAccountId = $this->db->insert_id();
			$manual3rdPartyDepositDetails['walletAccountId'] = $walletAccountId;
			$this->insertManual3rdPartyDeposit($manual3rdPartyDepositDetails);

			return $result;
		} else {
			return false;
		}
	}

	/**
	 * local bank deposit
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function localBankDeposit($walletAccountData, $localBankDepositDetails) {
		$result = $this->db->insert('walletaccount', $walletAccountData);

		if ($result) {
			//insert local bank deposit
			$walletAccountId = $this->db->insert_id();
			$localBankDepositDetails['walletAccountId'] = $walletAccountId;
			$this->insertLocalBankDepositDetails($localBankDepositDetails);

			return $result;
		} else {
			return false;
		}
	}

	/**
	 * local bank withdrawal
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function localBankWithdrawal($walletAccountData, $localBankWithdrawalDetails) {
		$result = $this->db->insert('walletaccount', $walletAccountData);

		if ($result) {
			//insert local bank deposit
			$walletAccountId = $this->db->insert_id();
			$localBankWithdrawalDetails['walletAccountId'] = $walletAccountId;
			$this->insertLocalBankWithdrawalDetails($localBankWithdrawalDetails);

			return $result;
		} else {
			return false;
		}
	}

	/**
	 * local bank deposit
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function insertLocalBankDepositDetails($localBankDepositDetails) {
		$result = $this->db->insert('localbankdepositdetails', $localBankDepositDetails);
	}

	/**
	 * local bank deposit
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function insertLocalBankWithdrawalDetails($localBankDepositDetails) {
		$result = $this->db->insert('localbankwithdrawaldetails', $localBankDepositDetails);
	}

	/**
	 * local bank deposit
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function setPlayerBankaccountUndefault($playerBankDetailsId, $data) {
		//$data['isDefault'] = 0;
		$where = "playerBankDetailsId = '" . $playerBankDetailsId . "' AND dwBank = '0'";
		$this->db->where($where);
		$this->db->update('playerbankdetails', $data);
	}

	/**
	 * updateThirdpartyDeposit
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function updateThirdpartyDeposit($data, $depositWalletAccountId) {
		$this->db->where('walletAccountId', $depositWalletAccountId);
		$this->db->update('walletaccount', $data);
	}

	/**
	 * manual 3rd party deposit
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function insertManual3rdPartyDeposit($manual3rdPartyDepositDetails) {
		$result = $this->db->insert('manualthirdpartydepositdetails', $manual3rdPartyDepositDetails);
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function createAccountHistory($data) {
		$this->db->insert('playeraccounthistory', $data);
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function updatePlayerAccount($player_id, $player_account_id, $data) {
		$where = "playerId = '" . $player_id . "' AND playerAccountId = '" . $player_account_id . "'";
		$this->db->where($where);
		$this->db->update('playeraccount', $data);
	}

	/**
	 * Will change the player's tag based on the passed parameters
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getPlayerTotalBalance($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT *, SUM(totalBalanceAmount) AS totalBalance FROM playeraccount WHERE TYPE IN ('wallet', 'subwallet') AND playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get player mainwallet balance
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getPlayerMainWalletBalance($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT totalBalanceAmount FROM playeraccount WHERE TYPE IN ('wallet', 'subwallet') AND playerId = '" . $player_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will change the player's tag based on the passed parameters
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getPlayerTotalBonus($player_id) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT SUM(pp.bonusAmount) AS bonus FROM player AS p LEFT JOIN playerpromo AS pp ON p.playerId = pp.playerId WHERE p.playerId = '" . $player_id . "' AND pp.status NOT IN(0,2,5,6)");
		$bonus = $query->row_array();

		if (!$bonus['bonus']) {
			return 0;
		} else {
			return $bonus['bonus'];
		}
	}

	/**
	 * Will change the player's tag based on the passed parameters
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getDailyWithdrawal($player_id, $day) {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT SUM(wa.amount) AS totalAmountWithdraw FROM playeraccount AS pa LEFT JOIN walletaccount AS wa ON pa.playerAccountId = wa.playerAccountId WHERE pa.playerId = '" . $player_id . "' AND DAYOFMONTH(dwDateTime) = '" . $day . "' AND dwStatus = 'approved' AND transactionType = 'withdrawal' AND wa.status = '0'");
		$daily_max_withdrawal = $query->row_array();

		if (!$daily_max_withdrawal['totalAmountWithdraw']) {
			return 0;
		} else {
			return $daily_max_withdrawal['totalAmountWithdraw'];
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getRequestWithdrawal($player_id) {
		$query = $this->db->query("SELECT *, wa.walletAccountId AS walletAccountId,
								  (SELECT pm.paymentMethodName FROM paymentmethod as pm where pm.paymentMethodId = wa.dwMethod) as methodName,
								  (SELECT opm.bankName FROM otcpaymentmethoddetails as opmd
								  	LEFT JOIN otcpaymentmethod as opm on opmd.otcPaymentMethodId = opm.otcPaymentMethodId
								  	where wa.walletAccountId = opmd.walletAccountId) as bankName
									FROM playeraccount AS pa LEFT JOIN walletaccount AS wa ON pa.playerAccountId = wa.playerAccountId
									LEFT JOIN walletaccountdetails AS wad ON wa.walletAccountId = wad.walletaccountid
									WHERE playerId = '" . $player_id . "' AND dwStatus = 'request' AND transactionType = 'withdrawal' AND wa.status = '0' AND type = 'wallet'");

		if (!$query->result_array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getTotalAmountWithdraw($player_id) {
		$query = $this->db->query("SELECT SUM(wa.amount) as totalWithdrawAmount
								  	FROM playeraccount AS pa LEFT JOIN walletaccount AS wa ON pa.playerAccountId = wa.playerAccountId
									LEFT JOIN walletaccountdetails AS wad ON wa.walletAccountId = wad.walletaccountid
									WHERE playerId = '" . $player_id . "' AND dwStatus = 'request' AND transactionType = 'withdrawal' AND wa.status = '0' AND type = 'wallet'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function changeDWStatus($data, $wallet_account_id) {
		$this->db->where('walletAccountId', $wallet_account_id);
		$this->db->update('walletaccount', $data);
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getAllTransactionHistoryByPlayerId($player_id) {
		// $query = $this->db->query("SELECT *, wa.walletAccountId AS walletAccountId,
		// 						  (SELECT pm.paymentMethodName FROM paymentmethod as pm where pm.paymentMethodId = wa.dwMethod) as methodName,
		// 						  (SELECT opm.bankName FROM otcpaymentmethoddetails as opmd
		// 						  LEFT JOIN otcpaymentmethod as opm on opmd.otcPaymentMethodId = opm.otcPaymentMethodId
		// 						  WHERE wa.walletAccountId = opmd.walletAccountId) as bankName FROM playeraccount AS pa
		// 						  LEFT JOIN walletaccount AS wa ON pa.playerAccountId = wa.playerAccountId
		// 						  LEFT JOIN walletaccountdetails AS wad ON wa.walletAccountId = wad.walletaccountid
		// 						  WHERE playerId = '" . $player_id . "' AND wa.status = '0'");

		// if(!$query->result_array()) {
		// 	return false;
		// } else {
		// 	return $query->result_array();
		// }

		$this->db->select('walletaccount.transactionType,
						   walletaccount.amount,
						   walletaccount.dwDateTime,
						   walletaccount.dwStatus,
						   walletaccount.notes,
						   walletaccount.showNotesFlag,
						   paymentmethod.paymentMethodName as methodName,
						   otcpaymentmethod.bankName')
		     ->from('walletaccount')
		     ->join('paymentmethod', 'paymentmethod.paymentMethodId = walletaccount.dwMethod', 'left')
		     ->join('otcpaymentmethoddetails', 'otcpaymentmethoddetails.walletaccountid = walletaccount.walletaccountid', 'left')
		     ->join('otcpaymentmethod', 'otcpaymentmethod.otcPaymentMethodId = otcpaymentmethoddetails.otcPaymentMethodId', 'left')
		     ->join('playeraccount', 'playeraccount.playerAccountId = walletaccount.playerAccountId', 'left')
		     ->join('player', 'player.playerId = playeraccount.playerId', 'left');
		$this->db->where('player.playerId', $player_id);

		//var_dump($data);exit();

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$row['dwDateTime'] = mdate('%M %d, %Y %h:%i:%s %A', strtotime($row['dwDateTime']));
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getWalletAccountByPlayerId($player_id) {

		$query = $this->db->query("SELECT walletAccountId FROM player AS p
									LEFT JOIN playeraccount AS pa ON p.playerId = pa.playerId
									LEFT JOIN walletaccount AS wa ON pa.playerAccountId = wa.playerAccountId
									WHERE p.playerId = '" . $player_id . "' AND type = 'wallet' ORDER BY wa.walletAccountId DESC");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get bank type
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getAllBankType() {
		$query = $this->db->query("SELECT bankTypeId,bankName from banktype where status = 'active'");

		if (!$query->result_array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getOtcById($otc_payment_method_id) {

		$query = $this->db->query("SELECT * from otcpaymentmethod where otcPaymentMethodId = '" . $otc_payment_method_id . "' AND status = '0'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function checkPromoCodeExist($promo_code) {

		$query = $this->db->query("SELECT * from mkt_promo where promoCode = '" . $promo_code . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getPromoCode($promo_id) {

		$query = $this->db->query("SELECT promoCode from mkt_promo where promoId = '" . $promo_id . "' AND promoType = '0'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	// public function retrievePromo($promoId) {
	// 	$promos = array();
	// 	$this->db->select("* FROM (SELECT * FROM mkt_promo WHERE mkt_promo.promoId = '".$promoId."') promo", false);
	// 	$this->db->join('mkt_promodescription','promo.promoId = mkt_promodescription.promoId', 'left');
	// 	$this->db->join('mkt_promolevel','promo.promoId = mkt_promolevel.promoId', 'left');
	// 	$this->db->join('rankinglevelsetting','mkt_promolevel.levelId = rankinglevelsetting.rankingLevelSettingId', 'left');
	// 	$this->db->join('mkt_promogame','promo.promoId = mkt_promogame.promoId', 'left');
	// 	$this->db->join('game','mkt_promogame.gameId = game.gameId', 'left');
	// 	$this->db->join('mkt_promorule','promo.promoId = mkt_promorule.promoId', 'left');
	// 	$this->db->join('mkt_promocurrency','promo.promoId = mkt_promocurrency.promoId', 'left');
	// 	$this->db->join('mkt_currency','mkt_promocurrency.currencyId = mkt_currency.currencyId', 'left');
	// 	$this->db->join('( SELECT userId promoCreateBy, username promoCreateName from adminusers ) users','users.promoCreateBy = promo.promoCreateBy', 'left');
	// 	$this->db->order_by('promo.promoId', 'desc');
	// 	$this->db->order_by("mkt_promorule.promoRuleInValue", "asc");
	// 	$this->db->order_by("game.game", "asc");
	// 	$this->db->order_by("rankinglevelsetting.rankingLevelGroup", "asc");
	// 	$query = $this->db->get();
	// 	$result = $query->result_array();
	// 	return $this->data_mapper($result)[0];
	// }

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function insertOtcPaymentMethodDeatils($data) {
		$this->db->insert('otcpaymentmethoddetails', $data);
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function insertPaypalPaymentMethodDeatils($data) {
		$this->db->insert('paypalpaymentmethoddetails', $data);
		//checker
		if ($this->db->affected_rows() == '1') {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function insertStripePaymentMethodDeatils($data) {
		$this->db->insert('stripepaymentmethoddetails', $data);
	}

	private function data_mapper($data) {

		# Suppress errors caused by undefined index
		error_reporting(E_ALL ^ E_NOTICE);

		$promos = array();

		$this->lang->load('marketing');
		$this->lang->load('date');

		foreach ($data as $row) {

			$promoId = intval($row['promoId']);
			$promo = &$promos[$promoId];
			log_message('error', json_encode($row, JSON_PRETTY_PRINT));
			if (!$promo) {

				$promo['id'] = $promoId;

				$promo['name'] = $row['promoName'];

				$promo['description']['short'] = $row['promoShortDescription'];
				$promo['description']['long'] = $row['promoLongDescription'];
				$promo['description']['html'] = $row['promoHtmlDescription'];

				$promo['type']['code'] = intval($row['promoType']);
				$promo['type']['name'] = $this->lang->line('promoType_' . $row['promoType']);

				$promo['timezone']['code'] = $row['promoTimezone'];
				$promo['timezone']['name'] = $this->lang->line($row['promoTimezone']);
				$promo['timezone']['offset'] = $row['promoTimezoneOffset'];

				$promo['currency']['code'] = $row['currencyCode'];
				$promo['currency']['name'] = $row['currencyName'];

				$promo['period']['code'] = isset($row['promoPeriod']) ? intval($row['promoPeriod']) : null;
				$promo['period']['name'] = isset($row['promoPeriod']) ? $this->lang->line('promoPeriod_' . $row['promoPeriod']) : null;
				$promo['period']['length'] = isset($row['promoLength']) ? intval($row['promoLength']) : null;

				$promo['condition']['code'] = intval($row['promoConditionType']);
				$promo['condition']['name'] = $this->lang->line('promoConditionType_' . $row['promoConditionType']);
				$promo['condition']['value'] = isset($row['promoConditionValue']) ? intval($row['promoConditionValue']) : null;

				$promo['requirements']['code'] = intval($row['promoRequiredType']);
				$promo['requirements']['name'] = $this->lang->line('promoRequiredType_' . $row['promoRequiredType']);

				$promo['bonus']['minimum'] = $row['promoMinimumBonus'];
				$promo['bonus']['maximum'] = $row['promoMaximumBonus'];

				$promo['bonus']['release']['code'] = $row['promoBonusReleaseType'];
				$promo['bonus']['release']['name'] = $this->lang->line('promoBonusReleaseType_' . $row['promoBonusReleaseType']);
				$promo['bonus']['release']['value'] = $row['promoBonusReleaseValue'];

				$promo['bonus']['expiration']['code'] = $row['promoExpirationType'];
				$promo['bonus']['expiration']['name'] = $this->lang->line('promoExpirationType_' . $row['promoExpirationType']);
				$promo['bonus']['expiration']['value'] = $row['promoExpirationValue'];

				$promo['games'] = array();
				$promo['levels'] = array();
				$promo['rules'] = array();

				$promo['create']['id'] = intval($row['promoCreateBy']);
				$promo['create']['name'] = $row['promoCreateName'];
				$promo['create']['time'] = mdate('%F %d, %Y %h:%i:%s %A', strtotime($row['promoCreateTime']));

				$timezone = $row['promoTimezone'];
				$startDateTime = strtotime($row['promoStartTimestamp']);
				$endDateTime = strtotime($row['promoEndTimestamp']);
				$conditionStartDateTime = strtotime($row['promoConditionStartTimestamp']);
				$conditionEndDateTime = strtotime($row['promoConditionEndTimestamp']);

				$promo['period']['start'] = mdate('%F %d, %Y %h:%i %A', gmt_to_local($startDateTime, $timezone));
				$promo['period']['end'] = $endDateTime ? mdate('%F %d, %Y %h:%i %A', gmt_to_local($endDateTime, $timezone)) : 'Never';

				$promo['condition']['start'] = mdate('%F %d, %Y %h:%i %A', gmt_to_local($conditionStartDateTime, $timezone));
				$promo['condition']['end'] = mdate('%F %d, %Y %h:%i %A', gmt_to_local($conditionEndDateTime, $timezone));

				if ($startDateTime > now()) {
					$promo['status']['code'] = 0;
					$promo['status']['name'] = $this->lang->line('promoStatus_0');
				} else {
					if (!$endDateTime || $endDateTime > now()) {
						$promo['status']['code'] = 1;
						$promo['status']['name'] = $this->lang->line('promoStatus_1');
					} else {
						$promo['status']['code'] = -1;
						$promo['status']['name'] = $this->lang->line('promoStatus_-1');
					}
				}

			}

			# Maps the promoGames for the Promo
			$gameId = $row['gameId'];
			$promo['games'][$gameId] = $promo['games'][$gameId] ?: array(
				'id' => intval($gameId),
				'name' => $row['gameName'],
			);

			# Maps the promoLevels for the Promo
			$levelId = $row['levelId'];
			$promo['levels'][$levelId] = $promo['levels'][$levelId] ?: array(
				'id' => intval($levelId),
				'name' => $row['rankingLevelGroup'] . $row['rankingLevel'],
				'min' => $row['minBonus'],
				'max' => $row['maxBonus'],
			);

			# Maps the promoRules for the Promo
			$ruleId = $row['ruleId'];
			$promo['rules'][$ruleId] = $promo['rules'][$ruleId] ?: array(
				'id' => intval($ruleId),
				'in' => $row['promoRuleInValue'],
				'out' => $row['promoRuleOutValue'],
				'isOutPercent' => (boolean) $row['promoRuleOutValueIsPercent'],
				'points' => $row['promoRulePoints'],
				'isPointsPercent' => (boolean) $row['promoRulePointsIsPercent'],
			);

		} # End foreach

		# Flattens the array
		$promos = array_values($promos);
		foreach ($promos as &$promo) {
			$promo['games'] = array_values($promo['games']);
			$promo['levels'] = array_values($promo['levels']);
			$promo['rules'] = array_values($promo['rules']);
		}
		log_message('error', json_encode($promo, JSON_PRETTY_PRINT));
		return $promos;
	}

	function toDaysOfWeekArray($code) {
		$daysOfWeek = array();
		$bin = decbin($code);
		for ($i = 0; $i < 7; $i++) {
			if (substr($bin, $i, 1)) {
				$daysOfWeek[] = array(
					'code' => $i,
					'name' => date('l', strtotime("Monday +{$i} days")),
				);
			}
		}
		return $daysOfWeek;
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function checkIfAlreadyGetPromo($player_id, $promo_id) {

		$query = $this->db->query("SELECT * FROM playerpromo AS pp LEFT JOIN mkt_promo AS mp ON pp.promoId = mp.promoId WHERE pp.playerId = '" . $player_id . "' AND pp.promoId = '" . $promo_id . "' ORDER BY playerPromoId DESC");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getPlayerPromoNth($player_id, $promo_id) {

		$query = $this->db->query("SELECT * FROM playerpromo AS pp LEFT JOIN mkt_promo AS mp ON pp.promoId = mp.promoId WHERE pp.playerId = '" . $player_id . "' AND pp.promoId = '" . $promo_id . "'AND status > 0");

		if (!$query->result_array()) {
			return false;
		} else {
			return $query->result_array();
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function checkIfExpiredPromo($player_id, $promo_id) {

		$query = $this->db->query("SELECT * FROM playerpromo AS pp LEFT JOIN mkt_promo AS mp ON pp.promoId = mp.promoId WHERE pp.playerId = '" . $player_id . "' AND pp.promoId = '" . $promo_id . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function createPlayerPromo($data) {
		$this->db->insert('playerpromo', $data);
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function updatePlayerPromo($data, $player_id, $promo_id) {
		$where = "playerid = '" . $player_id . "' AND promoId = '" . $promo_id . "' AND status <= 3";
		$this->db->where($where);
		$this->db->update('playerpromo', $data);
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getTotalDepositFrom($start_date, $today, $player_account_id) {

		$query = $this->db->query("SELECT SUM(amount) as deposit FROM walletaccount WHERE dwStatus = 'approved' AND transactionType = 'deposit' AND playerAccountId = '" . $player_account_id . "' AND dwDateTime BETWEEN '" . $start_date . "' AND '" . $today . "'");
		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function checkIfFirstDeposit($player_id) {

		$query = $this->db->query("SELECT * FROM playeraccount AS pa INNER JOIN walletaccount AS wa ON pa.playerAccountId = wa.playerAccountId WHERE pa.playerId = '" . $player_id . "' AND type = 'wallet'");

		if (!$query->row_array()) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Will add withdrawal details
	 *
	 * @return 	array
	 */
	public function addWithdrawalDetails($data) {
		$result = $this->db->insert('withdrawaldetails', $data);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function checkIfReferralCodeExist($referral_code) {

		$query = $this->db->query("SELECT * FROM player WHERE invitationCode = '" . $referral_code . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function createPlayerReferral($data) {
		$this->db->insert('playerfriendreferral', $data);
	}

	/**
	 * Will change player status based on the passed parameters
	 *
	 * @param 	int
	 * @param 	array
	 * @return 	array
	 */
	public function createPlayerReferralDetails($data) {
		$this->db->insert('playerfriendreferraldetails', $data);
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	public function getPlayerFriendReferralId($player_id, $invited_player_id) {

		$query = $this->db->query("SELECT * FROM playerfriendreferral WHERE playerId = '" . $player_id . "' AND invitedPlayerId = '" . $invited_player_id . "'");
		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get game history based on id
	 *
	 * @param 	int
	 * @return 	array
	 */
	// public function getRankingLevelSettingByPlayerLevel($player_level) {

	// 	$query = $this->db->query("SELECT * FROM rankinglevelsetting WHERE rankingLevelSettingId = '" . $player_level . "'");
	// 	if(!$query->row_array()) {
	// 		return false;
	// 	} else {
	// 		return $query->row_array();
	// 	}
	// }

	/**
	 * get email in email table
	 *
	 * @return	array
	 */
	public function getEmail() {
		$query = $this->db->query("SELECT * FROM email");

		return $query->row_array();
	}

	/**
	 * get list of games
	 *
	 * @return  array
	 */
	public function getGames() {
		$query = $this->db->query("SELECT * FROM game");

		return $query->result_array();
	}

	/**
	 * get player account id of sub wallet
	 *
	 * @param  int
	 * @param  int
	 * @return  array
	 */
	public function getPlayerAccountBySubWallet($player_id, $game_id) {
		$query = $this->db->query("SELECT * FROM playeraccount where type IN ('wallet', 'subwallet') and playerId = '" . $player_id . "' and typeId = '" . $game_id . "'");

		return $query->row_array();
	}

	/**
	 * add to sub wallet details
	 *
	 * @param  array
	 */
	public function addToSubWalletDetails($data) {
		$this->db->insert('subwalletdetails', $data);
	}

	/**
	 * get all player account by playerId
	 *
	 * @param  int
	 * @return  array
	 */
	public function getAllPlayerAccountByPlayerId($player_id) {
		$query = $this->db->query("SELECT *,
			(SELECT g.game FROM game as g where g.gameId = p.typeId) as game
			FROM playeraccount as p where type = 'subwallet' and playerId = '" . $player_id . "'
		");

		return $query->result_array();
	}

	/**
	 * get all transfer history by playerId
	 *
	 * @param  int
	 * @return  array
	 */
	public function getAllTransferHistoryByPlayerId($player_id) {
		$query = $this->db->query("SELECT swd.amount, swd.requestDateTime, swd.processStatus,
			(SELECT g.game FROM playeraccount as pa LEFT JOIN game as g ON g.gameId = pa.typeId where pa.playerAccountId = swd.transferFrom) as transferFrom,
			(SELECT g.game FROM playeraccount as pa LEFT JOIN game as g ON g.gameId = pa.typeId where pa.playerAccountId = swd.transferTo) as transferTo
			FROM subwalletdetails as swd
			where swd.playerId = '" . $player_id . "'
		");

		return $query->result_array();
	}

	/**
	 * get all transfer history by playerId
	 *
	 * @param  int
	 * @return  array
	 */
	public function getAllTransferHistoryByPlayerIdWLimit($player_id, $limit, $offset) {
		if ($limit != null) {
			$limit = "LIMIT " . $limit;
		}

		if ($offset != null && $offset != 'undefined') {
			$offset = "OFFSET " . $offset;
		} else {
			$offset = ' ';
		}

		$query = $this->db->query("SELECT swd.amount, swd.requestDateTime, swd.processStatus,
			(SELECT g.game FROM playeraccount as pa LEFT JOIN game as g ON g.gameId = pa.typeId where pa.playerAccountId = swd.transferFrom) as transferFrom,
			(SELECT g.game FROM playeraccount as pa LEFT JOIN game as g ON g.gameId = pa.typeId where pa.playerAccountId = swd.transferTo) as transferTo
			FROM subwalletdetails as swd
			where swd.playerId = '" . $player_id . "'
			$limit
			$offset
		");

		return $query->result_array();
	}

	/**
	 * get userId if its using or child of roleId
	 *
	 * @param	int
	 * @return 	array
	 */
	public function getActiveCurrency() {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT * FROM currency where status = 0");

		return $query->row_array();
	}

	/**
	 * get email in email table
	 *
	 * @return	array
	 */
	public function getFriendReferralSettings() {
		$query = $this->db->query("SELECT * FROM friendreferralsettings");

		return $query->row_array();
	}

	/**
	 * get email in email table
	 *
	 * @return	array
	 */
	public function isReferredBy($player_id) {
		$query = $this->db->query("SELECT * FROM playerfriendreferral where invitedPlayerId = '" . $player_id . "' AND status = 0");

		return $query->row_array();
	}

	/**
	 * get all affiliates
	 *
	 * @return 	array
	 */
	public function getPlayerTotalDeposits($player_account_id) {
		$query = $this->db->query("SELECT SUM(amount) as totalDeposit, COUNT(*) as totalNumberOfDeposit FROM walletaccount WHERE playerAccountId = '" . $player_account_id . "' AND transactionType = 'deposit'  AND dwStatus = 'approved'");

		return $query->row_array();
	}

	/**
	 * update sub wallet
	 *
	 * @param   array
	 * @param   int
	 * @return  void
	 */
	public function updateSubWallet($data, $player_id) {
		$this->db->where('playerId', $player_id);
		$this->db->where('type', 'subwallet');
		$this->db->where('typeId', '1');
		$this->db->update('playeraccount', $data);
	}

	/**
	 * update sub wallet ag
	 *
	 * @param   array
	 * @param   int
	 * @return  void
	 */
	public function updateSubWalletAG($data, $player_id) {
		$this->db->where('playerId', $player_id);
		$this->db->where('type', 'subwallet');
		$this->db->where('typeId', '2');
		$this->db->update('playeraccount', $data);
	}

	/**
	 * Will set player new balance amount by playerAccountId
	 *
	 * @param $dataRequest - array
	 * @return Bool - TRUE or FALSE
	 */

	public function setPlayerNewBalAmountByPlayerAccountId($playerAccountId, $data) {
		$this->db->where('playerAccountId', $playerAccountId);
		$this->db->update('playeraccount', $data);

		if ($this->db->affected_rows() == '1') {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * get balace by playerAccountId
	 *
	 * @return  array
	 */
	public function getBalanceByPlayerAccountId($player_account_id) {
		$query = $this->db->query("SELECT * FROM playeraccount where playerAccountId = '" . $player_account_id . "'");

		$result = $query->row_array();

		return $result['totalBalanceAmount'];
	}

	/**
	 * get balace by playerAccountId
	 *
	 * @return  array
	 */
	public function getPaypalSettingsActive() {
		$query = $this->db->query("SELECT * FROM paypalsettings where status = '1'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	public function checkIfTransactionDetailsExitst($transaction_referrence) {
		$query = $this->db->query("SELECT * FROM paypalpaymentmethoddetails where transactionId = '" . $transaction_referrence . "'");

		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	public function createPlayerGame($data) {
		$this->db->insert('playergame', $data);
	}

	/**
	 * Will get all news
	 *
	 * @return  array
	 */
	public function getAllNews() {
		$lang = $this->session->userdata('currentLanguage');
		if ($lang == '') {
			$lang = 'en';
		}
		$query = $this->db->query("SELECT * FROM cmsnews where status != '1' AND language = '" . $lang . "' AND category IN('0', '3', '4', '6') ORDER BY newsId DESC LIMIT 3");

		return $query->result_array();
	}

	/**
	 * Will get all news
	 *
	 * @return  array
	 */
	public function getBankById($otc_payment_method_id) {
		$query = $this->db->query("SELECT * FROM otcpaymentmethod where otcPaymentMethodId = '" . $otc_payment_method_id . "'");

		return $query->row_array();
	}

	/**
	 * get all affiliates
	 *
	 * @return 	array
	 */
	public function getDailyDeposit($player_account_id, $day, $otc_payment_method_id) {
		$query = $this->db->query("SELECT SUM(wa.amount) AS totalDeposit, COUNT(*) AS totalNumberOfDeposit
									FROM playeraccount AS pa
									INNER JOIN walletaccount AS wa ON pa.playerAccountId = wa.playerAccountId
									INNER JOIN otcpaymentmethoddetails AS opmd ON wa.walletAccountId = opmd.walletAccountId
									INNER JOIN otcpaymentmethod AS opm ON opmd.otcPaymentMethodId = opm.otcPaymentMethodId
									WHERE pa.playerAccountId = '" . $player_account_id . "'
										AND DAYOFMONTH(dwDateTime) = '" . $day . "'
										AND wa.transactionType = 'deposit'
										AND wa.dwStatus = 'approved'
										AND wa.status = 0
										AND opm.otcPaymentMethodId = '" . $otc_payment_method_id . "'");

		return $query->row_array();
	}

	/**
	 * get all affiliates
	 *
	 * @return 	array
	 */
	public function getDailyDepositToPaymentMethod($player_account_id, $day, $otc_payment_method_id) {
		$query = $this->db->query("SELECT SUM(wa.amount) AS totalDeposit, COUNT(*) AS totalNumberOfDeposit
									FROM playeraccount AS pa
									INNER JOIN walletaccount AS wa ON pa.playerAccountId = wa.playerAccountId
									INNER JOIN otcpaymentmethoddetails AS opmd ON wa.walletAccountId = opmd.walletAccountId
									INNER JOIN otcpaymentmethod AS opm ON opmd.otcPaymentMethodId = opm.otcPaymentMethodId
									WHERE pa.playerAccountId = '" . $player_account_id . "'
										AND DAYOFMONTH(dwDateTime) = '" . $day . "'
										AND wa.transactionType = 'deposit'
										AND wa.dwStatus = 'request'
										AND wa.status = 0
										AND opm.otcPaymentMethodId = '" . $otc_payment_method_id . "'");

		return $query->row_array();
	}

	/**
	 * Will get player level of user
	 *
	 * @return  array
	 */
	public function getPlayerLevelGame($player_id) {
		//$query = $this->db->query("SELECT * FROM playerlevel where playerId = '" . $player_id . "'");
		$this->db->select('playerlevel.*,
						   vipsettingcashbackbonuspergame.gameType')
		     ->from('playerlevel')
		     ->join('vipsettingcashbackrule', 'vipsettingcashbackrule.vipsettingcashbackruleId = playerlevel.playerGroupId', 'left')
		     ->join('vipsettingcashbackbonuspergame', 'vipsettingcashbackbonuspergame.vipsettingcashbackruleId = vipsettingcashbackrule.vipsettingcashbackruleId', 'left');
		$this->db->where('playerlevel.playerId', $player_id);
		$this->db->where('vipsettingcashbackbonuspergame.allowStatus', '0');

		//var_dump($data);exit();

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
	}

	/**
	 * Will get player level of user
	 *
	 * @return  array
	 */
	// public function getPlayerLevels() {
	// 	$normal = $this->db->query("SELECT rankingLevelSettingId  FROM rankinglevelsetting WHERE rankingLevelGroup = 'Normal' ORDER BY rankingLevel ASC");
	// 	$normal = $normal->row_array();

	// 	$vip = $this->db->query("SELECT rankingLevelSettingId FROM rankinglevelsetting WHERE rankingLevelGroup = 'VIP' ORDER BY rankingLevel ASC");
	// 	$vip = $vip->row_array();

	// 	$result = array(
	// 			'normal' => $normal['rankingLevelSettingId'],
	// 			'vip' => $vip['rankingLevelSettingId']
	// 		);
	// 	return $result;
	// }

	public function getActivePromo($player_id) {
		$query = $this->db->query("SELECT * FROM playerpromo where playerId = '" . $player_id . "' AND status != 3 AND status != 5 AND status != 6");

		return $result = $query->row_array();
	}

	public function getPromoById($promo_id) {
		$query = $this->db->query("SELECT * FROM mkt_promo where promoId = '" . $promo_id . "'");

		return $result = $query->row_array();
	}

	public function getPlayerPromo($player_id) {
		$query = $this->db->query("SELECT *, SUM(pp.bonusAmount) AS bonus
    								FROM player AS p
    								INNER JOIN playerpromo AS pp ON p.playerId = pp.playerId
    								LEFT JOIN mkt_promo AS mp ON pp.promoId = mp.promoId
    								LEFT JOIN mkt_promogame AS mpg ON mp.promoId = mpg.promoId
    								LEFT JOIN game AS g ON mpg.gameId = g.gameId
    								WHERE p.playerId = '" . $player_id . "' AND pp.status NOT IN (0,2,5,6)");

		return $result = $query->row_array();
	}

	public function getGameById($game_id) {
		$query = $this->db->query("SELECT * FROM game where gameId = '" . $game_id . "'");

		return $result = $query->row_array();
	}

	/**
	 * get email in email table
	 *
	 * @return	array
	 */
	public function resetPassword($player_id, $data) {
		$this->db->where('playerId', $player_id);
		$this->db->update('player', $data);
	}

	/**
	 * get bank details
	 *
	 * @return	array
	 */
	public function getBankDetails($player_id) {
		$dBank = $this->db->query("SELECT pbd.*, opt.bankName FROM playerbankdetails as pbd inner join banktype as opt on pbd.bankTypeId = opt.bankTypeId where playerId = '" . $player_id . "' AND dwBank = '0' AND isRemember = '1' ORDER BY isDefault DESC");
		$wBank = $this->db->query("SELECT pbd.*, opt.bankName FROM playerbankdetails as pbd inner join banktype as opt on pbd.bankTypeId = opt.bankTypeId where playerId = '" . $player_id . "' AND dwBank = '1' AND isRemember = '1' ORDER BY isDefault DESC");

		$result = array(
			'deposit' => $dBank->result_array(),
			'withdrawal' => $wBank->result_array(),
		);

		return $result;
	}

	/**
	 * get bank details
	 *
	 * @return	array
	 */
	public function getDepositBankDetails($playerId) {
		$this->db->select('playerbankdetails.playerBankDetailsId,
						   playerbankdetails.bankAccountFullName,
						   banktype.bankName,
						  ')
		     ->from('playerbankdetails')
		     ->join('banktype', 'banktype.bankTypeId = playerbankdetails.bankTypeId', 'left')
		     ->order_by('playerbankdetails.bankAccountFullName', 'asc');
		$this->db->where('playerbankdetails.playerId', $playerId);
		$this->db->where('playerbankdetails.dwBank', '0'); //0 = deposit
		$this->db->where('playerbankdetails.status', '0'); //0 = active
		$this->db->where('playerbankdetails.isRemember', '1'); //1 = remembered

		$query = $this->db->get();
		//var_dump($query->result_array());exit();
		return $query->result_array();
	}

	/**
	 * get bank details
	 *
	 * @return	array
	 */
	public function getWithdrawalBankDetails($playerId) {
		$this->db->select('playerbankdetails.playerBankDetailsId,
						   playerbankdetails.bankAccountFullName,
						   banktype.bankName,
						  ')
		     ->from('playerbankdetails')
		     ->join('banktype', 'banktype.bankTypeId = playerbankdetails.bankTypeId', 'left')
		     ->order_by('playerbankdetails.bankAccountFullName', 'asc');
		$this->db->where('playerbankdetails.playerId', $playerId);
		$this->db->where('playerbankdetails.dwBank', '1'); //1 = withdrawal
		$this->db->where('playerbankdetails.status', '0'); //0 = active
		$this->db->where('playerbankdetails.isRemember', '1'); //1 = remembered

		$query = $this->db->get();
		//var_dump($query->result_array());exit();
		return $query->result_array();
	}

	/**
	 * get email in email table
	 *
	 * @return	array
	 */
	public function updateBankDetails($bank_details_id, $data) {
		$this->db->where('playerBankDetailsId', $bank_details_id);
		$this->db->update('playerbankdetails', $data);
	}

	/**
	 * get email in email table
	 *
	 * @return	array
	 */
	public function deleteBankDetails($bank_details_id) {
		$this->db->where('playerBankDetailsId', $bank_details_id);
		$this->db->delete('playerbankdetails');
	}

	/**
	 * add bank details
	 *
	 * @return	array
	 */
	public function addBankDetails($data) {
		$this->db->insert('playerbankdetails', $data);
	}

	/**
	 * add bank details by deposit
	 *
	 * @return	array
	 */
	public function addBankDetailsByDeposit($data) {
		$this->db->insert('playerbankdetails', $data);
		return $playerbankdetailsId = $this->db->insert_id();
	}

	/**
	 * add bank details by deposit
	 *
	 * @return	array
	 */
	public function addBankDetailsByWithdrawal($data) {
		$this->db->insert('playerbankdetails', $data);
		return $playerbankdetailsId = $this->db->insert_id();
	}

	/**
	 * get email in email table
	 *
	 * @return	array
	 */
	public function editBankDetails($bank_details_id, $data) {
		$this->db->where('playerBankDetailsId', $bank_details_id);
		$this->db->update('playerbankdetails', $data);
	}

	public function getActiveBankDetails($dw_bank) {
		$query = $this->db->query("SELECT playerBankDetailsId FROM playerbankdetails where isDefault = '1' AND dwBank = '" . $dw_bank . "'");

		return $result = $query->row_array();
	}

	public function getAllDeposits($playerId) {
		//$query = $this->db->query("SELECT * FROM playeraccount as pa inner join walletaccount as wa on pa.playerAccountId = wa.playerAccountId where playerId = '" . $player_id . "' AND transactionType = 'deposit' AND type = 'wallet'");
		$this->db->select('walletaccount.dwDateTime,
    					   walletaccount.processDatetime,
    					   walletaccount.transactionCode,
    					   walletaccount.dwMethod,
    					   walletaccount.amount,
    					   walletaccount.notes,
    					   walletaccount.showNotesFlag,
    					   walletaccount.transactionCode,
    					   walletaccount.transactionType,
    					   walletaccount.dwStatus,
						  ')
		     ->from('playeraccount')
		     ->join('walletaccount', 'walletaccount.playerAccountId = playeraccount.playerAccountId', 'left')
		     ->order_by('walletaccount.walletAccountId', 'desc');
		$this->db->where('playeraccount.playerId', $playerId);
		$this->db->where('walletaccount.transactionType', 'deposit');
		$this->db->where('playeraccount.type', 'wallet');
		$query = $this->db->get();
		return $result = $query->result_array();
	}

	public function getAllDepositsWLimit($playerId, $limit, $offset) {
		//$query = $this->db->query("SELECT * FROM playeraccount as pa inner join walletaccount as wa on pa.playerAccountId = wa.playerAccountId where playerId = '" . $player_id . "' AND transactionType = 'deposit' AND type = 'wallet'");
		$this->db->select('walletaccount.dwDateTime,
    					   walletaccount.processDatetime,
    					   walletaccount.transactionCode,
    					   walletaccount.dwMethod,
    					   walletaccount.amount,
    					   walletaccount.notes,
    					   walletaccount.showNotesFlag,
    					   walletaccount.transactionCode,
    					   walletaccount.transactionType,
    					   walletaccount.dwStatus,
						  ')
		     ->from('playeraccount')
		     ->join('walletaccount', 'walletaccount.playerAccountId = playeraccount.playerAccountId', 'left')
		     ->order_by('walletaccount.walletAccountId', 'desc')
		     ->limit($limit, $offset);
		$this->db->where('playeraccount.playerId', $playerId);
		$this->db->where('walletaccount.transactionType', 'deposit');
		$this->db->where('playeraccount.type', 'wallet');
		$query = $this->db->get();
		return $result = $query->result_array();
	}

	public function getAllWithdrawals($playerId) {
		//$query = $this->db->query("SELECT * FROM playeraccount as pa inner join walletaccount as wa on pa.playerAccountId = wa.playerAccountId where playerId = '" . $player_id . "' AND transactionType = 'withdrawal' AND type = 'wallet'");

		$this->db->select('walletaccount.dwDateTime,
    					   walletaccount.processDatetime,
    					   walletaccount.transactionCode,
    					   walletaccount.dwMethod,
    					   walletaccount.amount,
    					   walletaccount.notes,
    					   walletaccount.showNotesFlag,
    					   walletaccount.transactionCode,
    					   walletaccount.transactionType,
    					   walletaccount.dwStatus,
						  ')
		     ->from('playeraccount')
		     ->join('walletaccount', 'walletaccount.playerAccountId = playeraccount.playerAccountId', 'left')
		     ->order_by('walletaccount.walletAccountId', 'desc');
		$this->db->where('playeraccount.playerId', $playerId);
		$this->db->where('walletaccount.transactionType', 'withdrawal');
		$this->db->where('playeraccount.type', 'wallet');

		$query = $this->db->get();
		return $result = $query->result_array();

	}

	public function getAllWithdrawalsWLimit($playerId, $limit, $offset) {
		//$query = $this->db->query("SELECT * FROM playeraccount as pa inner join walletaccount as wa on pa.playerAccountId = wa.playerAccountId where playerId = '" . $player_id . "' AND transactionType = 'withdrawal' AND type = 'wallet'");

		$this->db->select('walletaccount.dwDateTime,
    					   walletaccount.processDatetime,
    					   walletaccount.transactionCode,
    					   walletaccount.dwMethod,
    					   walletaccount.amount,
    					   walletaccount.notes,
    					   walletaccount.showNotesFlag,
    					   walletaccount.transactionCode,
    					   walletaccount.transactionType,
    					   walletaccount.dwStatus,
						  ')
		     ->from('playeraccount')
		     ->join('walletaccount', 'walletaccount.playerAccountId = playeraccount.playerAccountId', 'left')
		     ->order_by('walletaccount.walletAccountId', 'desc')
		     ->limit($limit, $offset);
		$this->db->where('playeraccount.playerId', $playerId);
		$this->db->where('walletaccount.transactionType', 'withdrawal');
		$this->db->where('playeraccount.type', 'wallet');

		$query = $this->db->get();
		return $result = $query->result_array();

	}

	public function getMaxNumberOfWalletAccount() {
		$query = $this->db->query("SELECT walletAccountId FROM walletaccount order by walletAccountId DESC");

		return $result = $query->row_array();
	}

	public function populateDeposits($player_id, $data) {
		$between = "";

		if (!empty($data['from']) && !empty($data['to'])) {
			$between = "AND dwDateTime BETWEEN '" . $data['from'] . "' AND '" . $data['to'] . "'";
		}

		$query = $this->db->query("SELECT * FROM playeraccount as pa inner join walletaccount as wa on pa.playerAccountId = wa.playerAccountId where playerId = '" . $player_id . "' AND transactionType = 'deposit' AND type = 'wallet' $between");

		return $result = $query->result_array();
	}

	public function populateWithdrawals($player_id, $data) {
		$between = "";

		if (!empty($data['from']) && !empty($data['to'])) {
			$between = "AND dwDateTime BETWEEN '" . $data['from'] . "' AND '" . $data['to'] . "'";
		}

		$query = $this->db->query("SELECT * FROM playeraccount as pa inner join walletaccount as wa on pa.playerAccountId = wa.playerAccountId where playerId = '" . $player_id . "' AND transactionType = 'withdrawal' AND type = 'wallet' $between");

		return $result = $query->result_array();
	}

	/**
	 * get all transfer history by playerId
	 *
	 * @param  int
	 * @return  array
	 */
	public function populateTrasferHistory($player_id, $data) {
		$between = "";

		if (!empty($data['from']) && !empty($data['to'])) {
			$between = "AND swd.requestDateTime BETWEEN '" . $data['from'] . "' AND '" . $data['to'] . "'";
		}

		$query = $this->db->query("SELECT swd.amount, swd.requestDateTime, swd.processStatus,
			(SELECT g.game FROM playeraccount as pa LEFT JOIN game as g ON g.gameId = pa.typeId where pa.playerAccountId = swd.transferFrom) as transferFrom,
			(SELECT g.game FROM playeraccount as pa LEFT JOIN game as g ON g.gameId = pa.typeId where pa.playerAccountId = swd.transferTo) as transferTo
			FROM subwalletdetails as swd
			where swd.playerId = '" . $player_id . "'
			$between
		");

		return $query->result_array();
	}

	/**
	 * Will get player available bank account deposit
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerAvailableBankAccountDeposit($playerId) {
		$playerLevel = $this->getPlayerGroupLevel($playerId);
		//var_dump($playerLevel);exit();
		$this->db->select('otcpaymentmethod.otcPaymentMethodId,
						   otcpaymentmethod.bankName,
						   otcpaymentmethod.branchName,
						   otcpaymentmethod.accountNumber,
						   otcpaymentmethod.accountName
						  ')
		     ->from('bankaccountplayerlevellimit')
		     ->join('otcpaymentmethod', 'otcpaymentmethod.otcPaymentMethodId = bankaccountplayerlevellimit.bankAccountId')
		     ->join('vipsettingcashbackrule', 'vipsettingcashbackrule.vipsettingcashbackruleId = bankaccountplayerlevellimit.playerLevelId')
		     ->order_by('otcpaymentmethod.accountOrder', 'asc');
		$this->db->where('otcpaymentmethod.status', 'active');

		$query = $this->db->get();
		//var_dump($query->result_array());exit();
		return $query->result_array();
	}

	/**
	 * Will get player available third party account deposit
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerAvailableThirdPartyAccountDeposit($playerId) {
		$playerLevel = $this->getPlayerGroupLevel($playerId);
		//var_dump($playerLevel[0]['playerGroupId']);exit();
		$this->db->select('thirdpartypaymentmethodaccount.thirdpartypaymentmethodaccountId,
						   thirdpartypaymentmethodaccount.thirdpartyName,
						   thirdpartypaymentmethodaccount.thirdpartyAccountName,
						   thirdpartypaymentmethodaccount.thirdpartyAccount
						  ')
		     ->from('thirdpartypaymentmethodaccount')
		     ->join('thirdpartyaccountplayerlevellimit', 'thirdpartyaccountplayerlevellimit.thirdPartyAccountId = thirdpartypaymentmethodaccount.thirdpartypaymentmethodaccountId')
		     //->join('vipsettingcashbackrule','vipsettingcashbackrule.vipsettingcashbackruleId = thirdpartyaccountplayerlevellimit.playerLevelId')
		     ->order_by('thirdpartypaymentmethodaccount.accountOrder', 'asc');
		$this->db->where('thirdpartypaymentmethodaccount.status', 'active');
		$this->db->where('thirdpartyaccountplayerlevellimit.playerLevelId', $playerLevel[0]['playerGroupId']);

		$query = $this->db->get();
		//var_dump($query->result_array());exit();
		return $query->result_array();
	}

	/**
	 * Will get player available bank account deposit
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerGroupLevel($playerId) {
		$this->db->select('playerlevel.playerGroupId')
		     ->from('playerlevel');
		$this->db->where('playerlevel.playerId', $playerId);

		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Will get player deposit rule
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerDepositRule($playerId) {
		$playerLevel = $this->getPlayerGroupLevel($playerId);
		//var_dump($playerLevel[0]['playerGroupId']);exit();
		$this->db->select('vipsettingcashbackrule.minDeposit,vipsettingcashbackrule.maxDeposit')
		     ->from('playerlevel')
		     ->join('vipsettingcashbackrule', 'vipsettingcashbackrule.vipsettingcashbackruleId = playerlevel.playerGroupId', 'left');
		$this->db->where('playerlevel.playerId', $playerId);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * Will get player deposit rule
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerWithdrawalRule($playerId) {
		$playerLevel = $this->getPlayerGroupLevel($playerId);
		//var_dump($playerLevel[0]['playerGroupId']);exit();
		$this->db->select('vipsettingcashbackrule.dailyMaxWithdrawal')
		     ->from('playerlevel')
		     ->join('vipsettingcashbackrule', 'vipsettingcashbackrule.vipsettingcashbackruleId = playerlevel.playerGroupId', 'left');
		$this->db->where('playerlevel.playerId', $playerId);
		$query = $this->db->get();
		// return $query->result_array();
		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * Will get player total withdrawal today
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getPlayerCurrentTotalWithdrawalToday($playerAccountId) {
		//var_dump($todayAm);exit();
		$this->db->select('SUM(walletaccount.amount) AS totalWithdrawalToday')
		     ->from('walletaccount')
		     ->join('playeraccount', 'playeraccount.playerAccountId = walletaccount.playerAccountId', 'left');
		$this->db->where('walletaccount.playerAccountId', $playerAccountId);
		$this->db->where('walletaccount.walletType', 'Main');
		$this->db->where('walletaccount.dwStatus', 'approved');
		$this->db->where('walletaccount.transactionType', 'withdrawal');
		$this->db->where('walletaccount.processDatetime >=', date('Y-m-d') . ' 00:00:00');
		$this->db->where('walletaccount.processDatetime <=', date('Y-m-d') . ' 23:59:59');
		$query = $this->db->get();
		// return $query->result_array();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/**
	 * Will get player deposit rule
	 *
	 * @param 	int
	 * @return	array
	 */
	public function getBankDetailsById($bankDetailsId) {
		$this->db->select('playerBankDetailsId,bankAccountFullName,bankAccountNumber,bankAddress,city,province,branch')->from('playerbankdetails');
		$this->db->where('playerbankdetails.playerbankdetailsId', $bankDetailsId);
		$query = $this->db->get();
		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * update 3rd party deposit status
	 *
	 * @param   array
	 * @param   int
	 * @return  void
	 */
	public function update3rdPartyDepositRequest($walletAccountId, $data) {
		$this->db->where('walletAccountId', $walletAccountId);
		$this->db->update('walletaccount', $data);
	}

	/**
	 * Will get player balance
	 *
	 * @param 	sort_by array
	 * @param 	limit int
	 * @return 	array
	 */
	public function getPlayerCashbackWalletBalance($playerId) {
		$this->db->select('SUM(playercashback.amount) AS cashbackwalletBalanceAmount
						   ')
		     ->from('playercashback');

		$this->db->where('playercashback.playerId', $playerId);
		$this->db->where('playercashback.receivedOn', date('Y-m-d'));

		$query = $this->db->get();
		//var_dump($query->result_array());exit();
		return $query->result_array();
	}

	/**
	 * Will check if player promo exist and active
	 *
	 * @param 	playerId int
	 * @return	array
	 */
	public function checkPlayerPromoActive($playerId) {
		$this->db->select('promoStatus')->from('playerdepositpromo');
		$this->db->where('playerId', $playerId);
		$this->db->where('promoStatus', 0); //0-active
		$this->db->where('transactionStatus', 1); //approved status

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return TRUE;
		}
		return false;
	}

	/**
	 * Will set player new balance amount
	 *
	 * @param $dataRequest - array
	 * @return Bool - TRUE or FALSE
	 */

	public function setPlayerNewBalAmount($playerId, $data) {
		$this->db->where('playerId', $playerId);
		$this->db->where('type', 'wallet');
		$this->db->update('playeraccount', $data);

		if ($this->db->affected_rows() == '1') {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Will get player promo exist and active
	 *
	 * @param 	playerId int
	 * @return	array
	 */
	public function getPlayerPromoActive($playerId) {
		$this->db->select('promoStatus')->from('playerdepositpromo');
		$this->db->where('playerId', $playerId);
		$this->db->where('promoStatus', 0); //0-active
		$this->db->where('transactionStatus', 1); //approved status

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;

	}

	/**
	 * Will check if player promo request exist
	 *
	 * @param 	playerId int
	 * @return	array
	 */
	public function checkPlayerPromoRequest($playerId) {
		$this->db->select('promoStatus')->from('playerdepositpromo');
		$this->db->where('playerId', $playerId);
		$this->db->where('transactionStatus', 0); //request status

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return TRUE;
		}
		return false;
	}

	/**
	 * Will check if player level
	 *
	 * @param 	playerId int
	 * @return	array
	 */
	public function checkDepositPromoLevelRule($playerId, $depositPromoId) {
		echo 'promoId: ' . $depositPromoId;
		$this->db->select('depositPromoId')->from('depositpromoplayerlevellimit')
		     ->join('playerlevel', 'playerlevel.playerGroupId = depositpromoplayerlevellimit.playerLevelId', 'left')
		     ->join('player', 'player.playerId = playerlevel.playerId', 'left');
		$this->db->where('player.playerId', $playerId);
		$this->db->where('depositpromoplayerlevellimit.depositPromoId', $depositPromoId); //request status

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return TRUE;
		}
		return false;
	}

	/**
	 * get promo details
	 *
	 * @param 	playerId int
	 * @return	array
	 */
	public function getPromoDetails($depositpromoId) {
		$this->db->select('requiredDepositAmount,bonusAmount,bonusAmountRuleType,maxBonusAmount,totalBetRequirement,expirationDayCnt')->from('depositpromo');
		$this->db->where('depositpromoId', $depositpromoId);

		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * add deposit promo request
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function applyDepositPromo($data) {
		$this->db->insert('playerdepositpromo', $data);
		return $this->db->insert_id();
	}

	/**
	 * Will get getPlayerAdjustmentHistory
	 *
	 * @param 	$walletId int
	 * @return	$array
	 */
	public function getPlayerAdjustmentHistory($playerId) {
		$this->db->select('*')->from('balanceadjustmenthistory');

		$this->db->where('balanceadjustmenthistory.playerId', $playerId);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return FALSE;
	}

	/**
	 * getPlayerAdjustmentHistory
	 *
	 * @return  rendered template
	 */
	public function getPlayerAdjustmentHistoryWLimit($playerId, $limit, $offset) {
		$this->db->select('*')->from('balanceadjustmenthistory');

		$this->db->where('balanceadjustmenthistory.playerId', $playerId);
		$query = $this->db->get(null, $limit, $offset);

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return FALSE;
	}

	/**
	 * Will get getCashbackHistory
	 *
	 * @param 	$walletId int
	 * @return	$array
	 */
	public function getCashbackHistory($playerId) {
		$this->db->select('*')->from('playercashback');

		$this->db->where('playercashback.playerId', $playerId);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return FALSE;
	}

	/**
	 * Will get getCashbackHistory
	 *
	 * @param 	$walletId int
	 * @return	$array
	 */
	public function getCashbackHistoryWLimit($playerId, $limit, $offset) {
		$this->db->select('*')->from('playercashback');

		$this->db->where('playercashback.playerId', $playerId);
		$query = $this->db->get(null, $limit, $offset);

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return FALSE;
	}

	/**
	 * get userId if its using or child of roleId
	 *
	 * @param	int
	 * @return 	array
	 */
	public function getCurrentLanguage() {
		$this->db = $this->load->database('default', TRUE);

		$query = $this->db->query("SELECT currentLanguage FROM websitelanguagesetting");

		return $query->row_array();
	}

	/**
	 * set current language
	 *
	 * @return void
	 */
	public function setCurrentLanguage($data) {
		$this->db->where('websitelanguagesettingId', 1);
		$this->db->update('websitelanguagesetting', $data);
	}

	/**
	 * get player block game
	 *
	 * @param 	playerId int
	 * @return	array
	 */
	public function getPlayerBlockGame($playerId) {
		$this->db->select('gameId,blocked')
		     ->from('playergame');
		$this->db->where('playerId', $playerId);

		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * getPlayer by Username
	 *
	 * @return  rendered template
	 */
	public function getPlayerByUsername($username) {
		$query = $this->db->query("SELECT * FROM player where username = '" . $username . "'");

		return $query->row_array();
	}
}

/* End of file ip.php */
/* Location: ./application/models/ip.php */
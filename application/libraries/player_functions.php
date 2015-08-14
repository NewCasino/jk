<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * Fe_Functions
 *
 * Fe_Functions library for FHI OG System
 *
 * @package     Fe_Functions
 * @author      ASRII
 * @version     1.0.0
 */

class Player_Functions {
	function __construct() {
		$this->ci = &get_instance();
		$this->ci->load->database();
		$this->ci->load->library(array('session'));
		$this->ci->load->model(array('player'));
	}

	/**
	 * Adds user to the database
	 *
	 * @return  boolean
	 */
	function register($data) {
		$hasher = new PasswordHash('8', TRUE);
		$data['password'] = $hasher->HashPassword($data['password']);

		$result = $this->ci->player->insertUser($data);
		return $result;
	}

	public function randomizer($username) {
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
			. 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
			. '0123456789!@#$%^&*()'
			. $username); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$randomPassword = '';
		foreach (array_rand($seed, 9) as $k) {
			$randomPassword .= $seed[$k];
		}

		return $randomPassword;
	}

	public function generateReferralCode($player_id) {
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
			. 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
			. '0123456789'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$referral_code = '';
		foreach (array_rand($seed, 5) as $k) {
			$referral_code .= $seed[$k];
		}

		return $player_id . $referral_code . "OG";
	}

	public function getRandomVerificationCode() {
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
			. 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
			. '0123456789'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$verification_code = '';
		foreach (array_rand($seed, 32) as $k) {
			$verification_code .= $seed[$k];
		}

		return $verification_code;
	}

	public function getRandomTransactionCode() {
		$max = $this->ci->player->getMaxNumberOfWalletAccount();
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
			. '0123456789'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$transaction_code = '';
		foreach (array_rand($seed, 14) as $k) {
			$transaction_code .= $seed[$k];
		}

		return $transaction_code;
	}

	/**
	 * Will check if the username is already existing
	 *
	 * @param   string
	 * @return  array
	 */
	public function checkIfReferralCodeExist($referral_code) {
		$result = $this->ci->player->checkIfReferralCodeExist($referral_code);
		return $result;
	}

	/**
	 * Will create new player details using the parameter data
	 *
	 * @param   array
	 */
	public function createPlayerReferral($data) {
		$this->ci->player->createPlayerReferral($data);
	}

	/**
	 * Will create new player details using the parameter data
	 *
	 * @param   array
	 */
	public function createPlayerReferralDetails($data) {
		$this->ci->player->createPlayerReferralDetails($data);
	}

	/**
	 * Will check if the username is already existing
	 *
	 * @param   string
	 * @return  array
	 */
	public function checkUsernameExist($username) {
		$result = $this->ci->player->checkUsernameExist($username);
		return $result;
	}

	/**
	 * Will check if the email is already existing
	 *
	 * @param   string
	 * @return  array
	 */
	public function checkEmailExist($email) {
		$result = $this->ci->player->checkEmailExist($email);
		return $result;
	}

	/**
	 * Will create new player using the parameter data
	 *
	 * @param   array
	 */
	public function insertPlayer($data) {
		$hasher = new PasswordHash('8', TRUE);
		$data['password'] = $hasher->HashPassword($data['password']);
		//var_dump($data);exit();
		$this->ci->player->insertPlayer($data);
	}

	/**
	 * Will create new player using the parameter data
	 *
	 * @param   array
	 */
	public function editPlayer($data, $player_id) {
		$this->ci->player->editPlayer($data, $player_id);
	}

	/**
	 * compare changes
	 *
	 * @param   array
	 * @return  boolean
	 */
	public function compareChanges($data, $player_id) {
		$current_player_details = $this->ci->player->getPlayerDetails($player_id);
		$changes = array();

		foreach ($data as $key => $value) {
			if ($value[$key] != $current_player_details[$key]) {
				array_push($changes, $key);
			}
		}

		print_r($changes);
		exit();
	}

	/**
	 * Will create new player details using the parameter data
	 *
	 * @param   array
	 */
	public function insertPlayerDetails($data) {
		$this->ci->player->insertPlayerDetails($data);
	}

	/**
	 * Will create new player details using the parameter data
	 *
	 * @param   array
	 */
	public function editPlayerDetails($data, $player_id) {
		$this->ci->player->editPlayerDetails($data, $player_id);
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerAccount($player_id) {
		$result = $this->ci->player->getPlayerAccount($player_id);
		return $result;
	}

	/**
	 * Will get player main wallet at given playerId
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerMainWallet($player_id) {
		$result = $this->ci->player->getPlayerMainWallet($player_id);
		return $result;
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerAccountByPlayerId($player_id) {
		$result = $this->ci->player->getPlayerAccountByPlayerId($player_id);
		return $result;
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerAccountByPlayerIdOnly($player_id) {
		$result = $this->ci->player->getPlayerAccountByPlayerIdOnly($player_id);
		return $result;
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerAccountDetails($player_id) {
		$result = $this->ci->player->getPlayerAccountDetails($player_id);
		return $result;
	}

	/**
	 * Will get player account given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerAccountHistory($player_id) {
		$result = $this->ci->player->getPlayerAccountHistory($player_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerById($player_id) {
		$result = $this->ci->player->getPlayerById($player_id);
		return $result;
	}

	/**
	 * Will get player username
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerUsername($player_id) {
		$result = $this->ci->player->getPlayerUsername($player_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function createAccount($data) {
		$this->ci->player->createAccount($data);
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function createAccountDetails($data) {
		$this->ci->player->createAccountDetails($data);
	}

	/**
	 * Will deposit manual 3rd party deposit
	 *
	 * @param   int
	 * @return  array
	 */
	public function manual3rdPartyDeposit($walletAccountData, $manual3rdPartyDepositDetails) {
		$this->ci->player->manual3rdPartyDeposit($walletAccountData, $manual3rdPartyDepositDetails);
	}

	/**
	 * Will deposit local bank
	 *
	 * @param   int
	 * @return  array
	 */
	public function localBankDeposit($walletAccountData, $localBankDepositDetails) {
		$this->ci->player->localBankDeposit($walletAccountData, $localBankDepositDetails);
	}

	/**
	 * Will withdraw local bank
	 *
	 * @param   int
	 * @return  array
	 */
	public function localBankWithdrawal($walletAccountData, $localBankDepositDetails) {
		$this->ci->player->localBankWithdrawal($walletAccountData, $localBankDepositDetails);
	}

	/**
	 * Will deposit local bank deposit
	 *
	 * @param   playerId
	 * @return  array
	 */
	public function setPlayerBankaccountUndefault($playerBankDetailsId, $data) {
		$this->ci->player->setPlayerBankaccountUndefault($playerBankDetailsId, $data);
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function createAccountHistory($data) {
		$this->ci->player->createAccountHistory($data);
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function updatePlayerAccount($player_id, $player_account_id, $data) {
		$this->ci->player->updatePlayerAccount($player_id, $player_account_id, $data);
	}

	/**
	 * Will update 3rd party deposit request
	 *
	 * @param   int
	 * @return  array
	 */
	public function update3rdPartyDepositRequest($walletAccountId, $data) {
		$this->ci->player->update3rdPartyDepositRequest($walletAccountId, $data);
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerTotalBalance($player_id) {
		$result = $this->ci->player->getPlayerTotalBalance($player_id);
		return $result;
	}

	/**
	 * Will get player main wallet balance
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerMainWalletBalance($player_id) {
		$result = $this->ci->player->getPlayerMainWalletBalance($player_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getRankingLevelSettingByPlayerLevel($player_level) {
		$result = $this->ci->player->getRankingLevelSettingByPlayerLevel($player_level);
		return $result;
	}

	function get_age($birth_date) {
		return floor((time() - strtotime($birth_date)) / 31556926);
	}

	/**
	 * Get error message.
	 * Can be invoked after any failed operation such as login or register.
	 *
	 * @return  string
	 */
	public function checkPassword($password, $playerPassword) {
		$hasher = new PasswordHash('8', TRUE);
		return $hasher->CheckPassword($password, $playerPassword);
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getRequestWithdrawal($player_id) {
		$result = $this->ci->player->getRequestWithdrawal($player_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function changeDWStatus($data, $wallet_account_id) {
		$this->ci->player->changeDWStatus($data, $wallet_account_id);
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function updateCurrentMoney($data, $player_id) {
		$this->ci->player->updateCurrentMoney($data, $player_id);
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerFriendReferralId($player_id, $invited_player_id) {
		$result = $this->ci->player->getPlayerFriendReferralId($player_id, $invited_player_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getAllTransactionHistoryByPlayerId($player_id) {
		$result = $this->ci->player->getAllTransactionHistoryByPlayerId($player_id);
		return $result;
	}

	/**
	 * Will get all bank type
	 *
	 * @param   int
	 * @return  array
	 */
	public function getAllBankType() {
		$result = $this->ci->player->getAllBankType();
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getOtcById($otc_payment_method_id) {
		$result = $this->ci->player->getOtcById($otc_payment_method_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function insertOtcPaymentMethodDeatils($data) {
		$result = $this->ci->player->insertOtcPaymentMethodDeatils($data);
		return $result;
	}

	public function getTransactionId() {
		$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
			. '0123456789'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$transaction_id = '';
		foreach (array_rand($seed, 18) as $k) {
			$transaction_id .= $seed[$k];
		}

		return $transaction_id;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function insertPaypalPaymentMethodDeatils($data) {
		$result = $this->ci->player->insertPaypalPaymentMethodDeatils($data);
		// if($result){
		//     redirect(BASEURL . 'smartcashier/successurl_paypal','refresh');
		// }
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function insertStripePaymentMethodDeatils($data) {
		$result = $this->ci->player->insertStripePaymentMethodDeatils($data);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getWalletAccountByPlayerId($player_id) {
		$result = $this->ci->player->getWalletAccountByPlayerId($player_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function checkPromoCodeExist($promo_code) {
		$result = $this->ci->player->checkPromoCodeExist($promo_code);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function checkIfAlreadyGetPromo($player_id, $promo_id) {
		$result = $this->ci->player->checkIfAlreadyGetPromo($player_id, $promo_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function checkIfExpiredPromo($player_id, $promo_id) {
		$result = $this->ci->player->checkIfExpiredPromo($player_id, $promo_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function processPromo($promo_id, $amount, $player_id) {
		$promo_details = $this->ci->player->retrievePromo($promo_id);

		$checkIfAlreadyGetPromo = $this->checkIfAlreadyGetPromo($player_id);

		if ($checkIfAlreadyGetPromo) {
			$promo_details = $this->ci->player->retrievePromo($checkIfAlreadyGetPromo['promoId']);
		}

		$player = $this->ci->player->getPlayerById($player_id);
		$today = date("F j, Y g:i A");
		$data = array();
		$totalBetAmount = "";
		$expiration_date = "";
		$promo_amount = "";
		$status = "";
		$message = "";
		if ($amount >= $promo_details['rules'][0]['in']) {
			if ($this->checkInrange($promo_details['period']['start'], $promo_details['period']['end'], $today)) {
				//if($checkIfAlreadyGetPromo['nthDepositCount'] < $promo_details['nthDeposit'] && $checkIfAlreadyGetPromo['status'] != 0) {
				// if($promo_details['rules'][0]['isOutPercent'] == "1") {
				//     $promo_amount = ($promo_details['rules'][0]['out'] / 100) * $amount;
				// } elseif($promo_details['rules'][0]['isOutPercent'] == "0") {
				//     $promo_amount = $promo_details['rules'][0]['out'];
				// }

				// if($promo_amount > $promo_details['bonus']['max']) {
				//     $promo_amount = $promo_details['bonus']['max'];
				// }

				// $totalBetAmount = ($promo_amount + $amount) * $promo_details['bonus']['modifier'];

				// if($promo_details['period']['code'] == 0) {
				//     $expiration_date = date("Y-m-d H:i:s", strtotime('+1 day'));
				// } elseif($promo_details['period']['code'] == 1) {
				//     $expiration_date = date("Y-m-d H:i:s", strtotime('+1 week'));
				// } elseif($promo_details['period']['code'] == 2) {
				//     $expiration_date = date("Y-m-d H:i:s", strtotime('+1 month'));
				// } elseif($promo_details['period']['code'] == 3) {
				//     $expiration_date = date("Y-m-d H:i:s", strtotime('+1 year'));
				// }

				// $message = "You have a bonus of <b>" . $promo_amount . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
				// $status = 'update';

				// $data = array(
				//         'promoId' => $checkIfAlreadyGetPromo['promoId'],
				//         'nthDepositCount' => $checkIfAlreadyGetPromo['nthDepositCount'] + 1,
				//         'totalBetAmount' => $totalBetAmount,
				//         'bonusAmount' => $promo_amount,
				//         'message' => $message,
				//         'status' => $status
				//     );

				//} elseif(!$checkIfAlreadyGetPromo) {
				if ($promo_details['rules'][0]['isOutPercent'] == "1") {
					$promo_amount = ($promo_details['rules'][0]['out'] / 100) * $amount;
				} elseif ($promo_details['rules'][0]['isOutPercent'] == "0") {
					$promo_amount = $promo_details['rules'][0]['out'];
				}

				if ($promo_amount > $promo_details['bonus']['max']) {
					$promo_amount = $promo_details['bonus']['max'];
				}

				$totalBetAmount = ($promo_amount + $amount) * $promo_details['bonus']['modifier'];

				if ($promo_details['period']['code'] == 0) {
					$expiration_date = date("Y-m-d H:i:s", strtotime('+1 day'));
				} elseif ($promo_details['period']['code'] == 1) {
					$expiration_date = date("Y-m-d H:i:s", strtotime('+1 week'));
				} elseif ($promo_details['period']['code'] == 2) {
					$expiration_date = date("Y-m-d H:i:s", strtotime('+1 month'));
				} elseif ($promo_details['period']['code'] == 3) {
					$expiration_date = date("Y-m-d H:i:s", strtotime('+1 year'));
				}

				$message = "You have a bonus of <b>" . $promo_amount . " " . $player['currency'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
				$status = 'success';

				$data = array(
					'playerId' => $player_id,
					'promoId' => $promo_details['id'],
					'expiration' => $expiration_date,
					'transactionType' => $promo_details['type']['name'],
					'currency' => $promo_details['currency']['code'],
					'totalBetAmount' => $totalBetAmount,
					'bonusAmount' => $promo_amount,
					'message' => $message,
					'status' => $status,
				);

				// } else {
				//    $message = "You still have pending request or your have reached the maximun number of deposit.";
				//    $status = 'fail';

				//    $data = array(
				//          'message' => $message,
				//           'status' => $status
				//       );
				//}
			} else {
				$message = "Promo is already ended.";
				$status = 'fail';

				$data = array(
					'message' => $message,
					'status' => $status,
				);
			}
		} else {
			$message = "You did not meet the minimum reqiurement amount to be deposit.";
			$status = 'fail';

			$data = array(
				'message' => $message,
				'status' => $status,
			);
		}
		return $data;
	}

	function checkInrange($dt_start, $dt_end, $dt_check) {
		if (strtotime($dt_check) > strtotime($dt_start) && strtotime($dt_check) < strtotime($dt_end)) {
			return "true";
		}

		return "false";
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function createPlayerPromo($data) {
		$result = $this->ci->player->createPlayerPromo($data);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function updatePlayerPromo($data, $player_id, $promo_id) {
		$result = $this->ci->player->updatePlayerPromo($data, $player_id, $promo_id);
		return $result;
	}

	/**
	 * Will update thirdparty deposit
	 *
	 * @param   int
	 * @return  array
	 */
	public function updateThirdpartyDeposit($data, $depositWalletAccountId) {
		$result = $this->ci->player->updateThirdpartyDeposit($data, $depositWalletAccountId);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function retrievePromo($promo_id) {
		$result = $this->ci->player->retrievePromo($promo_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPromoCode($promo_id) {
		$result = $this->ci->player->getPromoCode($promo_id);
		return $result;
	}

	/**
	 * Will get player given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerTotalBonus($player_id) {
		$result = $this->ci->player->getPlayerTotalBonus($player_id);
		return $result;
	}

	////////////////////////////______________________________________________________________\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	function promoRange($promo_start_date, $promo_end_date, $today) {
		if (strtotime($today) > strtotime($promo_start_date) && strtotime($today) < strtotime($promo_end_date)) {
			return true;
		}

		return false;
	}

	function promoConditionRange($condition_start_date, $condition_end_date, $today) {
		if (strtotime($today) > strtotime($condition_start_date) && strtotime($today) < strtotime($condition_end_date)) {
			return true;
		}

		return false;
	}

	function promoLevelMinMaxRange($min, $max, $amount) {
		if ($amount > $min && $amount < $max) {
			return true;
		}

		return false;
	}

	function promoExpirationdate($promo_period) {
		$expiration_date = "";

		switch ($promo_period) {

			case '0':$expiration_date = date("Y-m-d H:i:s", strtotime('+1 day'));
				break;
			case '1':$expiration_date = date("Y-m-d H:i:s", strtotime('+1 week'));
				break;
			case '2':$expiration_date = date("Y-m-d H:i:s", strtotime('+1 month'));
				break;
			case '3':$expiration_date = date("Y-m-d H:i:s", strtotime('+1 year'));
				break;

			default:$message = "Invalid promo period!";
				break;

		}
		return $expiration_date;
	}

	function checkIfFirstDeposit($player_id) {
		return $this->ci->player->checkIfFirstDeposit($player_id);
	}

	//main
	function playerPromo($player_id, $promo_id, $amount) {
		$today = date("Y-m-d H:i:s");
		$data = array();

		$message = "";
		$bonus = "";
		$expiration_date = "";
		$needed = "";
		$status = "";
		$isInRule = false;
		$pass_fail = "fail";
		$sorted_rules = array();

		$promo_details = $this->ci->player->retrievePromo($promo_id);
		// echo "<pre>";
		// print_r($promo_details);
		// echo "</pre>";

		$player_account = $this->ci->player->getPlayerAccountByPlayerId($player_id);
		$count_nth = count($this->ci->player->getPlayerPromoNth($player_id, $promo_id));
		$checkIfExpiredPromo = $this->checkIfExpiredPromo($player_id, $promo_id);
		$checkIfAlreadyGetPromo = $this->checkIfAlreadyGetPromo($player_id, $promo_id);

		if ($this->promoRange($promo_details['period']['start'], $promo_details['period']['end'], $today)) {
			$sorted_rules = $promo_details['rules'];

			usort($sorted_rules, function ($sorted_rules, $sorted_rules) {
				if ($sorted_rules == $sorted_rules) {
					return 0;
				}

				return $sorted_rules < $sorted_rules ? 1 : -1;
			});

			if (!empty($checkIfAlreadyGetPromo) && $checkIfAlreadyGetPromo['status'] == 0) {
				$message = "You have pending request.";
			} elseif (!empty($checkIfAlreadyGetPromo) && $checkIfAlreadyGetPromo['status'] > 0 && $checkIfAlreadyGetPromo['status'] != 6) {
				if ($promo_details['type']['code'] == 0) {
					if ($promo_details['condition']['code'] == 0) {
						//if Nth
						//check promo rule

						foreach ($sorted_rules as $row) {
							if ($amount >= $row['in']) {
								$bonus = ($row['isOutPercent'] == 1) ? ($bonus = ($row['out'] / 100) * $amount) : ($bonus = $row['out']);
								$isInRule = true;
								break;
							} else {
								$isInRule = false;
							}
						}

						if ($isInRule == true) {
							if ($bonus > $promo_details['bonus']['maximum']) {
								$bonus = $promo_details['bonus']['maximum'];
							} elseif ($bonus < $promo_details['bonus']['minimum']) {
								$bonus = $promo_details['bonus']['minimum'];
							}

							if ($promo_details['bonus']['release']['code'] == 0) {
								$needed = ($amount + $bonus) * $promo_details['bonus']['release']['value'];
							} elseif ($promo_details['bonus']['release']['code'] == 0) {
								$needed = $promo_details['bonus']['release']['value'];
							}

							if ($promo_details['condition']['value'] > $count_nth) {
								$data = array(
									'playerId' => $player_id,
									'promoId' => $promo_id,
									'conditionType' => $promo_details['condition']['name'],
									'nthDepositCount' => $count_nth + 1,
									'transactionType' => $promo_details['requirements']['name'],
									'totalBetAmount' => $needed,
									'bonusAmount' => $bonus,
									'currency' => $player_account['currency'],
									'status' => 0,
								);

								$this->ci->player->createPlayerPromo($data);
								echo $message = "You have a bonus of <b>" . $bonus . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
								$pass_fail = "success";
							} elseif ($checkIfAlreadyGetPromo['status'] < 3) {
								echo $message = "Your promo has expired.";
								$pass_fail = "fail";
								$status = array('status' => 3);
								$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
							} else {
								echo $message = "Promo expired.";
								$pass_fail = "fail";
							}
						} else {
							echo $message = "You did not meet the minimum requirement for this promo.";
							$pass_fail = "fail";
						}

					} elseif ($promo_details['condition']['code'] == 1) {
						//if Total
						if ($this->promoConditionRange($promo_details['condition']['start'], $promo_details['condition']['end'], $today)) {
							if ($promo_details['requirements']['code'] == 0) {
								//summation of deposit
								$summation = $this->ci->player->getTotalDepositFrom(date("Y-m-d H:i:s", strtotime($promo_details['condition']['start'])), $today, $player_account['playerAccountId']);
								$amount = $summation['deposit'] + $amount;
							} elseif ($promo_details['requirements']['code'] == 1) {
								//summation of bet
							}
							print_r($summation);
							foreach ($sorted_rules as $row) {
								if ($amount >= $row['in']) {
									$bonus = ($row['isOutPercent'] == 1) ? ($bonus = ($row['out'] / 100) * $amount) : ($bonus = $row['out']);
									$isInRule = true;
									break;
								} else {
									$isInRule = false;
								}
							}

							if ($isInRule == true) {
								if ($bonus > $promo_details['bonus']['maximum']) {
									$bonus = $promo_details['bonus']['maximum'];
								} elseif ($bonus < $promo_details['bonus']['minimum']) {
									$bonus = $promo_details['bonus']['minimum'];
								}

								if ($promo_details['bonus']['release']['code'] == 0) {
									$needed = ($amount + $bonus) * $promo_details['bonus']['release']['value'];
								} elseif ($promo_details['bonus']['release']['code'] == 0) {
									$needed = $promo_details['bonus']['release']['value'];
								}

								$data = array(
									'playerId' => $player_id,
									'promoId' => $promo_id,
									'conditionType' => $promo_details['condition']['name'],
									'nthDepositCount' => NULL,
									'transactionType' => $promo_details['requirements']['name'],
									'totalBetAmount' => $needed,
									'bonusAmount' => $bonus,
									'currency' => $player_account['currency'],
									'status' => 0,
								);

								$this->ci->player->createPlayerPromo($data);
								$message = "You have a bonus of <b>" . $bonus . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
								$pass_fail = "success";
							} elseif ($checkIfAlreadyGetPromo['status'] < 3) {
								$message = "Your promo has expired.";
								$pass_fail = "fail";
								$status = array('status' => 3);
								$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
							} else {
								$message = "Promo expired.";
								$pass_fail = "fail";
							}
						} else {
							echo $message = "You did not meet the minimum requirement for this promo.";
							$pass_fail = "fail";
						}
					}

				} elseif ($promo_details['type']['code'] == 1) {
					if ($this->promoConditionRange($promo_details['condition']['start'], $promo_details['condition']['end'], $today)) {
						switch ($promo_details['period']['code']) {

							case '0':$expiration_date = date("Y-m-d H:i:s", strtotime($checkIfAlreadyGetPromo['dateActivate'] . '+1 day'));
								break;
							case '1':$expiration_date = date("Y-m-d H:i:s", strtotime($checkIfAlreadyGetPromo['dateActivate'] . '+1 week'));
								break;
							case '2':$expiration_date = date("Y-m-d H:i:s", strtotime($checkIfAlreadyGetPromo['dateActivate'] . '+1 month'));
								break;
							case '3':$expiration_date = date("Y-m-d H:i:s", strtotime($checkIfAlreadyGetPromo['dateActivate'] . '+1 year'));
								break;

							default:$message = "Invalid promo period!";
								break;

						}

						if ($this->promoConditionRange($checkIfAlreadyGetPromo['dateActivate'], $expiration_date, $today)) {

							if ($promo_details['condition']['code'] == 0) {
								//if Nth
								//check promo rule
								foreach ($sorted_rules as $row) {
									if ($amount >= $row['in']) {
										$bonus = ($row['isOutPercent'] == 1) ? ($bonus = ($row['out'] / 100) * $amount) : ($bonus = $row['out']);
										$isInRule = true;
										break;
									} else {
										$isInRule = false;
									}
								}

								if ($isInRule == true) {
									if ($bonus > $promo_details['bonus']['maximum']) {
										$bonus = $promo_details['bonus']['maximum'];
									} elseif ($bonus < $promo_details['bonus']['minimum']) {
										$bonus = $promo_details['bonus']['minimum'];
									}

									if ($promo_details['bonus']['release']['code'] == 0) {
										$needed = ($amount + $bonus) * $promo_details['bonus']['release']['value'];
									} elseif ($promo_details['bonus']['release']['code'] == 0) {
										$needed = $promo_details['bonus']['release']['value'];
									}

									if ($promo_details['condition']['value'] > $count_nth) {
										$data = array(
											'playerId' => $player_id,
											'promoId' => $promo_id,
											'conditionType' => $promo_details['condition']['name'],
											'nthDepositCount' => $count_nth + 1,
											'transactionType' => $promo_details['requirements']['name'],
											'totalBetAmount' => $needed,
											'bonusAmount' => $bonus,
											'currency' => $player_account['currency'],
											'status' => 0,
										);

										$this->ci->player->createPlayerPromo($data);
										$message = "You have a bonus of <b>" . $bonus . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
										$pass_fail = "success";
									} elseif ($checkIfAlreadyGetPromo['status'] < 3 || $checkIfAlreadyGetPromo['dateExpire']) {
										$message = "Your promo has expired.";
										$pass_fail = "fail";
										$status = array('status' => 3);
										$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
									} else {
										$message = "Promo expired.";
										$pass_fail = "fail";
									}
								} else {
									echo $message = "You did not meet the minimum requirement for this promo.";
									$pass_fail = "fail";
								}

							} elseif ($promo_details['condition']['code'] == 1) {
								//if Total
								if ($this->promoConditionRange($promo_details['condition']['start'], $promo_details['condition']['end'], $today)) {
									if ($promo_details['requirements']['code'] == 0) {
										//summation of deposit
										$summation = $this->ci->player->getTotalDepositFrom(date("Y-m-d H:i:s", strtotime($promo_details['condition']['start'])), $today, $player_account['playerAccountId']);
										$amount = $summation['deposit'] + $amount;
									} elseif ($promo_details['requirements']['code'] == 1) {
										//summation of bet
									}
									print_r($summation);
									foreach ($sorted_rules as $row) {
										if ($amount >= $row['in']) {
											$bonus = ($row['isOutPercent'] == 1) ? ($bonus = ($row['out'] / 100) * $amount) : ($bonus = $row['out']);
											$isInRule = true;
											break;
										} else {
											$isInRule = false;
										}
									}

									if ($isInRule == true) {
										if ($bonus > $promo_details['bonus']['maximum']) {
											$bonus = $promo_details['bonus']['maximum'];
										} elseif ($bonus < $promo_details['bonus']['minimum']) {
											$bonus = $promo_details['bonus']['minimum'];
										}

										if ($promo_details['bonus']['release']['code'] == 0) {
											$needed = ($amount + $bonus) * $promo_details['bonus']['release']['value'];
										} elseif ($promo_details['bonus']['release']['code'] == 0) {
											$needed = $promo_details['bonus']['release']['value'];
										}

										$data = array(
											'playerId' => $player_id,
											'promoId' => $promo_id,
											'conditionType' => $promo_details['condition']['name'],
											'nthDepositCount' => NULL,
											'transactionType' => $promo_details['requirements']['name'],
											'totalBetAmount' => $needed,
											'bonusAmount' => $bonus,
											'currency' => $player_account['currency'],
											'status' => 0,
										);

										$this->ci->player->createPlayerPromo($data);
										$message = "You have a bonus of <b>" . $bonus . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
										$pass_fail = "success";
									} elseif ($checkIfAlreadyGetPromo['status'] < 3 || $checkIfAlreadyGetPromo['dateExpire']) {
										$message = "Your promo has expired.";
										$pass_fail = "fail";
										$status = array('status' => 3);
										$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
									} else {
										$message = "Promo expired.";
										$pass_fail = "fail";
									}
								} else {
									echo $message = "You did not meet the minimum requirement for this promo.";
									$pass_fail = "fail";
								}
							}

						} else {
							$message = "Bonus expired.";
							$pass_fail = "fail";
							$status = array('status' => 3);
							$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
						}

					} else {
						$message = "Bonus expired.";
						$pass_fail = "fail";
						$status = array('status' => 3);
						$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
					}
				}

			} else {
				if ($promo_details['type']['code'] == 0) {
					if ($promo_details['condition']['code'] == 0) {
						//if Nth
						//check promo rule
						foreach ($sorted_rules as $row) {
							if ($amount >= $row['in']) {
								$bonus = ($row['isOutPercent'] == 1) ? ($bonus = ($row['out'] / 100) * $amount) : ($bonus = $row['out']);
								$isInRule = true;
								break;
							} else {
								$isInRule = false;
							}
						}

						if ($isInRule == true) {
							if ($bonus > $promo_details['bonus']['maximum']) {
								$bonus = $promo_details['bonus']['maximum'];
							} elseif ($bonus < $promo_details['bonus']['minimum']) {
								$bonus = $promo_details['bonus']['minimum'];
							}

							if ($promo_details['bonus']['release']['code'] == 0) {
								$needed = ($amount + $bonus) * $promo_details['bonus']['release']['value'];
							} elseif ($promo_details['bonus']['release']['code'] == 0) {
								$needed = $promo_details['bonus']['release']['value'];
							}

							$data = array(
								'playerId' => $player_id,
								'promoId' => $promo_id,
								'conditionType' => $promo_details['condition']['name'],
								'nthDepositCount' => 1,
								'transactionType' => $promo_details['requirements']['name'],
								'totalBetAmount' => $needed,
								'bonusAmount' => $bonus,
								'currency' => $player_account['currency'],
								'status' => 0,
							);

							$this->ci->player->createPlayerPromo($data);
							$message = "You have a bonus of <b>" . $bonus . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
							$pass_fail = "success";

							if ($promo_details['condition']['value'] == $count_nth) {
								$message = "Promo expired.";
								$pass_fail = "fail";
								$status = array('status' => 3);
								$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
							}
						} else {
							echo $message = "You did not meet the minimum requirement for this promo.";
							$pass_fail = "fail";
						}

					} elseif ($promo_details['condition']['code'] == 1) {
						//if Total

						if ($this->promoConditionRange($promo_details['condition']['start'], $promo_details['condition']['end'], $today)) {
							if ($promo_details['requirements']['code'] == 0) {
								//summation of deposit
								$summation = $this->ci->player->getTotalDepositFrom($promo_details['condition']['start'], $today, $player_account['playerAccountId']);
								$amount = $summation['deposit'] + $amount;
							} elseif ($promo_details['requirements']['code'] == 1) {
								//summation of bet
							}

							foreach ($sorted_rules as $row) {
								if ($amount >= $row['in']) {
									$bonus = ($row['isOutPercent'] == 1) ? ($bonus = ($row['out'] / 100) * $amount) : ($bonus = $row['out']);
									$isInRule = true;
									break;
								} else {
									$isInRule = false;
								}
							}

							if ($isInRule == true) {
								if ($bonus > $promo_details['bonus']['maximum']) {
									$bonus = $promo_details['bonus']['maximum'];
								} elseif ($bonus < $promo_details['bonus']['minimum']) {
									$bonus = $promo_details['bonus']['minimum'];
								}

								if ($promo_details['bonus']['release']['code'] == 0) {
									$needed = ($amount + $bonus) * $promo_details['bonus']['release']['value'];
								} elseif ($promo_details['bonus']['release']['code'] == 0) {
									$needed = $promo_details['bonus']['release']['value'];
								}

								$data = array(
									'playerId' => $player_id,
									'promoId' => $promo_id,
									'conditionType' => $promo_details['condition']['name'],
									'nthDepositCount' => NULL,
									'transactionType' => $promo_details['requirements']['name'],
									'totalBetAmount' => $needed,
									'bonusAmount' => $bonus,
									'currency' => $player_account['currency'],
									'status' => 0,
								);

								$this->ci->player->createPlayerPromo($data);
								$message = "You have a bonus of <b>" . $bonus . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
								$pass_fail = "success";
							} else {
								$message = "You did not meet the minimum requirement for this promo.";
								$pass_fail = "fail";
							}
						} else {
							$message = "Promo expired.";
							$pass_fail = "fail";
							$status = array('status' => 3);
							$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
						}
					}

				} elseif ($promo_details['type']['code'] == 1) {
					if ($this->promoConditionRange($promo_details['condition']['start'], $promo_details['condition']['end'], $today)) {
						switch ($promo_details['period']['code']) {

							case '0':$expiration_date = date("Y-m-d H:i:s", strtotime($checkIfAlreadyGetPromo['dateActivate'] . '+1 day'));
								break;
							case '1':$expiration_date = date("Y-m-d H:i:s", strtotime($checkIfAlreadyGetPromo['dateActivate'] . '+1 week'));
								break;
							case '2':$expiration_date = date("Y-m-d H:i:s", strtotime($checkIfAlreadyGetPromo['dateActivate'] . '+1 month'));
								break;
							case '3':$expiration_date = date("Y-m-d H:i:s", strtotime($checkIfAlreadyGetPromo['dateActivate'] . '+1 year'));
								break;

							default:$message = "Invalid promo period!";
								break;

						}

						if ($promo_details['condition']['code'] == 0) {
							//if Nth
							//check promo rule
							foreach ($sorted_rules as $row) {
								if ($amount >= $row['in']) {
									$bonus = ($row['isOutPercent'] == 1) ? ($bonus = ($row['out'] / 100) * $amount) : ($bonus = $row['out']);
									$isInRule = true;
									break;
								} else {
									$isInRule = false;
								}
							}

							if ($isInRule == true) {
								if ($bonus > $promo_details['bonus']['maximum']) {
									$bonus = $promo_details['bonus']['maximum'];
								} elseif ($bonus < $promo_details['bonus']['minimum']) {
									$bonus = $promo_details['bonus']['minimum'];
								}

								if ($promo_details['bonus']['release']['code'] == 0) {
									$needed = ($amount + $bonus) * $promo_details['bonus']['release']['value'];
								} elseif ($promo_details['bonus']['release']['code'] == 0) {
									$needed = $promo_details['bonus']['release']['value'];
								}

								$data = array(
									'playerId' => $player_id,
									'promoId' => $promo_id,
									'conditionType' => $promo_details['condition']['name'],
									'nthDepositCount' => 1,
									'transactionType' => $promo_details['requirements']['name'],
									'totalBetAmount' => $needed,
									'bonusAmount' => $bonus,
									'currency' => $player_account['currency'],
									'status' => 0,
								);

								$this->ci->player->createPlayerPromo($data);
								$message = "You have a bonus of <b>" . $bonus . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
								$pass_fail = "success";
								if ($promo_details['condition']['value'] == $count_nth) {
									$message = "Promo expired.";
									$pass_fail = "fail";
									$status = array('status' => 3);
									$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
								}
							} else {
								echo $message = "You did not meet the minimum requirement for this promo.";
								$pass_fail = "fail";
							}

						} elseif ($promo_details['condition']['code'] == 1) {
							//if Total
							if ($this->promoConditionRange($promo_details['condition']['start'], $promo_details['condition']['end'], $today)) {
								if ($promo_details['requirements']['code'] == 0) {
									//summation of deposit
									$summation = $this->ci->player->getTotalDepositFrom(date("Y-m-d H:i:s", strtotime($promo_details['condition']['start'])), $today, $player_account['playerAccountId']);
									$amount = $summation['deposit'] + $amount;
								} elseif ($promo_details['requirements']['code'] == 1) {
									//summation of bet
								}
								print_r($summation);
								foreach ($sorted_rules as $row) {
									if ($amount >= $row['in']) {
										$bonus = ($row['isOutPercent'] == 1) ? ($bonus = ($row['out'] / 100) * $amount) : ($bonus = $row['out']);
										$isInRule = true;
										break;
									} else {
										$isInRule = false;
									}
								}

								if ($isInRule == true) {
									if ($bonus > $promo_details['bonus']['maximum']) {
										$bonus = $promo_details['bonus']['maximum'];
									} elseif ($bonus < $promo_details['bonus']['minimum']) {
										$bonus = $promo_details['bonus']['minimum'];
									}

									if ($promo_details['bonus']['release']['code'] == 0) {
										$needed = ($amount + $bonus) * $promo_details['bonus']['release']['value'];
									} elseif ($promo_details['bonus']['release']['code'] == 0) {
										$needed = $promo_details['bonus']['release']['value'];
									}

									$data = array(
										'playerId' => $player_id,
										'promoId' => $promo_id,
										'conditionType' => $promo_details['condition']['name'],
										'nthDepositCount' => NULL,
										'transactionType' => $promo_details['requirements']['name'],
										'totalBetAmount' => $needed,
										'bonusAmount' => $bonus,
										'currency' => $player_account['currency'],
										'status' => 0,
									);

									$this->ci->player->createPlayerPromo($data);
									$message = "You have a bonus of <b>" . $bonus . " " . $promo_details['currency']['code'] . "</b> by depositing <b>" . $amount . " " . $player['currency'] . "</b>.";
									$pass_fail = "success";
								} else {
									$message = "You did not meet the minimum requirement for this promo.";
									$pass_fail = "fail";
								}
							} else {
								$message = "Promo expired.";
								$pass_fail = "fail";
								$status = array('status' => 3);
								$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
							}
						}

					} else {
						$message = "Bonus expired.";
						$pass_fail = "fail";
						$status = array('status' => 3);
						$this->ci->player->updatePlayerPromo($status, $player_id, $promo_id);
					}
				}
			}
		} else {
			$message = "Promo expired.";
			$pass_fail = "fail";
		}

		$data = array(
			'pass_fail' => $pass_fail,
			'message' => $message,
			'player_promo_id' => $this->ci->player->checkIfAlreadyGetPromo($player_id, $promo_id)['playerPromoId'],
		);
		// echo "<pre>";
		// print_r($data);
		// print_r($promo_details);
		// echo "</pre>";
		// exit();
		return $data;
	}

	/**
	 * Will add player withdrawal details
	 *
	 * @return  array
	 */
	public function addWithdrawalDetails($data) {
		$this->ci->player->addWithdrawalDetails($data);
	}

	/**
	 * get email in email table
	 *
	 * @return  array
	 */
	public function getEmail() {
		return $this->ci->player->getEmail();
	}

	/**
	 * get email in email table
	 *
	 * @return  array
	 */
	public function getTotalAmountWithdraw($player_id) {
		return $this->ci->player->getTotalAmountWithdraw($player_id);
	}

	/**
	 * get email in email table
	 *
	 * @return  array
	 */
	public function getDailyWithdrawal($player_id, $day) {
		return $this->ci->player->getDailyWithdrawal($player_id, $day);
	}

	/**
	 * Will get player pt password given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerPasswordPT($player_id) {
		$result = $this->ci->gameapi->getPlayerPasswordPT($player_id);
		return $result;
	}

	/**
	 * Will get player ag password given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerPasswordAG($player_id) {
		$result = $this->ci->gameapi->getPlayerPasswordAG($player_id);
		return $result;
	}

	/**
	 * get list of games
	 *
	 * @return  array
	 */
	public function getGames() {
		return $this->ci->player->getGames();
	}

	/**
	 * get player account id of sub wallet
	 *
	 * @param  int
	 * @param  int
	 * @return  array
	 */
	public function getPlayerAccountBySubWallet($player_id, $game_id) {
		return $this->ci->player->getPlayerAccountBySubWallet($player_id, $game_id);
	}

	/**
	 * add to sub wallet details
	 *
	 * @param  array
	 */
	public function addToSubWalletDetails($data) {
		return $this->ci->player->addToSubWalletDetails($data);
	}

	/**
	 * get all player account by playerId
	 *
	 * @param  int
	 * @return  array
	 */
	public function getAllPlayerAccountByPlayerId($player_id) {
		return $this->ci->player->getAllPlayerAccountByPlayerId($player_id);
	}

	/**
	 * get all transfer history by playerId
	 *
	 * @param  int
	 * @return  array
	 */
	public function getAllTransferHistoryByPlayerId($player_id) {
		return $this->ci->player->getAllTransferHistoryByPlayerId($player_id);
	}

	/**
	 * get all transfer history by playerId
	 *
	 * @param  int
	 * @return  array
	 */
	public function getAllTransferHistoryByPlayerIdWLimit($player_id, $limit, $offset) {
		return $this->ci->player->getAllTransferHistoryByPlayerIdWLimit($player_id, $limit, $offset);
	}

	/**
	 * get all transfer history by playerId
	 *
	 * @param  int
	 * @return  array
	 */
	public function getActiveCurrency() {
		return $this->ci->player->getActiveCurrency();
	}

	/**
	 * Will get player pt password given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getFriendReferralSettings() {
		$result = $this->ci->player->getFriendReferralSettings();
		return $result;
	}

	/**
	 * Will get player pt password given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function isReferredBy($player_id) {
		$result = $this->ci->player->isReferredBy($player_id);
		return $result;
	}

	/**
	 * Will get player pt password given the Id
	 *
	 * @param   int
	 * @return  array
	 */
	public function getPlayerTotalDeposits($player_account_id) {
		$result = $this->ci->player->getPlayerTotalDeposits($player_account_id);
		return $result;
	}

	/**
	 * update sub wallet
	 *
	 * @param   int
	 * @return  void
	 */
	public function updateSubWallet($player_id, $player_name) {
		//pt
		$result = $this->ci->game_pt_api->getPlayerInfo($player_name);
		if (empty($result['result'])) {
			return;
		}
		$data = array(
			'totalBalanceAmount' => $result['result']['BALANCE'],
		);

		$this->ci->player->updateSubWallet($data, $player_id);

		//ag account
		$pw = $this->getPlayerPasswordAG($player_id);
		if (isset($pw->password)) {
			$playerGamePasswordAG = $this->ci->des->decrypt($pw->password);
			$balance = $this->ci->game_ag_api->getAGPlayerBalance($player_name, $playerGamePasswordAG, 1, 'gb', 'CNY');
		}

		//$result = $this->ci->game_ag_api->getAGPlayerBalance($player_name);

		if (!isset($balance)) {
			return;
		}
		//var_dump($balance);exit();
		$data = array(
			'totalBalanceAmount' => $balance,
		);

		$this->ci->player->updateSubWalletAG($data, $player_id);
	}

	/**
	 * Will set player new balance amount by playerAccountId
	 *
	 * @param $dataRequest - array
	 * @return Bool - TRUE or FALSE
	 */

	public function setPlayerNewBalAmountByPlayerAccountId($playerAccountId, $data) {
		return $this->ci->player->setPlayerNewBalAmountByPlayerAccountId($playerAccountId, $data);
	}

	/**
	 * get balace by playerAccountId
	 *
	 * @return  array
	 */
	public function getBalanceByPlayerAccountId($player_account_id) {
		return $this->ci->player->getBalanceByPlayerAccountId($player_account_id);
	}

	/**
	 * Will randomize alphanumeric and special characters
	 *
	 * @param   string
	 * @return  string
	 */
	public function generateRandomCode() {
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
			. 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
			. '0123456789'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$generatePromoCode = '';
		foreach (array_rand($seed, 7) as $k) {
			$generatePromoCode .= $seed[$k];
		}

		return $generatePromoCode;
	}

	public function getPaypalSettingsActive() {
		return $this->ci->player->getPaypalSettingsActive();
	}

	public function checkIfTransactionDetailsExitst($transaction_referrence) {
		return $this->ci->player->checkIfTransactionDetailsExitst($transaction_referrence);
	}

	public function createPlayerGame($data) {
		return $this->ci->player->createPlayerGame($data);
	}

	/**
	 * Will get all news
	 *
	 * @return  array
	 */
	public function getAllNews() {
		return $this->ci->player->getAllNews();
	}

	public function getBankById($otc_payment_method_id) {
		return $this->ci->player->getBankById($otc_payment_method_id);
	}

	/**
	 * get email in email table
	 *
	 * @return  array
	 */
	public function getDailyDeposit($player_id, $day, $otc_payment_method_id) {
		return $this->ci->player->getDailyDeposit($player_id, $day, $otc_payment_method_id);
	}

	/**
	 * get email in email table
	 *
	 * @return  array
	 */
	public function getDailyDepositToPaymentMethod($player_id, $day, $otc_payment_method_id) {
		return $this->ci->player->getDailyDepositToPaymentMethod($player_id, $day, $otc_payment_method_id);
	}

	/**
	 * Will get player level of user
	 *
	 * @return  array
	 */
	public function getPlayerLevelGame($player_id) {
		return $this->ci->player->getPlayerLevelGame($player_id);
	}

	public function getActivePromo($player_id) {
		return $this->ci->player->getActivePromo($player_id);
	}

	public function getPromoById($player_id) {
		return $this->ci->player->getPromoById($player_id);
	}

	public function getPlayerPromo($player_id) {
		return $this->ci->player->getPlayerPromo($player_id);
	}

	public function getGameById($game_id) {
		return $this->ci->player->getGameById($game_id);
	}

	/**
	 * Resets Password of a user
	 *
	 * @return  boolean
	 */
	function resetPassword($player_id, $data) {
		$hasher = new PasswordHash('8', TRUE);
		$data['password'] = $hasher->HashPassword($data['password']);
		$this->ci->player->resetPassword($player_id, $data);
	}

	/**
	 * Checks if user is already existing
	 *
	 * @return  boolean
	 */
	function isValidPassword($player_id, $opassword) {
		$hasher = new PasswordHash('8', TRUE);
		$player = $this->getPlayerById($player_id);
		$password = $player['password'];

		if ($hasher->CheckPassword($opassword, $password)) {
			return true;
		} else {
			return false;
		}
	}

	public function getBankDetails($player_id) {
		return $this->ci->player->getBankDetails($player_id);
	}

	public function getDepositBankDetails($player_id) {
		return $this->ci->player->getDepositBankDetails($player_id);
	}

	public function getWithdrawalBankDetails($player_id) {
		return $this->ci->player->getWithdrawalBankDetails($player_id);
	}

	public function updateBankDetails($bank_details_id, $data) {
		return $this->ci->player->updateBankDetails($bank_details_id, $data);
	}

	public function getBankDetailsById($bank_details_id) {
		return $this->ci->player->getBankDetailsById($bank_details_id);
	}

	public function deleteBankDetails($bank_details_id) {
		return $this->ci->player->deleteBankDetails($bank_details_id);
	}

	public function addBankDetails($data) {
		return $this->ci->player->addBankDetails($data);
	}

	public function addBankDetailsByDeposit($data) {
		return $this->ci->player->addBankDetailsByDeposit($data);
	}

	public function addBankDetailsByWithdrawal($data) {
		return $this->ci->player->addBankDetailsByWithdrawal($data);
	}

	public function editBankDetails($bank_details_id, $data) {
		return $this->ci->player->editBankDetails($bank_details_id, $data);
	}

	public function getActiveBankDetails($dw_bank) {
		return $this->ci->player->getActiveBankDetails($dw_bank);
	}

	public function getAllDeposits($player_id) {
		return $this->ci->player->getAllDeposits($player_id);
	}

	public function getAllDepositsWLimit($player_id, $limit, $offset) {
		return $this->ci->player->getAllDepositsWLimit($player_id, $limit, $offset);
	}

	public function getAllWithdrawals($player_id) {
		return $this->ci->player->getAllWithdrawals($player_id);
	}

	public function getAllWithdrawalsWLimit($player_id, $limit, $offset) {
		return $this->ci->player->getAllWithdrawalsWLimit($player_id, $limit, $offset);
	}

	public function populateWithdrawals($player_id, $data) {
		return $this->ci->player->populateWithdrawals($player_id, $data);
	}

	public function populateDeposits($player_id, $data) {
		return $this->ci->player->populateDeposits($player_id, $data);
	}

	public function populateTrasferHistory($player_id, $data) {
		return $this->ci->player->populateTrasferHistory($player_id, $data);
	}

	/**
	 * Will getPlayerAvailableBankAccountDeposit
	 *
	 * @return  array
	 */
	public function getPlayerAvailableBankAccountDeposit($playerId) {
		return $this->ci->player->getPlayerAvailableBankAccountDeposit($playerId);
	}

	/**
	 * Will getPlayerCurrentTotalWithdrawalToday
	 *
	 * @return  array
	 */
	public function getPlayerCurrentTotalWithdrawalToday($playerAccountId) {
		return $this->ci->player->getPlayerCurrentTotalWithdrawalToday($playerAccountId);
	}

	/**
	 * Will getPlayerAvailableThirdPartyAccountDeposit
	 *
	 * @return  array
	 */
	public function getPlayerAvailableThirdPartyAccountDeposit($playerId) {
		return $this->ci->player->getPlayerAvailableThirdPartyAccountDeposit($playerId);
	}

	/**
	 * Will set new balance amount
	 *
	 * @param   $playerId int
	 * @param   $data array
	 * @return  Boolean
	 */
	public function setPlayerNewBalAmount($playerId, $data) {
		return $this->ci->player->setPlayerNewBalAmount($playerId, $data);
	}

	/**
	 * Will get PlayerDepositRule
	 *
	 * @return  array
	 */
	public function getPlayerDepositRule($playerId) {
		return $this->ci->player->getPlayerDepositRule($playerId);
	}

	/**
	 * Will get PlayerWithdrawalRule
	 *
	 * @return  array
	 */
	public function getPlayerWithdrawalRule($playerId) {
		return $this->ci->player->getPlayerWithdrawalRule($playerId);
	}

	/**
	 * Will get player balance details
	 *
	 * @param   $playerId int
	 * @return  array
	 */
	public function getPlayerCashbackWalletBalance($playerId) {
		return $this->ci->player->getPlayerCashbackWalletBalance($playerId);
	}

	/**
	 * checkPlayerPromo
	 *
	 * @param   depositPromoId int
	 */
	public function checkPlayerPromoActive($playerId) {
		return $this->ci->player->checkPlayerPromoActive($playerId);
	}

	/**
	 * getPlayerPromoActive
	 *
	 * @param   depositPromoId int
	 */
	public function getPlayerPromoActive($playerId) {
		return $this->ci->player->getPlayerPromoActive($playerId);
	}

	/**
	 * checkPlayerPromo
	 *
	 * @param   depositPromoId int
	 */
	public function checkPlayerPromoRequest($playerId) {
		return $this->ci->player->checkPlayerPromoRequest($playerId);
	}

	/**
	 * checkDepositPromoLevelRule
	 *
	 * @param   depositPromoId int
	 */
	public function checkDepositPromoLevelRule($playerId, $depositPromoId) {
		return $this->ci->player->checkDepositPromoLevelRule($playerId, $depositPromoId);
	}

	/**
	 * get promo details
	 *
	 * @return  rendered template
	 */
	public function getPromoDetails($depositPromoId) {
		return $this->ci->player->getPromoDetails($depositPromoId);
	}

	/**
	 * apply promo
	 *
	 * @return  rendered template
	 */
	public function applyDepositPromo($data) {
		return $this->ci->player->applyDepositPromo($data);
	}

	/**
	 * getPlayerAdjustmentHistory
	 *
	 * @return  rendered template
	 */
	public function getPlayerAdjustmentHistory($playerId) {
		return $this->ci->player->getPlayerAdjustmentHistory($playerId);
	}

	/**
	 * getPlayerAdjustmentHistory
	 *
	 * @return  rendered template
	 */
	public function getPlayerAdjustmentHistoryWLimit($playerId, $limit, $offset) {
		return $this->ci->player->getPlayerAdjustmentHistoryWLimit($playerId, $limit, $offset);
	}

	/**
	 * getPlayerAdjustmentHistory
	 *
	 * @return  rendered template
	 */
	public function getCashbackHistory($playerId) {
		return $this->ci->player->getCashbackHistory($playerId);
	}

	/**
	 * getPlayerAdjustmentHistory
	 *
	 * @return  rendered template
	 */
	public function getCashbackHistoryWLimit($playerId, $limit, $offset) {
		return $this->ci->player->getCashbackHistoryWLimit($playerId, $limit, $offset);
	}

	/**
	 * getPlayerBlockGame
	 *
	 * @return  rendered template
	 */
	public function getPlayerBlockGame($playerId) {
		return $this->ci->player->getPlayerBlockGame($playerId);
	}

	/**
	 * getPlayer by Username
	 *
	 * @return  rendered template
	 */
	public function getPlayerByUsername($username) {
		return $this->ci->player->getPlayerByUsername($username);
	}
}

/* End of file user_functions.php */
/* Location: ./application/libraries/player_functions.php */
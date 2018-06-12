<?php
	/**
	 * Class for Dealing with Sales Orders from ordrhead
	 */
	class SalesOrder extends Order implements OrderInterface {
		protected $type;
		protected $custname;
		protected $orderno;
		protected $orderdate;
		protected $careof;
		protected $invdate;
		protected $shipdate;
		protected $revdate;
		protected $expdate;
		protected $hasdocuments;
		protected $hastracking;
		protected $editord;
		protected $sconame;
		protected $phintl;
		protected $extension;
		protected $releasenbr;
		protected $pricedisp;
		protected $taxcodedisp;
		protected $termtype;
		protected $rqstdate;
		protected $shipcom;
		protected $fob;
		protected $deliverydesc;
		protected $cardnumber;
		protected $cardexpire;
		protected $cardcode;
		protected $cardapproval;
		protected $totalcost;
		protected $totaldiscount;
		protected $paymenttype;
		protected $srcdatefrom;
		protected $srcdatethru;
		protected $prntfmt;
		protected $prntfmtdisp;

		// Properties needed by MYSQL to sort
		protected $dateoforder;


		/* =============================================================
			GETTER FUNCTIONS
		============================================================ */
		/**
		 * Returns if Sales Order has Documents
		 * @return bool
		 */
		public function has_documents() {
			return $this->hasdocuments == 'Y' ? true : false;
		}

		/**
		 * Returns if Sales Order has tracking
		 * @return bool
		 */
		public function has_tracking() {
			return $this->hastracking == 'Y' ? true : false;
		}

		public function has_notes() {
			return $this->hasnotes == 'Y' ? true : false;
		}
		
		/**
		 * Returns if the user can edit this order
		 * 1. Checks if the Sales Orders can be edited at all
		 * 2. Checks if the User has the permissions to edit orders
		 * 3. Checks if Sales Order is able to be edited
		 * 4. Checks if the Sales Order was just created
		 * @return bool Can Order Be edited by user?
		 * @uses DplusWire::wire('session')->createdorder
		 */
		public function can_edit() {
			$config = DplusWire::wire('pages')->get('/config/')->child("name=sales-orders");
			$config->allow_edit;
			$user_permitted = has_dpluspermission(DplusWire::wire('user')->loginid, 'eso');
			$can_edit = $this->editord == 'Y' ? true : false;
			
			// Can edit Sales Orders Config
			if ($config->allow_edit) {
				if ($user_permitted) {
					return $can_edit;
				} else {
					return false;
				}
			} elseif ($this->orderno == DplusWire::wire('session')->get('createdorder')) {
				return true;
			} else {
				return false;
			}
		}

		public function is_phoneintl() {
			return $this->phintl == 'Y' ? true : false;
		}

		/* =============================================================
			GENERATE ARRAY FUNCTIONS
			The following are defined CreateClassArrayTraits
			public static function generate_classarray()
			public function _toArray()
		============================================================ */
		/**
		 * Mainly called by the _toArray() function which makes an array
		 * based of the properties of the class, but this function filters the array
		 * to remove keys that are not in the database
		 * This is used by database classes for update
		 * @param  array $array array of the class properties
		 * @return array        with certain keys removed
		 */
		public static function remove_nondbkeys($array) {
			return $array;
		}

		/* =============================================================
			CRUD FUNCTIONS
		============================================================ */
		/**
		 * Returns SalesOrder from ordrhed
		 * @param  string $sessionID Session ID
		 * @param  string $ordn      Sales Order #
		 * @param  bool   $debug     Whether Sales Order or SQL Query for the Order is returned
		 * @return SalesOrder        Or SQL QUERY
		 * @uses Read (CRUD)
		 */
		public static function load($sessionID, $ordn, $debug = false) {
			return get_orderhead($sessionID, $ordn, true, $debug);
		}

		/**
		 * Updates the Sales Order in the ordrhed table
		 * @param  bool   $debug Whether or not SQL Query is Executed
		 * @return string SQL QUERY
		 * @uses Update (CRUD)
		 */
		public function update($debug = false) {
			return edit_orderhead($this->sessionid, $this->orderno, $this, $debug);
		}

		/**
		 * Updates the Payment Information Sales Order in the ordrhed table
		 * @param  bool   $debug Whether or not SQL Query is Executed
		 * @return string SQL QUERY
		 * @uses UPDATE (CRUD)
		 */
		public function update_payment($debug = false) {
			return edit_orderhead_credit($sessionID, $this->orderno, $this->paymenttype, $this->cardnumber, $this->cardexpire, $this->cardcode, $debug) ;
		}

		/**
		 * Checks for changes by comparing it to original
		 * @return bool Changes Made Or Not
		 * @uses SalesOrder::load()
		 */
		public function has_changes() {
			$properties = array_keys(get_object_vars($this));
			$order = SalesOrder::load($this->sessionid, $this->orderno);

			foreach ($properties as $property) {
				if ($this->$property != $order->$property) {
					return true;
				}
			}
			return false;
		}
	}

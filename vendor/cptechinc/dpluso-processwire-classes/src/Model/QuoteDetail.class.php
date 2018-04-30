<?php 
	/**
	 * [QuoteDetail description]
	 */
	class QuoteDetail extends OrderDetail implements OrderDetailInterface {
		protected $quotenbr;
		protected $venddetail;
		protected $leaddays;
		protected $ordrqty;
		protected $ordrprice;
		protected $ordrcost;
		protected $ordrtotalprice;
		protected $costuom;
		protected $quotind;
		protected $quotqty;
		protected $quotprice;
		protected $quotcost;
		protected $quotmkupmarg;
		protected $error;
		
		/* =============================================================
			GETTER FUNCTIONS
		============================================================ */
		/**
		 * Returns if QuoteDetail has error
		 * @return bool
		 */
		public function has_error() {
			return $this->error == 'Y' ? true : false;
		}
		
		/**
		 * Returns if QuoteDetail has doucments
		 * @return bool
		 */
		public function has_documents() {
			//return $this->notes == 'Y' ? true : false;
			return false;
		}
		
		/**
		 * Returns if Quote Detail is Editable
		 * @uses Quote 
		 * @return bool Comes from Quote->can_edit()
		 */
		public function can_edit() {
			$quote = Quote::load($this->sessionid, $this->quotenbr);
			return $quote->can_edit();
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
			unset($array['totalprice']);
			return $array;
		}
		
		/* =============================================================
			CRUD FUNCTIONS
		============================================================ */
		/**
		 * Inserts QuoteDetail into the Database
		 * @param  bool   $debug Whether or not Query is Executed
		 * @return string SQL UPDATE QUERY
		 * @uses   Create (CRUD)
		 */
		public function create($debug = false) {
			return insert_quotedetail($this->sessionid, $this, $debug);
		}
		
		/**
		 * Returns a QuoteDetail
		 * @param  string $sessionID Session ID
		 * @param  string $qnbr      Quote #
		 * @param  int    $linenbr   Line #
		 * @param  bool   $debug     Whether to Return SQL Query or Quote Detail
		 * @return QuoteDetail       Loaded From Query
		 * @uses   Read (CRUD)
		 */
		public static function load($sessionID, $qnbr, $linenbr, $debug = false) {
			return get_quotedetail($sessionID, $qnbr, $linenbr, $debug);
		}
		
		/**
		 * Updates the QuoteDetail in the database
		 * @param  bool   $debug Whether Update Query is run or not
		 * @return string SQL Query
		 * @uses   Update (CRUD)
		 */
		public function update($debug = false) {
			return update_quotedetail($this->sessionid, $this, $debug);
		}
		
		/**
		 * Checks if QuoteDetail has changes by comparing it to 
		 * the original Detail
		 * @return bool
		 * @uses Read (CRUD)
		 */
		public function has_changes() {
			$properties = array_keys(get_object_vars($this));
			$detail = self::load($this->sessionid, $this->quotenbr, $this->linenbr, false);
			
			foreach ($properties as $property) {
				if ($this->$property != $detail->$property) {
					return true;
				}
			}
			return false;
		}
	}

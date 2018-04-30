<?php 
     class II_ItemRequirementsScreen extends TableScreenMaker {
		protected $tabletype = 'normal'; // grid or normal
		protected $type = 'ii-stock'; 
		protected $title = 'Item Stock by Warehouse';
		protected $datafilename = 'iirequire'; 
		protected $testprefix = 'iireq';

		protected $datasections = array();
        protected $screentypes = array(
            "REQ" => "requirements", 
            "AVL" => 'available'
        );
        
        /* =============================================================
          PUBLIC FUNCTIONS
       	============================================================ */
        public function generate_screen() {
            $bootstrap = new Contento();
            $content = $bootstrap->div('class=row', $bootstrap->div('class=col-sm-5', $this->generate_warehouseform()));
            
            $tb = new Table('class=table table-striped table-bordered table-condensed table-excel');
			$tb->tablesection('thead');
				$tb->tr();
				foreach($this->json['columns'] as $column) {
					$class = Processwire\wire('config')->textjustify[$column['headingjustify']];
                    if (!empty($column['heading'])){
                        $tb->th("class=$class", $column['heading']);
                    }
				}
			$tb->closetablesection('thead');
			$tb->tablesection('tbody');
				foreach($this->json['data']['orders'] as $order) {
					$tb->tr();
					foreach(array_keys($this->json['columns']) as $column) {
						$class = Processwire\wire('config')->textjustify[$this->json['columns'][$column]['datajustify']];
                        if (!empty($this->json['columns'][$column]['heading'])){
                            $tb->td("class=$class", $order[$column]);
                        }
					}
				}
			$tb->closetablesection('tbody');
			$content .= $tb->close();
            return $content;
        }
        
        function generate_warehouseform() {
            $bootstrap = new Contento();
	        $whsejson = json_decode(file_get_contents(Processwire\wire('config')->companyfiles."json/whsetbl.json"), true);
            $warehouses = array_keys($whsejson['data']);
            $reloadpage = Processwire\wire('config')->ajax ? 'true' : 'false';
            $itemID = $this->json['itemid'];
            $warehouseID = $this->json['whse'];
            $screen = $this->json['reqavl'];
            foreach ($warehouses as $whse) {
                $warehouses[$whse] = $whsejson['data'][$whse]['warehouse name'];
            }
            $content = $bootstrap->h3('',  ucfirst($this->screentypes[$this->json['reqavl']]));
            $select = $bootstrap->select("class=form-control input-sm item-requirements-whse|onchange=requirements(this.value, '$screen', $reloadpage, '$itemID')", $warehouses, $this->json['whse']);
            $screentypeselect = $bootstrap->select("class=form-control input-sm item-requirements-screentype|onchange=requirements('$warehouseID', this.value, $reloadpage, '$itemID')", $this->screentypes, $this->json['reqavl']);
            $tb = new Table('class=table table-striped table-bordered table-condensed table-excel');
    			$tb->tr()->td('', 'Item ID:')->td('', $this->json['itemid']);
    			$tb->tr()->td('', 'Whse:')->td('', $select);
    			$tb->tr()->td('', 'View')->td('', $screentypeselect);
            $content .= $tb->close();
            return $content;
        }
    }

<?php 
     class II_ItemLotSerialScreen extends TableScreenMaker {
		protected $tabletype = 'normal'; // grid or normal
		protected $type = 'ii-lot-serial'; 
		protected $title = 'Item Lot Serial';
		protected $datafilename = 'iilotser'; 
		protected $testprefix = 'iilot';
		protected $datasections = array();
        
        /* =============================================================
          PUBLIC FUNCTIONS
       	============================================================ */
        public function generate_screen() {
            $bootstrap = new Contento();
            $content = '';
            $columns = array_keys($this->json['columns']);
			$count = 0; 
			$array = array(); 
			foreach ($this->json['columns'] as $column) {
				if ($column['sortavailable'] == 'n') { $array[] = $count; }
				$count++;
			}
			
			$tb = new Table("class=table table-striped table-bordered table-condensed table-excel|id=table");
			$tb->tablesection('thead');
				$tb->tr();
				foreach($this->json['columns'] as $column) {
					$class = Processwire\wire('config')->textjustify[$column['headingjustify']];
					$tb->th("class=$class", $column['heading']);
				}
			$tb->closetablesection('thead');
			$tb->tablesection('tbody');
				foreach ($this->json['data']['lots'] as $lot) {
					$tb->tr();
					foreach($columns as $column) {
						$class = Processwire\wire('config')->textjustify[$this->json['columns'][$column]['datajustify']];
						$tb->td("class=$class", $lot[$column]);
					}
				}
			$tb->closetablesection('tbody');
			$content = $tb->close();
            return $content;
        }
        
        public function generate_javascript() {
			$bootstrap = new Contento();
			$content = $bootstrap->open('script', '');
				$content .= "\n";
                // TODO
				$content .= "\n";
			$content .= $bootstrap->close('script');
			return $content;
		}
        
    }

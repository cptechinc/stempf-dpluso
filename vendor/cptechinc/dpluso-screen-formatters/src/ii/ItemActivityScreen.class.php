<?php 
     class II_ItemActivityScreen extends TableScreenMaker {
		protected $tabletype = 'normal'; // grid or normal
		protected $type = 'ii-activity'; 
		protected $title = 'Item Activity';
		protected $datafilename = 'iiactivity'; 
		protected $testprefix = 'iiact';
		protected $datasections = array();
        
        /* =============================================================
          PUBLIC FUNCTIONS
       	============================================================ */
        public function generate_screen() {
            $bootstrap = new Contento();
            $content = '';
            
            foreach($this->json['data'] as $warehouse) {
				$content .= $bootstrap->h3('', $warehouse['Whse Name']);
                
				$tb = new Table('class=table table-striped table-bordered table-condensed table-excel|id=activity');
				$tb->tablesection('thead');
					$tb->tr();
					foreach($this->json['columns'] as $column)  {
						$class = Processwire\wire('config')->textjustify[$column['headingjustify']];
						$tb->th("class=$class", $column['heading']);
					}
				$tb->closetablesection('thead');
				$tb->tablesection('tbody');
					foreach($warehouse['orders'] as $order) {
						$tb->tr();
						foreach(array_keys($this->json['columns']) as $column) {
							$class = Processwire\wire('config')->textjustify[$this->json['columns'][$column]['datajustify']];
							$tb->td("class=$class", $order[$column]);
						}
					}
				$tb->closetablesection('tbody');
				$content .= $tb->close();
			}
            return $content;
        }
        
        public function generate_javascript() {
			$bootstrap = new Contento();
			$content = $bootstrap->open('script', '');
            if (!$this->forprint) {
                $content .= "\n";
				$content .= $bootstrap->indent().'$(function() {';
					$content .= $bootstrap->indent() . $bootstrap->indent() ."$('#activity').DataTable();";
				$content .= $bootstrap->indent().'});';
				$content .= "\n";
            }
            $content .= $bootstrap->close('script');
			return $content;
		}
    }

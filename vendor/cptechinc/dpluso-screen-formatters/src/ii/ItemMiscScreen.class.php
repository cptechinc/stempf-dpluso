<?php 
     class II_ItemMiscScreen extends TableScreenMaker {
		protected $tabletype = 'normal'; // grid or normal
		protected $type = 'ii-misc'; 
		protected $title = 'Item Misc';
		protected $datafilename = 'iimisc'; 
		protected $testprefix = 'iim';
		protected $datasections = array();
        
        /* =============================================================
          PUBLIC FUNCTIONS
       	============================================================ */
        public function generate_screen() {
            return $this->generate_misctable();
        }
        
        public function generate_javascript() {
			$bootstrap = new Contento();
			return $bootstrap->script('', '');
		}
        
        /* =============================================================
          CLASS FUNCTIONS
       	============================================================ */
        protected function generate_misctable() {
            $bootstrap = new Contento();
            $tb = new Table('class=table table-striped table-condensed table-excel');
            foreach ($this->json['data'] as $misc) {
                foreach (array_keys($this->json['columns']['misc info']) as $column) {
                    $tb->tr();
                    $tb->td('', $this->json['columns']['misc info'][$column]['heading']);
                    $class = Processwire\wire('config')->textjustify[$this->json['columns']['misc info'][$column]['datajustify']];
                    $tb->td("class=$class", $misc[$column]);
                }
            }
        }
    }

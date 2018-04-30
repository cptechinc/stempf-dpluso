<?php
	class II_Quotes extends TableScreenFormatter {
        protected $tabletype = 'normal'; // grid or normal
		protected $type = 'ii-quotes'; // ii-sales-history
		protected $title = 'Item Quotes';
		protected $datafilename = 'iiquote'; // iisaleshist.json
		protected $testprefix = 'iiqt'; // iish
		protected $formatterfieldsfile = 'iiqtfmattbl'; // iishfmtbl.json
		protected $datasections = array(
            "header" => "Header",
			"detail" => "Detail",
		);
		
        public function generate_screen() {
            $bootstrap = new Contento();
            $content = '';
			$this->generate_tableblueprint();
		    
			foreach ($this->json['data'] as $whseid => $whse) {
				$content .= $bootstrap->h3('', $whse['Whse Name']);
                
                $tb = new Table("class=table table-striped table-bordered table-condensed table-excel|id=$whseid");
            	$tb->tablesection('thead');
            		for ($x = 1; $x < $this->tableblueprint['detail']['maxrows'] + 1; $x++) {
            			$tb->tr();
						$columncount = 0;
            			for ($i = 1; $i < $this->tableblueprint['cols'] + 1; $i++) {
            				if (isset($this->tableblueprint['detail']['rows'][$x]['columns'][$i])) {
            					$column = $this->tableblueprint['detail']['rows'][$x]['columns'][$i];
            					$class = Processwire\wire('config')->textjustify[$this->fields['data']['detail'][$column['id']]['headingjustify']];
            					$colspan = $column['col-length'];
            					$tb->th("colspan=$colspan|class=$class", $column['label']);
            				} else {
								if ($columncount < $this->tableblueprint['cols']) {
									$colspan = 1;
									$tb->th();
								}
            				}
							$columncount += $colspan;
            			}
            		}
            	$tb->closetablesection('thead');
            	$tb->tablesection('tbody');
            		foreach($whse['quotes'] as $quote) {
            			for ($x = 1; $x < $this->tableblueprint['header']['maxrows'] + 1; $x++) {
            				$tb->tr();
							$columncount = 0;
            				for ($i = 1; $i < $this->tableblueprint['cols'] + 1; $i++) {
            					if (isset($this->tableblueprint['header']['rows'][$x]['columns'][$i])) {
            						$column = $this->tableblueprint['header']['rows'][$x]['columns'][$i];
            						$class = Processwire\wire('config')->textjustify[$this->fields['data']['header'][$column['id']]['datajustify']];
            						$colspan = $column['col-length'];
            						$celldata = strlen($column['label']) ? '<b>'.$column['label'].'</b>: ' : '';
            						$celldata .= TableScreenMaker::generate_formattedcelldata($this->fields['data']['header'][$column['id']]['type'], $quote, $column);
            						$tb->td("colspan=$colspan|class=$class", $celldata);
            					} else {
									if ($columncount < $this->tableblueprint['cols']) {
										$colspan = 1;
										$tb->td();
									}
            					}
								$columncount += $colspan;
            				}
            			}

            			foreach ($quote['details'] as $item) {
            				for ($x = 1; $x < $this->tableblueprint['detail']['maxrows'] + 1; $x++) {
            					$tb->tr();
								$columncount = 0;
            					for ($i = 1; $i < $this->tableblueprint['cols'] + 1; $i++) {
            						if (isset($this->tableblueprint['detail']['rows'][$x]['columns'][$i])) {
            							$column = $this->tableblueprint['detail']['rows'][$x]['columns'][$i];
            							$class = Processwire\wire('config')->textjustify[$this->fields['data']['detail'][$column['id']]['datajustify']];
            							$colspan = $column['col-length'];
            							$celldata = TableScreenMaker::generate_formattedcelldata($this->fields['data']['detail'][$column['id']]['type'], $item, $column);
            							$tb->td("colspan=$colspan|class=$class", $celldata);
            						} else {
										if ($columncount < $this->tableblueprint['cols']) {
											$colspan = 1;
											$tb->td();
										}
            						}
									$columncount += $colspan;
            					}
            				}
            			}
            			$tb->tr('class=last-row-bottom');
            			$tb->td('colspan='.$this->tableblueprint['cols'],'&nbsp;');
            		}
            	$tb->closetablesection('tbody');
            	$content .= $tb->close();
			}
            return $content;
        }
    }

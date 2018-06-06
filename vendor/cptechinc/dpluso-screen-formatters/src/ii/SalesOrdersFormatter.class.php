<?php
	class II_SalesOrdersFormatter extends TableScreenFormatter {
        protected $tabletype = 'normal'; // grid or normal
		protected $type = 'ii-sales-orders'; // ii-sales-history
		protected $title = 'Item Sales Orders';
		protected $datafilename = 'iisalesordr'; // iisaleshist.json
		protected $testprefix = 'iiso'; // iish
		protected $formatterfieldsfile = 'iisofmattbl'; // iishfmtbl.json
		protected $datasections = array(
			"detail" => "Detail"
		);
        
        public function generate_screen() {
			$url = new \Purl\Url(Processwire\wire('config')->pages->ajaxload."ii/ii-documents/order/");
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
					foreach($whse['orders'] as $order) {
						if ($order != $whse['orders']['TOTAL']) {
							for ($x = 1; $x < $this->tableblueprint['detail']['maxrows'] + 1; $x++) {
								$tb->tr();
								$columncount = 0;
								for ($i = 1; $i < $this->tableblueprint['cols'] + 1; $i++) {
									if (isset($this->tableblueprint['detail']['rows'][$x]['columns'][$i])) {
										$column = $this->tableblueprint['detail']['rows'][$x]['columns'][$i];
										$class = Processwire\wire('config')->textjustify[$this->fields['data']['detail'][$column['id']]['datajustify']];
										$colspan = $column['col-length'];
										$celldata = TableScreenMaker::generate_formattedcelldata($this->fields['data']['detail'][$column['id']]['type'], $order, $column);
										
										if ($i == 1 && !empty($order["Sales Order Number"])) {
											$ordn = $order['Ordn'];
											$itemID = $this->json['itemid'];
											$url->query->setData(array('itemID' => $this->json['itemid'], 'ordn' => $ordn, 'returnpage' => urlencode(Processwire\wire('page')->fullURL->getUrl())));
											$href = $url->getUrl();
											$celldata .= "&nbsp; " . $bootstrap->openandclose('a', "href=$href|class=load-order-documents|title=Load Order Documents|aria-label=Load Order Documents|data-ordn=$ordn|data-itemid=$itemID|data-type=ii-sales-orders", $bootstrap->createicon('fa fa-file-text'));
										}
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
					}
				$tb->closetablesection('tbody');
				$tb->tablesection('tfoot');
					$order = $whse['orders']['TOTAL'];
					for ($x = 1; $x < sizeof($this->tableblueprint['detail']['rows']) + 1; $x++) {
						$tb->tr('class=totals');
						$columncount = 0;
						for ($i = 1; $i < $this->tableblueprint['cols'] + 1; $i++) {
							if (isset($this->tableblueprint['detail']['rows'][$x]['columns'][$i])) {
								$column = $this->tableblueprint['detail']['rows'][$x]['columns'][$i];
								$class = Processwire\wire('config')->textjustify[$this->fields['data']['detail'][$column['id']]['datajustify']];
								$colspan = $column['col-length'];
								$celldata = TableScreenMaker::generate_formattedcelldata($this->fields['data']['detail'][$column['id']]['type'], $order, $column);
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
				$tb->closetablesection('tfoot');
				$table = $tb->close();
				$content .= $table;
            } // FOREACH Whse
            return $content;
        }
		
		public function generate_javascript() {
			$bootstrap = new Contento();
			$content = '';
			if (!$this->forprint) {
				if ($this->tableblueprint['detail']['maxrows'] < 2) {
					$content = $bootstrap->open('script', '');
						$content .= "\n";
						$content .= $bootstrap->indent().'$(function() {';
							foreach ($this->json['data'] as $whseid => $whse) {
								$content .= $bootstrap->indent()."$('#$whseid').DataTable();";
							}
						$content .= $bootstrap->indent().'});';
						$content .= "\n";
					$content .= $bootstrap->close('script');
				}
			}
			return $content;
		}
    }

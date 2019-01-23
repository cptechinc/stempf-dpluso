<?php
	$url = new \Purl\Url($config->pages->ajaxload."ci/ci-documents/order/");
	
	$tb = new Table('class=table table-striped table-bordered table-condensed table-excel|id='.urlencode($whse['Whse Name']));
	
	/* $tb->tablesection('thead');
		for ($x = 1; $x < $table['detail']['maxrows'] + 1; $x++) {
			$tb->tr();
			for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
				if (isset($table['detail']['rows'][$x]['columns'][$i])) {
					$column = $table['detail']['rows'][$x]['columns'][$i];
					$class = $config->textjustify[$fieldsjson['data']['detail'][$column['id']]['headingjustify']];
					$colspan = $column['col-length'];
					$tb->th('colspan='.$colspan.'|class='.$class, $column['label']);
					if ($colspan > 1) { $i = $i + ($colspan - 1); }
				} else {
					$tb->th();
				}
			}
		}

		for ($x = 1; $x < $table['lotserial']['maxrows'] + 1; $x++) {
			$tb->tr();
			for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
				if (isset($table['lotserial']['rows'][$x]['columns'][$i])) {
					$column = $table['lotserial']['rows'][$x]['columns'][$i];
					$class = $config->textjustify[$fieldsjson['data']['lotserial'][$column['id']]['headingjustify']];
					$colspan = $column['col-length'];
					$celldata = '<b>'.$column['label'] . '</b>';
					$tb->td('colspan='.$colspan.'|class='.$class, $celldata);
					if ($colspan > 1) { $i = $i + ($colspan - 1); }
				} else {
					$tb->td();
				}

			}
		}
	$tb->closetablesection('thead');
	*/

	$tb->tablesection('tbody');
		foreach($whse['orders'] as $order) {
			for ($x = 1; $x < $table['detail']['maxrows'] + 1; $x++) {
				$tb->tr();
				for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
					if (isset($table['detail']['rows'][$x]['columns'][$i])) {
						$column = $table['detail']['rows'][$x]['columns'][$i];
						$class = $config->textjustify[$fieldsjson['data']['detail'][$column['id']]['headingjustify']];
						$colspan = $column['col-length'];
						$tb->th('colspan='.$colspan.'|class='.$class, $column['label']);
						if ($colspan > 1) { $i = $i + ($colspan - 1); }
					} else {
						$tb->th();
					}
				}
			}

			for ($x = 1; $x < $table['lotserial']['maxrows'] + 1; $x++) {
				$tb->tr('');
				for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
					if (isset($table['lotserial']['rows'][$x]['columns'][$i])) {
						$column = $table['lotserial']['rows'][$x]['columns'][$i];
						$class = $config->textjustify[$fieldsjson['data']['lotserial'][$column['id']]['headingjustify']];
						$colspan = $column['col-length'];
						$celldata = '<b>'.$column['label'] . '</b>';
						$tb->td('colspan='.$colspan.'|class='.$class, $celldata);
						if ($colspan > 1) { $i = $i + ($colspan - 1); }
					} else {
						$tb->td('false');
					}
				}
			}
			
			for ($x = 1; $x < $table['header']['maxrows'] + 1; $x++) {
				$tb->tr();
				for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
					if (isset($table['header']['rows'][$x]['columns'][$i])) {
						$column = $table['header']['rows'][$x]['columns'][$i];
						$class = $config->textjustify[$fieldsjson['data']['header'][$column['id']]['datajustify']];
						$colspan = $column['col-length'];
						if ($i == 1 && !empty($order['Order Number'])) {
							$ordn = $order['Ordn'];
							$url->query->setData(array('custID' => $custID, 'ordn' => $ordn, 'returnpage' => urlencode($page->fullURL->getUrl())));
							$href = $url->getUrl();
							$celldata = '<b class="pull-left">'.$column['label'].'</b> &nbsp;';
							$celldata .= Table::generatejsoncelldata($fieldsjson['data']['header'][$column['id']]['type'], $order, $column, $column);
							$celldata .= "&nbsp; " . $page->bootstrap->openandclose('a', "href=$href|class=load-order-documents|title=Load Order Documents|aria-label=Load Order Documents|data-ordn=$ordn|data-type=hist", $page->bootstrap->createicon('fa fa-file-text'));
							$tb->td('colspan='.$colspan.'|class='.$class, $celldata);
						} else {
							$celldata = '<b class="pull-left">'.$column['label'].'</b> &nbsp;';
							$celldata .= Table::generatejsoncelldata($fieldsjson['data']['header'][$column['id']]['type'], $order, $column);
							$tb->td('colspan='.$colspan.'|class='.$class, $celldata);
						}
						if ($colspan > 1) { $i = $i + ($colspan - 1); }
					} else {
						$tb->td();
					}
				}
			}

			foreach ($order['details'] as $item) {
				for ($x = 1; $x < $table['detail']['maxrows'] + 1; $x++) {
					$tb->tr();
					for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
						if (isset($table['detail']['rows'][$x]['columns'][$i])) {
							$column = $table['detail']['rows'][$x]['columns'][$i];
							$class = $config->textjustify[$fieldsjson['data']['detail'][$column['id']]['datajustify']];
							$colspan = $column['col-length'];
						//	$celldata = Table::generatejsoncelldata($fieldsjson['data']['detail'][$column['id']]['type'], $item, $column, false);
							$celldata = Table::generatejsoncelldata($fieldsjson['data']['detail'][$column['id']]['type'], $item, $column);
							$tb->td('colspan='.$colspan.'|class='.$class, $celldata);
							if ($colspan > 1) { $i = $i + ($colspan - 1); }
						} else {
							$tb->td();
						}
					}
				}

				foreach ($item['lotserial'] as $lotserial) {
					if (!empty($lotserial)) {
						for ($x = 1; $x < $table['lotserial']['maxrows'] + 1; $x++) {
							$tb->tr();
							for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
								if (isset($table['lotserial']['rows'][$x]['columns'][$i])) {
									$column = $table['lotserial']['rows'][$x]['columns'][$i];
									$class = $config->textjustify[$fieldsjson['data']['lotserial'][$column['id']]['datajustify']];
									$colspan = $column['col-length'];
									$celldata = Table::generatejsoncelldata($fieldsjson['data']['lotserial'][$column['id']]['type'], $lotserial, $column);
									$tb->td('colspan='.$colspan.'|class='.$class, $celldata);
									if ($colspan > 1) { $i = $i + ($colspan - 1); }
								} else {
									$tb->td();
								}
							}
						}
					}
				}
				
				if ($shownotes) {
					foreach ($item['detailnotes'] as $ordernote) {
						$tb->tr();
						for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
							if ($i == 2) {
								$tb->td('colspan=2', $ordernote['Detail Notes']);
								$i++;
							} else {
								$tb->td();
							}
						}
					}
				}
			} //ENDS DETAILS
			if ($shownotes) {
				foreach ($order['ordernotes'] as $ordernote) {
					$tb->tr();
					for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
						if ($i == 2) {
							$tb->td('colspan=2', $ordernote['Order Notes']);
							$i++;
						} else {
							$tb->td();
						}
					}
				}
			}

			for ($x = 1; $x < $table['total']['maxrows'] + 1; $x++) {
				$tb->tr();
				for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
					if (isset($table['total']['rows'][$x]['columns'][$i])) {
						$column = $table['total']['rows'][$x]['columns'][$i];
						$class = $config->textjustify[$fieldsjson['data']['total'][$column['id']]['datajustify']];
						$colspan = $column['col-length'];
						$tb->td('', '<b>'.$column['label'] . '</b>');
						$celldata = Table::generatejsoncelldata($fieldsjson['data']['total'][$column['id']]['type'], $order['totals'], $column);
						$tb->td('colspan='.$colspan.'|class='.$class, $celldata);
						$i++;
						if ($colspan > 1) { $i = $i + ($colspan - 1); }
					} else {
						$tb->td();
					}
				}
			}

			foreach ($order['shipments'] as $shipment) {
				for ($x = 1; $x < $table['shipments']['maxrows'] + 1; $x++) {
					$tb->tr();
					for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
						if (isset($table['shipments']['rows'][$x]['columns'][$i])) {
							$column = $table['shipments']['rows'][$x]['columns'][$i];
							$class = $config->textjustify[$fieldsjson['data']['shipments'][$column['id']]['headingjustify']];
							$colspan = $column['col-length'];
							$tb->th('colspan='.$colspan.'|class='.$class, $column['label']);
							if ($colspan > 1) { $i = $i + ($colspan - 1); }
						} else {
							$tb->th();
						}
					}
				}

				for ($x = 1; $x < $table['shipments']['maxrows'] + 1; $x++) {
					$tb->tr();
					for ($i = 1; $i < $table['maxcolumns'] + 1; $i++) {
						if (isset($table['shipments']['rows'][$x]['columns'][$i])) {
							$column = $table['shipments']['rows'][$x]['columns'][$i];
							$class = $config->textjustify[$fieldsjson['data']['shipments'][$column['id']]['datajustify']];
							$colspan = $column['col-length'];
							$celldata = Table::generatejsoncelldata($fieldsjson['data']['shipments'][$column['id']]['type'], $shipment, $column);
							$tb->td('colspan='.$colspan.'|class='.$class, $celldata);
							if ($colspan > 1) { $i = $i + ($colspan - 1); }
						} else {
							$tb->td();
						}
					}
				}
			}
			$tb->tr('class=last-row-bottom');
			$tb->td('colspan='.$table['maxcolumns'],'&nbsp;');
		}
	$tb->closetablesection('tbody');
	echo $tb->close();

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
/* Toolbar Container */
.tDiv {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f4f6f9;
    padding: 15px 25px;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    margin-bottom: 25px;
    transition: background-color 0.3s ease;
}

/* Basic Styling for Pagination */
.pDiv2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 8px;
}

/* Control Group Styling */
.pGroup {
    display: flex;
    align-items: center;
}

.pcontrol {
    font-size: 14px;
    color: #333;
}

/* Select Box Styling */
.per_page {
    padding: 5px 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    margin: 0 5px;
    transition: border-color 0.3s ease;
}

.per_page:focus {
    border-color: #007bff;
    outline: none;
}

/* Button Styling */
.pButton {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 6px 12px;
    margin: 0 3px;
    background-color: #007bff;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.pButton:hover {
    background-color: #0056b3;
}

.pButton .icon {
    font-size: 16px;
}

/* Button Separator */
.btnseparator {
    margin: 0 5px;
}

/* Input Field Styling */
.crud_page {
    width: 50px;
    padding: 5px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    text-align: center;
}

/* Reload Button Styling */
.pReload {
    background-color: #28a745;
    transition: background-color 0.3s ease;
}

.pReload:hover {
    background-color: #218838;
}

.pButton span {
    display: block;
    width: 100%;
    height: 100%;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    margin: 0;
    padding: 0;
    background: transparent;
}
.pButton:hover span {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}

/* Page Stat Styling */
.pPageStat {
    font-size: 14px;
    color: #333;
}

/* Last Page Number Styling */
.last-page-number {
    font-weight: bold;
    color: #007bff;
}

/* Separator Styling for Groups */
.pGroup + .btnseparator {
    margin-left: 10px;
}


/* Button Container */
.tDiv2, .tDiv3 {
	
    display: flex;
    align-items: center;
}

/* Base Button Styling */
.fbutton {
    display: inline-flex;
    align-items: center;
    padding: 10px 18px;
    border-radius: 5px;
    background: linear-gradient(145deg, #007bff, #0056b3);
    color: #fff;
	height: 30px;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Button specific colors */
/* .add-anchor .fbutton {
    background: linear-gradient(145deg, #28a745, #218838);
} */

.add-anchor .fbutton:hover {
    background: linear-gradient(145deg,rgb(8, 0, 255),rgb(0, 100, 215));
	border-radius: 8px;
}	

.export-anchor .fbutton {
    background: linear-gradient(145deg, #ffc107, #e0a800);
}

.export-anchor .fbutton:hover {
    background: linear-gradient(145deg, #e0a800, #c69500);
}

.print-anchor .fbutton {
    background: linear-gradient(145deg, #17a2b8, #117a8b);
}

.print-anchor .fbutton:hover {
    background: linear-gradient(145deg, #117a8b, #0d6b7d);
}

/* Button separator */
.btnseparator {
    margin: 0 12px;
}

/* Clear fix for the container */
.clear {
    clear: both;
}

/* Overall Container */
.sDiv.quickSearchBox {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f7f8fa;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: background-color 0.3s ease;
}

/* Input Fields and Select */
.sDiv2 {
    display: flex;
    gap: 12px;
    align-items: center;
}

.qsbsearch_fieldox, #search_field {
    padding: 8px 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
    outline: none;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

.qsbsearch_fieldox:focus, #search_field:focus {
    border: 1px solid #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
}

/* Search Button */
.crud_search {
    padding: 8px 16px;
    border: none;
    background: linear-gradient(145deg, #007bff, #0056b3);
    color: white;
    font-size: 14px;
    font-weight: 500;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.crud_search:hover {
    background: linear-gradient(145deg, #0056b3, #004085);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Clear Button Section */
.search-div-clear-button {
    display: flex;
    justify-content: flex-end;
}

.search_clear {
    padding: 8px 16px;
    border: none;
    background-color: #dc3545;
    color: white;
    font-size: 14px;
    font-weight: 500;
    border-radius: 25px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.search_clear:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

/* Clear Button Divider */
.search-div-clear-button .btnseparator {
    margin-left: 12px;
}
.pButton span::before,
.pButton span::after {
    display: none !important;
}

.tDiv3 {
    display: flex;
    justify-content: flex-end; /* aligns content to right */
    align-items: center;
    gap: 10px; /* spacing between buttons */
    padding: 5px 10px;
}


/* Responsive Design */
@media (max-width: 768px) {
    .sDiv.quickSearchBox {
        flex-direction: column;
        align-items: flex-start;
    }

    .sDiv2 {
        flex-direction: column;
        gap: 8px;
    }

    .search-div-clear-button {
        margin-top: 15px;
    }
}


/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .tDiv {
        flex-direction: column;
        align-items: flex-start;
        padding: 15px;
    }

    .tDiv2, .tDiv3 {
        margin-bottom: 10px;
    }
}



	</style>
</head>
<body>
	
</body>
</html>
<?php
	$this->set_css($this->default_theme_path.'/flexigrid/css/flexigrid.css');
	$this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);

	if ($dialog_forms) {
        $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
        $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
        $this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');
    }

    $this->set_js_lib($this->default_javascript_path.'/common/list.js');

	$this->set_js($this->default_theme_path.'/flexigrid/js/cookies.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/flexigrid.js');

    $this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');

	$this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.numeric.min.js');
	$this->set_js($this->default_theme_path.'/flexigrid/js/jquery.printElement.min.js');

	/** Jquery UI */
	$this->load_js_jqueryui();

?>
<script type='text/javascript'>
	var base_url = '<?php echo base_url();?>';

	var subject = '<?php echo addslashes($subject); ?>';
	var ajax_list_info_url = '<?php echo $ajax_list_info_url; ?>';
	var unique_hash = '<?php echo $unique_hash; ?>';
	var export_url = '<?php echo $export_url; ?>';

	var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";

</script>
<div id='list-report-error' class='report-div error'></div>
<div id='list-report-success' class='report-div success report-list' <?php if($success_message !== null){?>style="display:block"<?php }?>><?php
if($success_message !== null){?>
	<p><?php echo $success_message; ?></p>
<?php }
?></div>
<div class="flexigrid" style='width: 100%;' data-unique-hash="<?php echo $unique_hash; ?>">
	<div id="hidden-operations" class="hidden-operations"></div>
	<div class="mDiv">
		<div class="ftitle">
			&nbsp;
		</div>
		<div title="<?php echo $this->l('minimize_maximize');?>" class="ptogtitle">
			<span></span>
		</div>
	</div>
	<div id='main-table-box' class="main-table-box">

	<?php if(!$unset_add || !$unset_export || !$unset_print){?>
	<div class="tDiv">
		<?php if(!$unset_add){?>
		<div class="tDiv2">
        	<a href='<?php echo $add_url?>' title='<?php echo $this->l('list_add'); ?> <?php echo $subject?>' class='add-anchor add_button'>
			<div class="fbutton">
				<div>
					<span class="" style="font-size: small;"><?php echo $this->l('list_add'); ?> <?php echo $subject?></span>
				</div>
			</div>
            </a>
			<div class="btnseparator">
			</div>
		</div>
		<?php }?>
		<div class="tDiv3">
			<?php if(!$unset_export) { ?>
        	<a class="export-anchor" href="<?php echo $export_url; ?>" download>
				<div class="fbutton">
					<div>
						<span class=""><?php echo $this->l('list_export');?></span>
					</div>
				</div>
            </a>
			<div class="btnseparator"></div>
			<?php } ?>
			<?php if(!$unset_print) { ?>
        	<a class="print-anchor" data-url="<?php echo $print_url; ?>">
				<div class="fbutton">
					<div>
						<span class=""><?php echo $this->l('list_print');?></span>
					</div>
				</div>
            </a>
			<div class="btnseparator"></div>
			<?php }?>
		</div>
		<div class='clear'></div>
	</div>
	<?php }?>

	<div id='ajax_list' class="ajax_list">
		<?php echo $list_view?>
	</div>
	<?php echo form_open( $ajax_list_url, 'method="post" id="filtering_form" class="filtering_form" autocomplete = "off" data-ajax-list-info-url="'.$ajax_list_info_url.'"'); ?>
	<div class="sDiv quickSearchBox" id='quickSearchBox'>
		<div class="sDiv2">
			<?php echo $this->l('list_search');?>: <input type="text" class="qsbsearch_fieldox search_text" name="search_text" size="30" id='search_text'>
			<select name="search_field" id="search_field">
				<option value=""><?php echo $this->l('list_search_all');?></option>
				<?php foreach($columns as $column){?>
				<option value="<?php echo $column->field_name?>"><?php echo $column->display_as?>&nbsp;&nbsp;</option>
				<?php }?>
			</select>
            <input type="button" value="<?php echo $this->l('list_search');?>" class="crud_search" id='crud_search'>
		</div>
        <div class='search-div-clear-button'>
        	<input type="button" value="<?php echo $this->l('list_clear_filtering');?>" id='search_clear' class="search_clear">
        </div>
	</div>
	<div class="pDiv">
		<div class="pDiv2">
			<div class="pGroup">
				<span class="pcontrol">
					<?php list($show_lang_string, $entries_lang_string) = explode('{paging}', $this->l('list_show_entries')); ?>
					<?php echo $show_lang_string; ?>
					<select name="per_page" id='per_page' class="per_page">
						<?php foreach($paging_options as $option){?>
							<option value="<?php echo $option; ?>" <?php if($option == $default_per_page){?>selected="selected"<?php }?>><?php echo $option; ?>&nbsp;&nbsp;</option>
						<?php }?>
					</select>
					<?php echo $entries_lang_string; ?>
					<input type='hidden' name='order_by[0]' id='hidden-sorting' class='hidden-sorting' value='<?php if(!empty($order_by[0])){?><?php echo $order_by[0]?><?php }?>' />
					<input type='hidden' name='order_by[1]' id='hidden-ordering' class='hidden-ordering'  value='<?php if(!empty($order_by[1])){?><?php echo $order_by[1]?><?php }?>'/>
				</span>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pFirst pButton first-button">
					<span></span>
				</div>
				<div class="pPrev pButton prev-button">
					<span></span>
				</div>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<span class="pcontrol"><?php echo $this->l('list_page'); ?> <input name='page' type="text" value="1" size="4" id='crud_page' class="crud_page">
				<?php echo $this->l('list_paging_of'); ?>
				<span id='last-page-number' class="last-page-number"><?php echo ceil($total_results / $default_per_page)?></span></span>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pNext pButton next-button" >
					<span></span>
				</div>
				<div class="pLast pButton last-button">
					<span></span>
				</div>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<div class="pReload pButton ajax_refresh_and_loading" id='ajax_refresh_and_loading'>
					<span></span>
				</div>
			</div>
			<div class="btnseparator">
			</div>
			<div class="pGroup">
				<span class="pPageStat">
					<?php $paging_starts_from = "<span id='page-starts-from' class='page-starts-from'>1</span>"; ?>
					<?php $paging_ends_to = "<span id='page-ends-to' class='page-ends-to'>". ($total_results < $default_per_page ? $total_results : $default_per_page) ."</span>"; ?>
					<?php $paging_total_results = "<span id='total_items' class='total_items'>$total_results</span>"?>
					<?php echo str_replace( array('{start}','{end}','{results}'),
											array($paging_starts_from, $paging_ends_to, $paging_total_results),
											$this->l('list_displaying')
										   ); ?>
				</span>
			</div>
		</div>
		<div style="clear: both;">
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<style>
		/* Table Styling */
/* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.bDiv {
    background-color: #ffffff;
    border-radius: 5px;
    padding: 20px;
}

/* Table Styles */
#flex1 {
    width: 100%;
    border-collapse: collapse;
}

#flex1 th, #flex1 td {
    padding: 10px;
    text-align: left;
    vertical-align: middle;
    transition: background-color 0.3s ease;
}

/* Header Row */
#flex1 th {
    background-color:rgb(13, 56, 101);
    color: #fff;
    font-weight: bold;
    
    text-transform: uppercase;
}

#flex1 td {
    background-color: #ffffff;
    color: #333;
    border: 1px solid #ddd;
}

/* Row Hover */
#flex1 tr:hover {
    background-color: #f1f1f1;
}

/* Tools and Action Buttons */
.tools {
    display: flex;
    gap: 10px;
}

.tools a {
    padding: 8px 12px;
    border-radius: 4px;
    text-align: center;
    display: inline-block;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

/* Button Colors for Actions */
.delete-icon {
    background-color: #dc3545;
    color: white;
}

.edit-icon {
    background-color: #ffc107;
    color: white;
}

.clone-icon {
    background-color: #28a745;
    color: white;
}

.read-icon {
    background-color: #17a2b8;
    color: white;
}

/* Action Icon Effects */
.delete-icon:hover, .edit-icon:hover, .clone-icon:hover, .read-icon:hover {
    background-color: #007bff;
    color: white;
}

/* Action Links */
.crud-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 14px;
    background-color: #f8f9fa;
    color: #333;
    margin-right: 8px;
    transition: background-color 0.3s ease;
}

.crud-action:hover {
    background-color: #e9ecef;
}

.crud-action img {
    width: 20px;
    height: 20px;
    margin-right: 5px;
}

/* Responsive Styles */
@media screen and (max-width: 768px) {
    #flex1 th, #flex1 td {
        padding: 8px;
    }

    .tools {
        gap: 5px;
    }

    .tools a {
        font-size: 12px;
    }

    .crud-action {
        font-size: 12px;
    }
}

</style>
</head>
<body>
	
</body>
</html>
<?php 

	$column_width = (int)(80/count($columns));
	
	if(!empty($list)){
?><div class="bDiv" >
		<table cellspacing="0" cellpadding="0" border="0" id="flex1">
		<thead>
			<tr class='hDiv'>
				<?php foreach($columns as $column){?>
				<th width='<?php echo $column_width?>%'>
					<div class="text-left field-sorting <?php if(isset($order_by[0]) &&  $column->field_name == $order_by[0]){?><?php echo $order_by[1]?><?php }?>" 
						rel='<?php echo $column->field_name?>'>
						<?php echo $column->display_as?>
					</div>
				</th>
				<?php }?>
				<?php if(!$unset_delete || !$unset_edit || !$unset_read || !$unset_clone || !empty($actions)){?>
				<th align="left" abbr="tools" axis="col1" class="" width='20%'>
					<div class="text-right">
						<?php echo $this->l('list_actions'); ?>
					</div>
				</th>
				<?php }?>
			</tr>
		</thead>		
		<tbody>
<?php foreach($list as $num_row => $row){ ?>        
		<tr  <?php if($num_row % 2 == 1){?>class="erow"<?php }?>>
			<?php foreach($columns as $column){?>
			<td width='<?php echo $column_width?>%' class='<?php if(isset($order_by[0]) &&  $column->field_name == $order_by[0]){?>sorted<?php }?>'>
				<div class='text-left'><?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ; ?></div>
			</td>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<td align="left" width='20%'>
            <div class="tools btn-group" role="group">
    <?php if(!$unset_delete){ ?>
        <a href="<?php echo $row->delete_url ?>" 
           class="btn btn-danger btn-sm delete-row" 
           title="<?php echo $this->l('list_delete') . ' ' . $subject ?>">
            <i class="fa fa-trash"></i>
        </a>
    <?php } ?>

    <?php if(!$unset_edit){ ?>
        <a href="<?php echo $row->edit_url ?>" 
           class="btn btn-warning btn-sm edit_button" 
           title="<?php echo $this->l('list_edit') . ' ' . $subject ?>">
            <i class="fa fa-edit"></i>
        </a>
    <?php } ?>

    <?php if(!$unset_clone){ ?>
        <a href="<?php echo $row->clone_url ?>" 
           class="btn btn-primary btn-sm clone_button" 
           title="<?php echo $this->l('list_clone') . ' ' . $subject ?>">
            <i class="fa fa-copy"></i>
        </a>
    <?php } ?>

    <?php if(!$unset_read){ ?>
        <a href="<?php echo $row->read_url ?>" 
           class="btn btn-info btn-sm read_button" 
           title="<?php echo $this->l('list_view') . ' ' . $subject ?>">
            <i class="fa fa-eye"></i>
        </a>
    <?php } ?>

    <?php 
    if(!empty($row->action_urls)){
        foreach($row->action_urls as $action_unique_id => $action_url){ 
            $action = $actions[$action_unique_id];
    ?>
            <a href="<?php echo $action_url; ?>" 
               class="btn btn-secondary btn-sm <?php echo $action->css_class; ?> crud-action" 
               title="<?php echo $action->label ?>">
                <?php if(!empty($action->image_url)) { ?>
                    <img src="<?php echo $action->image_url; ?>" alt="<?php echo $action->label ?>" style="height:16px;" />
                <?php } else { ?>
                    <?php echo $action->label ?>
                <?php } ?>
            </a>		
    <?php 
        }
    }
    ?>					
</div>

			</td>
			<?php }?>
		</tr>
<?php } ?>        
		</tbody>
		</table>
	</div>
<?php }else{?>
	<br/>
	&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->l('list_no_items'); ?>
	<br/>
	<br/>
<?php }?>	

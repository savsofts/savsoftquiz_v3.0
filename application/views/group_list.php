 <div class="container">

   
 <h3><?php echo $title;?></h3>


  <div class="row">
 
<div class="col-md-12">
<br> 
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		<div id="message"></div>
		
		 <form method="post" action="<?php echo site_url('user/insert_group/');?>">
	
<table class="table table-bordered">
<tr>
 <th><?php echo $this->lang->line('group_name');?></th>
 <th><?php echo $this->lang->line('price'); ?></th>
 <th><?php echo $this->lang->line('valid_for_days');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($group_list)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}

foreach($group_list as $key => $val){
?>
<tr>
 <td><input type="text"   class="form-control"  value="<?php echo $val['group_name'];?>" onBlur="updategroup(this.value,'<?php echo $val['gid'];?>');" ></td>
 <td>
 <?php echo $this->config->item('base_currency_prefix');?> <input type="text"      value="<?php echo $val['price'];?>" onBlur="updategroupprice(this.value,'<?php echo $val['gid'];?>');" >
  <?php echo $this->config->item('base_currency_sufix');?>  </td>
 <td><input type="text"   class="form-control"  value="<?php echo $val['valid_for_days'];?>" onBlur="updategroupvalid(this.value,'<?php echo $val['gid'];?>');" ></td>
<td>
<a href="javascript:remove_entry('user/remove_group/<?php echo $val['gid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>

</td>
</tr>

<?php 
}
?>
<tr>
 <td>
 
 <input type="text"   class="form-control"   name="group_name" value="" placeholder="<?php echo $this->lang->line('group_name');?>"  required ></td>
<td>
 
  <?php echo $this->config->item('base_currency_prefix');?> 
 <input type="text"     name="price" value="" placeholder="<?php echo $this->lang->line('price');?>"  required >
  <?php echo $this->config->item('base_currency_sufix');?>  </td>
<td>
 
 
 <input type="text"   class="form-control"   name="valid_for_days" value="" placeholder="<?php echo $this->lang->line('valid_for_days');?>"  required ></td>
<td>
<button class="btn btn-default" type="submit"><?php echo $this->lang->line('add_new');?></button>
 
</td>
</tr>
</table>
</form>
</div>

</div>



</div>
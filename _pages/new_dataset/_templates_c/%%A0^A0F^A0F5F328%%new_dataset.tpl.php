<?php /* Smarty version 2.6.19, created on 2013-02-01 23:48:24
         compiled from /MAMP/GitHub/OchParliament/_pages/new_dataset/new_dataset.tpl */ ?>
<div class="new_dataset_wrap">

	<h1>Creating new dataset</h1>
	
	
	<form method="post">
	
	  <div class="step"  id="step_0"  style="display:none;">
			<h3>Step 1/4</h3>
			
			<div class="std_form">
				<p>
					<label>Name</label><input type="text" name="nazwa" id="f_nazwa"><span class="error">Required field</span>
				</p>
				<p>
					<label>ID</label><input type="text" name="alias" id="f_alias"><span class="error">ID already exists</span><span class="error">Required field</span>
				</p>
				<p>
					<label>Description</label><input type="text" name="alias" id="f_description"><span class="error">Required field</span>
				</p>
				<p>
					<label>Class</label><input type="text" name="results_class" id="f_results_class"><span class="error">Class already exists</span><span class="error">Required field</span>
				</p>
			</div>
			
			<p class="form_btns">
				<input type="button" value="Dalej" id="btn_step_1" class="mBtn">
			</p>
		</div>
		
		
		
		
		<div class="step"  id="step_1"  style="display:none;">
			<h3>Step 2/4</h3>
			
			<div class="main_form_div">
				<p>
					<label>Database table name: </label><input type="text" name="table" id="f_table"><span class="error">Required field</span>
				</p>
			</div>
			
			<p class="columns_label">Columns:</p>
			<div class="columns_div">
				<table id="inputs_step_0" class="form_table">
					<tr>
						<th>
							Name
						</th>
						<th>
							Type
						</th>
						<th>
							Length
						</th>
						<th>
						</th>
					</tr>
				</table>
				<p style="clear: both;">
					<input type="button" value="Add column" id="btn_add_step_0" class="mBtn yellow">
				</p>				
			</div>
			
			
			<p class="form_btns">
				<input type="button" value="Dalej" id="btn_step_0" class="mBtn">
			</p>
		</div>
		
		
		
		
		
		
		<div class="step" id="step_2" style="display:none;">
			<h3>Step 2/4</h3>
			<div class="inputs" id="inputs_step_2">
			
			</div>
			<p class="form_btns">
				<input type="button" value="Dalej" id="btn_step_2" class="mBtn">
			</p>
		</div>
	  
		
		
		
		<div class="step" id="step_3" style="display:none;">
			<h3>Krok 3/4</h3>
			<div class="inputs" id="inputs_step_3">
			
			</div>
			<p style="clear: both;">
				<input type="button" value="Dodaj dataset field" id="btn_add_step_3" class="mBtn blue">
			</p>
			<p style="clear: both;">
				<input type="button" value="Dalej" name="save" id="btn_step_3" class="mBtn">
			</p>
		</div>
		<div class="step" id="step_4" style="display:none;">
			<h3>Krok 4/4</h3>
			<div class="inputs" id="inputs_step_4">
			<select name="sort_field" id="f_sort_field"></select>
			<select name="order">
				<option value="ASC">Rosnąco</option>
				<option value="DESC">Malejąco</option>
			</select>
			</div>
			<p style="clear: both;">
				<input type="submit" value="Dalej" name="save" id="btn_step_4" class="mBtn">
			</p>
		</div>
	</form>


</div>
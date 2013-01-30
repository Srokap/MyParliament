<form method="post">
	<div class="step"  id="step_1"  style="display:none;">
		<h3>Krok 1/4</h3>
		<p>
			<label>Nazwa</label><input type="text" name="nazwa" id="f_nazwa"><span class="error">Pole wymagane</span>
		</p>
		<p>
			<label>Tabela</label><select name="table" id="f_table"><option></option>{foreach from=$tables item=table}<option>{$table}</option>{/foreach}</select><span class="error">Pole wymagane</span>
		</p>	
		<p>
			<label>Alias</label><input type="text" name="alias" id="f_alias"><span class="error">Alias juz istnieje</span><span class="error">Pole wymagane</span>
		</p>
		<p>
			<label>Klasa</label><input type="text" name="results_class" id="f_results_class"><span class="error">Klasa juz istnieje</span><span class="error">Pole wymagane</span>
		</p>
		<p>
			<input type="button" value="Dalej" id="btn_step_1" class="mBtn">
		</p>
	</div>
	<div class="step" id="step_2" style="display:none;">
		<h3>Krok 2/4</h3>
		<div class="inputs" id="inputs_step_2">
		
		</div>
		<p>
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
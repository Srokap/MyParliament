var WIZARD = Class.create({
	initialize : function( aliases, fields ) {
		this.org_aliases = aliases;
		this.org_fields = fields;
		this.aliases = $A();
		this.fields = $A();
		this.alias = '';
		if ($('btn_step_0'))
			$('btn_step_0').observe('click', this.step_0.bind(this));
		if ($('btn_add_step_0'))
			$('btn_add_step_0').observe('click', this.add_step_0.bind(this));		
		if ($('btn_step_1'))
			$('btn_step_1').observe('click', this.step_1.bind(this));
		if ($('btn_step_2'))
			$('btn_step_2').observe('click', this.step_2.bind(this));
		if ($('btn_step_3'))
			$('btn_step_3').observe('click', this.step_3.bind(this));
		if ($('btn_add_step_3'))
			$('btn_add_step_3').observe('click', this.add_step_3.bind(this));
		if( $('step_1') ){
			$('step_1').show();
		}
	},
	step_0 : function( e ){
		console.log( $( 'f_alias' ).value );
		var alias = $( 'f_alias' ).value;
		var c_fields = $$( '[name="fields[]"]' );
		var target = $('f_sort_field');
		for( i = 0; i < c_fields.length; i++ ){
			var opt = new Element('Option',{ 'value' : alias + '.' + $F(c_fields[i]) }).update( alias + '.' + $F(c_fields[i]) );
			target.insert( opt );
		}

		
		$('step_0').hide();
		$('step_4').show();		
	},
	add_step_0 : function( e ){
		var new_tr = new Element('tr');
		new_tr.update( '<td class="name_td"><input type="text" class="name" name="col_name[]"></td><td class="name_td"><input type="text" class="alias" name="fields[]"></td><td><select name="col_type[]"><option value="text">Text</option><option value="varchar">Varchar</option><option value="int">Int</option><option value="date">Date</option></select></td><td><input type="text" name="col_length[]"></td><td><input type="button" value="Remove" class="mBtn red"></td>' );
		var button = new_tr.down('input[type="button"]', 0);

		button.observe('click', this.remove_row.bind(this));
	    $('inputs_step_0').insert( new_tr );
	},
	remove_row : function( e ){
		console.log( 'a' );
		var select = e.currentTarget;
		select.up( 'tr' ).remove();
	},
	step_1 : function( e ){
		var error = false;
		e.currentTarget.up().up().select('.error').invoke( 'removeClassName','active' );
		if( $F('f_nazwa') == '' ){
			$('f_nazwa').up().down('span', 0).addClassName( 'active' );
			error = true;
		}
		if( $F('f_alias') == '' ){
			$('f_alias').up().down('span', 1).addClassName( 'active' );
			error = true;
		}
		if( $F('f_results_class') == '' ){
			$('f_results_class').up().down('span', 1).addClassName( 'active' );
			error = true;
		}
		
		//console.log( 'a');		
		if( error ){
			return;
		}

		//var params = {};
		//params.alias = $F('f_alias');
		//params.results_class = $F('f_results_class');
		//params.table =  $F('f_table');
		//$S( 'admin/wizard/step_1', params, this.on_update_step_1.bind(this) );
		
		this.on_update_step_1();
	},
	on_update_step_1 : function(){
		/*
		if( d.alias == 1){
			$('f_alias').up().down('span', 0).addClassName( 'active' );
		}
		if( d.results_class == 1 ){
			$('f_results_class').up().down('span', 0).addClassName( 'active' );
		}
		*/
		/*
		this.alias = $F('f_alias');
		d_fields = $$('[name="col_name[]"]' );
		var fields = '';
		for( i=0; i<d_fields.length; i++ ){
			fields += '<p>';
			fields += '<label>'+ d_fields[i].value +'</label>';
			fields += '<input type="text" value="" name="fields[]">';
			fields += '<input type="hidden" value="'+d_fields[i].value +'" name="keys[]">';
			fields += '</p>';
		}
		$('inputs_step_2').update( fields );
		*/
		$('step_1').hide();
		$('step_0').show();
	
	},
	step_2 : function( e ){
		var fields = $$('[name="fields[]"]' );
		var res = $A();
		for( i=0; i< fields.length; i++ ){
			if( fields[i].value != '' ){
				res.push(fields[i].value );
			}
		}
		this.fields = this.org_fields;
		this.fields[ this.alias  ] = res;
		this.aliases = this.org_aliases;
		this.aliases.unshift( this.alias );

		$('step_2').hide();
		$('step_3').show();
	},
	add_step_3 : function( e ){
		var new_div = new Element('div',{'style': 'clear: both;'});
		new_div.update( '<select name="c_alias[]"><option></option></select><select name="c_field[]"></select><input type="button" value="Usuń" class="mBtn red">' );
		var select = new_div.down('select', 0);
		var button = new_div.down('input', 0);
		
		for( var i=0; i<this.aliases.length; i++ ) {
		    var opt = new Element('Option');
		    opt.writeAttribute('value', this.aliases[i]);
		    opt.update( this.aliases[i] );
		    select.insert( opt );
	    }
	    select.observe('change', this.update_select.bind(this));
	    button.observe('click', this.remove_selects.bind(this));
	    $('inputs_step_3').insert( new_div );
	},
	update_select : function( e ){
		var select = e.currentTarget;
		var target = select.up( 'div' ).down('select', 1);
		var fields = this.fields[ $F( select ) ];
		target.length = 0;
		var opt = new Element('Option', {'value' : ''}).update( '' );
		target.insert( opt );
		  
		for( var i=0; i<fields.length; i++ ) {
			var opt = new Element('Option',{ 'value' : fields[i] }).update( fields[i] );
			target.insert( opt );
		}
	},
	remove_selects : function( e ){
		var select = e.currentTarget;
		select.up( 'div' ).remove();
	},
	step_3 : function( e ){

		var alias = $( 'f_alias' ).value;
		var c_fields = $$( '[name="fields[]"]' );
		var target = $('f_sort_field');
		for( i = 0; i < c_aliases.length; i++ ){
			var opt = new Element('Option',{ 'value' : alias + '.' + $F(c_fields[i]) }).update( alias + '.' + $F(c_fields[i]) );
			target.insert( opt );
		}
		
		$('step_3').hide();
		//$('step_4').show();		
	}
});

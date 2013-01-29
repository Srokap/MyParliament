var Lightpicker = Class.create({
  initialize: function(loader, params){
    this.loader = loader;
    var init_value = params.init_value ? params.init_value : '';
    this.div = new Element('div', {className: 'lightpicker '+this.loader}).update('<p class="input_cont"><input class="input" type="text", value="'+init_value+'" /></p><ul class="results"></ul>');
    if( params.className ) this.div.addClassName(params.className);
    this.preset = params.preset;
    this.input = this.div.down('.input').observe('keyup', this.onInputKeyup.bind(this));
    this.resultsDiv = this.div.down('.results');
    
    this.afterPick = params.afterPick;
    
    this.enabled = true;
    this.updateAgain = false;
    
    this.lbid = $M.addLightboxShow( this.div, {title: params.title, width: 500, height: 400, afterClose: this._close.bind(this)} );
    this.input.activate();
    
    if( params.suggestion ) {
      this.input.value = params.suggestion;
      this.updateResults();
    }
    
    this.loader_params = params.loader_params;
    this.exclude_ids = Object.isArray( params.exclude_ids ) ? params.exclude_ids : $A();
  },
  _close: function(lbdiv){
    if( Object.isElement(lbdiv) ) lbdiv.remove();
  },
  onInputKeyup: function(event){
    this.updateResults();
  },
  updateResults: function(){
    if( this.enabled ) {
      this.enabled = false;
      $S('lightpicker/update_results', {loader: this.loader, q: $F(this.input), loader_params: this.loader_params, preset: this.preset, exclude_ids: this.exclude_ids}, this.onUpdateResults.bind(this));
    } else { this.updateAgain = true; }
  },
  onUpdateResults: function(data){
    this.enabled = true;
    if( this.updateAgain ) { this.updateResults(); } else {
      this.resultsDiv.update(data['html']);
      this.resultsDiv.select('.item').invoke('observe', 'click', this._onClickItem.bind(this));
    }
    this.updateAgain = false;
  },
  _onClickItem: function(event){
    var el = event.findElement('.item');
    var param = el.readAttribute('itemId') ? el.readAttribute('itemId') : el;
    this.pick( param, el ); 
  },
  pick: function(id, el){
    if( Object.isFunction(this.afterPick) ) this.afterPick(id, el);
    $M.lightboxClose();
  }
});
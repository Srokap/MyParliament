
var DatasetLBFeature=Class.create({lb_id:false,lb_width:500,lb_height:200,built:false,initialize:function(){this.input=$$('.dataset_btns_ul input.'+this.className).first();this.input.observe('click',this.on_input_click.bind(this));},on_input_click:function(event){this.build();$M.lightbox(this.lb_id,{});},build:function(){if(!this.lb_id){this.lb_div=this.get_content_div().addClassName('DatasetLBFeature');this.lb_id=$M.addLightbox(this.lb_div,{width:this.lb_width,height:this.lb_height,title:this.lb_title});}}});var RSSFeature=Class.create(DatasetLBFeature,{className:'rss',lb_title:'Prenumeruj dane przez RSS:',get_content_div:function(){var div=new Element('div').addClassName(this.className);var p=new Element('p',{className:'title'}).update('Jeśli chcesz otrzymywać powiadomienia o nowych elementach w tym zbiorze przez RSS, dodaj poniższy link do swojego czytnika:');var input_cont_div=new Element('div',{className:'input_cont'});var input=new Element('input',{readonly:'readonly'});input.value='http://rss.sejmometr.pl/'+_dataset.base_alias;div.insert(p).insert(input_cont_div.update(input));return div;}});var APIFeature=Class.create(DatasetLBFeature,{className:'api',lb_title:'Browse data with a REST-API:',lb_height:380,get_content_div:function(){var div=new Element('div').addClassName(this.className);var p=new Element('p',{className:'title'}).update('To browse these data programmatically, send HTTP requests with a proper <i>Accept</i> header, to url:');div.insert(p);var input_cont_div=new Element('div',{className:'input_cont'});var input=new Element('input',{readonly:'readonly'});input.value='http://sejmometr.pl/'+_dataset.base_alias;div.insert(input_cont_div.update(input));var desc_div=new Element('div',{className:'desc_div'}).addClassName('first');var p=new Element('p',{className:'title'}).update('To get data in XML format, uset HTTP header <i>Accept</i>:');desc_div.insert(p);var p=new Element('p',{className:'param'}).update('application/vnd.EPF_API.v1+xml');desc_div.insert(p);div.insert(desc_div);var desc_div=new Element('div',{className:'desc_div'});var p=new Element('p',{className:'title'}).update('To get data in JSON format, uset HTTP header <i>Accept</i>:');desc_div.insert(p);var p=new Element('p',{className:'param'}).update('application/vnd.EPF_API.v1+json');desc_div.insert(p);div.insert(desc_div);var p=new Element('p',{className:'link'}).update('<a href="/api/docs/'+_dataset.results_class+'">Documentation &raquo;</a>');desc_div.insert(p);return div;}});var dataset_lb_features={};$M.addInitCallback(function(){dataset_lb_features['rss']=new RSSFeature();dataset_lb_features['api']=new APIFeature();});
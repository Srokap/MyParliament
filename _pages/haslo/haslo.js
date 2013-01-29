function form_submit(){
  var email = $F('email_input').strip();
  if( email!='' ) {
    $$('#form_div input')[0].disable();
    $$('#form_div .btns')[0].addClassName('_LOADING').select('a').invoke('hide');
    $S('mPortal/users/recover_pass', email, function(){
      $$('#form_div .btns')[0].remove();
      $('info').update('Sprawdź swój email. Jeśli użyłeś go do rejestracji konta Sejmometr - wysłaliśmy na niego nowe hasło do serwisu.');
    });
  }
}

$M.addInitCallback(function(){
  var form = $('form');
  $('form').observe('submit', form_submit);
  $('form_div').down('._BTN').observe('click', form_submit);
  form.down('input')[0].activate();
});
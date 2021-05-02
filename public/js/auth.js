$(".reveal").on('click',function() {
  var $pwd = $("#password-field");
  if ($pwd.attr('type') === 'password') {
      $('#mata').removeClass( "fa-eye" );
      $('#mata').addClass( "fa-eye-slash" );
      $pwd.attr('type', 'text');
  } else {
      $('#mata').removeClass( "fa-eye-slash" );
      $('#mata').addClass( "fa-eye" );
      $pwd.attr('type', 'password');
  }
});

$(".pw-baru").on('click',function() {
  var $pwd = $("#password-field-pwbaru");
  if ($pwd.attr('type') === 'password') {
      $('#mata-baru').removeClass( "fa-eye" );
      $('#mata-baru').addClass( "fa-eye-slash" );
      $pwd.attr('type', 'text');
  } else {
      $('#mata-baru').removeClass( "fa-eye-slash" );
      $('#mata-baru').addClass( "fa-eye" );
      $pwd.attr('type', 'password');
  }
});

$(".pw-konfir").on('click',function() {
  var $pwd = $("#password-field-pwkonfir");
  if ($pwd.attr('type') === 'password') {
      $('#mata-konfir').removeClass( "fa-eye" );
      $('#mata-konfir').addClass( "fa-eye-slash" );
      $pwd.attr('type', 'text');
  } else {
      $('#mata-konfir').removeClass( "fa-eye-slash" );
      $('#mata-konfir').addClass( "fa-eye" );
      $pwd.attr('type', 'password');
  }
});
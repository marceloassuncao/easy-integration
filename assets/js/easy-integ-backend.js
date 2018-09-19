jQuery(document).ready(function() {
  function handleClick(e) {
    let data = {
      action: 'esi_async_request',
    };

    jQuery.ajax({
      url: ajaxurl,
      method: 'POST',
      dataType: 'json',
      data: data,
      beforeSend: function() {
        jQuery('.esi-btn').attr('disabled', true);
      },
      success: function(response) {
        jQuery('.esi-btn').attr('disabled', false);
        console.log(response);
      },
    });
  }

  jQuery('.esi-btn').on('click', handleClick);
});

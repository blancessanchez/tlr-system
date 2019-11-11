$.widget.bridge('uibutton', $.ui.button);

$(function() {
  /**
   * hide disapproved textbox on leave response
   * URL: http://tlr.local/leaves/view/{id} 
   */
  $('#lblDisapproved').hide();
  var view_recommendation_type = $('input[name="LeaveApplicationResponses[recommendation_type]"]:checked').val();
  if (view_recommendation_type == 0) {
    $('#lblDisapprovedView').hide();
    $('#recommendation_description_disabled').hide();
  }

  /**
   * option configuration for leave add
   * URL: http://tlr.local/leaves/add
   */
  $('#add_leave_category_id option[value!=""]').hide();
  $('#add_leave_type_id').change(function() {
    var leave_type_id = $('#add_leave_type_id').val();
    if (leave_type_id == 1) { //vacation
      $('#add_leave_category_id option[value="3"]').hide();
      $('#add_leave_category_id option[value="4"]').hide();
      $('#add_leave_category_id option[value="1"]').show();
      $('#add_leave_category_id option[value="2"]').show();
    } else if (leave_type_id == 2) { //sick
      $('#add_leave_category_id option[value="1"]').hide();
      $('#add_leave_category_id option[value="2"]').hide();
      $('#add_leave_category_id option[value="3"]').show();
      $('#add_leave_category_id option[value="4"]').show();
    } else {
      $('#add_leave_category_id option[value="1"]').hide();
      $('#add_leave_category_id option[value="2"]').hide();
      $('#add_leave_category_id option[value="3"]').hide();
      $('#add_leave_category_id option[value="4"]').hide();
    }
  });

  /**
   * configuration for hired date
   * URL: http://tlr.local/employees/add
   */
  $('#hired_date').datepicker({
    autoclose: true,
    defaultDate:'now'
  });

  /**
   * configuration for leaves
   * URL: http://tlr.local/leaves/add
   */
  var today = new Date();
  var lastWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7);
  $('#leave_from, #leave_to').datepicker({
    daysOfWeekDisabled: [0,6],
    startDate: lastWeek,
    autoclose: true,
    dateFormat: 'yyyy-mm-dd'
  });

  $('#employee_list').DataTable();
  $('#leaves_list').DataTable();

  $('#btnApplicationResponse').on('click', function(e) {
    if (confirm('Submit leave response, are you sure?')) {
      var id = $('#leave_application_id').val();
      var recommendation_type = $('input[name="LeaveApplicationResponses[recommendation_type]"]:checked').val();
      var recommendation_description = $('#recommendation_description').val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('[name="_csrfToken"]').val()
        }
      });
      $.ajax({
        url: '/leave_response/add',
        method: 'POST',
        type: 'ajax',
        dataType: 'json',
        data: {
          id: id,
          recommendation_type: recommendation_type,
          recommendation_description: recommendation_description
        }
      }).done(function(res) {
        if (res.status = true) {
          location.href = '/leaves';
        }
      }).fail(function(res) {
        if (res.status == 422) {
          alert('Sending application response is failed. Please check your input');
          let mainResponse = $.parseJSON(res.responseText);
          if (mainResponse.errors) {
            $.each(mainResponse.errors, function(key, value) {
              if (key.indexOf('.') !== -1) {
                key = `label[id="error_${key}"]`;
              } else {
                key = '#error_' + key;
              }
              $(key).text(value._required);
            });
          }
        }
      }).always(function(data) {
        $('#btnApplicationResponse').data('requestRunning', false); //Prevent multiple submits
      });
    } else {
      return;
    }
  });

  $('input[name="LeaveApplicationResponses[recommendation_type]"]').change(function() {
    if ($(this).val() == 1) {
      $('#lblDisapproved').show();
      $('#recommendation_description').prop('type', 'text');
    } else if ($(this).val() == 0) {
      $('#lblDisapproved').hide();
      $('#error_recommendation_description').html('');
      $('#recommendation_description').prop('type', 'hidden');
    }
  });

  /**
   * configuration for leave edit
   * http://tlr.local/leaves/edit/1
   */
  $('#btnCancelLeave').on('click', function(e) {
    if (confirm('Cancel leave application, are you sure?')) {
      var edit_leave_application_id = $('#edit_leave_application_id').val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('[name="_csrfToken"]').val()
        }
      });
      $.ajax({
        url: '/leaves/cancel/' + edit_leave_application_id,
        method: 'POST',
        type: 'ajax',
        dataType: 'json',
        data: {
          id: edit_leave_application_id
        }
      }).done(function(res) {
        if (res.status = true) {
          location.href = '/';
        }
      }).fail(function(res) {
        if (res.status == 422) {
          alert('Cancelling application is failed. Please try again');
        }
      }).always(function(data) {
        $('#btnCancelLeave').data('requestRunning', false); //Prevent multiple submits
      });
    } else {
      return;
    }
  });
})
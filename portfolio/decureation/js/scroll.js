$(document).ready(function(){
//check all and checknone
  $('#all_c').click(function() {
      var selectAllButton = $('#selectAllButton');
      var selectNoneButton = $('#selectNoneButton');
      var checkboxes = $('.cate_check input:checkbox');
      var checklabels = $('.label_check');
      checkboxes.prop('checked', true);
      checklabels.addClass('c_on');
      selectAllButton.addClass('c_on');
      selectNoneButton.removeClass('c_on');
  });

  $('#none_c').click(function() {
      var selectAllButton = $('#selectAllButton');
      var selectNoneButton = $('#selectNoneButton');
      var checkboxes = $('.s_cate input:checkbox');
      var checklabels = $('.label_check');
      checkboxes.prop('checked', false);
      checklabels.removeClass('c_on');
      selectNoneButton.addClass('c_on');
      selectAllButton.removeClass('c_on');
  });
    
  $('#all_l').click(function() {
      var selectAllButton = $('#selectAllButton');
      var selectNoneButton = $('#selectNoneButton');
      var checkboxes = $('.level_check input:checkbox');
      var checklabels = $('.label_check');
      checkboxes.prop('checked', true);
      checklabels.addClass('c_on');
      selectAllButton.addClass('c_on');
      selectNoneButton.removeClass('c_on');
  });

  $('#none_l').click(function() {
      var selectAllButton = $('#selectAllButton');
      var selectNoneButton = $('#selectNoneButton');
      var checkboxes = $('.s_level input:checkbox');
      var checklabels = $('.label_check');
      checkboxes.prop('checked', false);
      checklabels.removeClass('c_on');
      selectNoneButton.addClass('c_on');
      selectAllButton.removeClass('c_on');
  });
    
  $('#all_t').click(function() {
      var selectAllButton = $('#selectAllButton');
      var selectNoneButton = $('#selectNoneButton');
      var checkboxes = $('.tutor_check input:checkbox');
      var checklabels = $('.label_check');
      checkboxes.prop('checked', true);
      checklabels.addClass('c_on');
      selectAllButton.addClass('c_on');
      selectNoneButton.removeClass('c_on');
  });

  $('#none_t').click(function() {
      var selectAllButton = $('#selectAllButton');
      var selectNoneButton = $('#selectNoneButton');
      var checkboxes = $('.s_tutor input:checkbox');
      var checklabels = $('.label_check');
      checkboxes.prop('checked', false);
      checklabels.removeClass('c_on');
      selectNoneButton.addClass('c_on');
      selectAllButton.removeClass('c_on');
  });
    
  $('.sh_btn p').click(function() {
      $('.result').toggleClass('sh');
      $('.sh_btn').toggleClass('width');
  });
    
    
});
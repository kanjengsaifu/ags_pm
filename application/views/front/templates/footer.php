<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
  <span>2017 | Admaresi Globalindo</span>
</footer>
<script type="text/javascript">
;(function ($) { $.fn.datepicker.language['en'] = {
  days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
  daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
  daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
  months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
  monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  today: 'Today',
  clear: 'Clear',
  dateFormat: 'yyyy-mm-dd',
  timeFormat: 'hh:ii aa',
  firstDay: 0
}; })(jQuery);

function savefeed() {
  $('#btnAddFeed').text('Saving...');
  $('#btnAddFeed').attr('disabled', true);
  var url;

  url = "<?=site_url('feedback/save')?>";

  $.ajax({
    url: url,
    type: "POST",
    data: $('#form_addfeed').serialize(),
    success: function(data) {
      if (data.status = 'true') {
        $('.modal').removeClass('show');
        $('.modal').removeClass('in');
        $('.modal').attr("aria-hidden","true");
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('#alert').modal('show');
        swal("Success!", "Feedback berhasil disubmit!", "success");
      }
      $('#btnAddFeed').text('Submit');
      $('#btnAddFeed').attr('disabled', false);
    }
  });
}

// $(document).on('click', '[data-toggle="lightbox"]', function(event) {
//     event.preventDefault();
//     $(this).ekkoLightbox();
// });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment.js"></script>
<script type="text/javascript" src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="http://demo.harviacode.com/select2/select2.min.js"></script>
<?=js('theme/adminator/colorlib.com/polygon/adminator/vendor.js')?>
<?=js('theme/adminator/colorlib.com/polygon/adminator/bundle.js')?>
</body>
</html>

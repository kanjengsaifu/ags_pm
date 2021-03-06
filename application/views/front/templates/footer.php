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
<?php if (isAdminJakarta() || isAdminTasik()): ?>
  <?php //echo js('js/webcam.min.js')?>
  <script language="JavaScript">
    $('.ui.modal')
      .modal('show')
    ;
    $(document).ready(function() {
      $('#history_btn').click(function() {
          Webcam.set({
            width: 500,
            height: 400,
            image_format: 'jpeg',
            jpeg_quality: 90
          });
          Webcam.attach( '#my_camera' );
        });
      });

      <?php if (isAdminTasik()) { ?>
        // INI
        // Webcam.set({
        //   width: 500,
        //   height: 400,
        //   image_format: 'jpeg',
        //   jpeg_quality: 90
        // });
        // Webcam.attach('#my_camera');
      <?php } ?>
      // INI
      // function take_snapshot() {
      //   // take snapshot and get image data
      //   Webcam.snap( function(data_uri) {
      //     // display results in page
      //     document.getElementById('results').innerHTML =
      //       '<br><hr><h2>Preview sebelum upload :</h2>' +
      //       '<img id="imageprev" src="'+data_uri+'"/>';
      //   });
      // }
      // INI
      // function reset_cam(id) {
      //   Webcam.reset();
      //   Webcam.attach( '#my_camera' );
      //   document.getElementById("id_val").value = id;
      //   document.getElementById("imageprev").src = "";
      // }

      // Webcam.set({
      //   width: 420,
      //   height: 340,
      //   image_format: 'jpeg',
      //   jpeg_quality: 90
      // });
      // Webcam.attach( '#my_camera' );
      //
      // function take_snapshot() {
      //   Webcam.snap(function(data_uri) {
      //     document.getElementById('results').innerHTML = '<img id="imageprev" src="'+data_uri+'"/>';
      //   });
      //
      //   Webcam.reset();
      // }
      // INI
      // function saveSnap() {
      //   // console.log(document.getElementById('imageprev'));
      //    var base64image = document.getElementById("imageprev").src;
      //    var pengajuan_id = document.getElementById("id_val").value;
      //
      //    Webcam.upload( base64image, '<?=base_url('submission/capture/')?>'+pengajuan_id, function(code, text) {
      //      swal("Success!", "Evidence berhasil diupload!", "success");
      //    });
      //  }
  </script>
<?php endif; ?>
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
<script type="text/javascript">
  jQuery.validator.addMethod( 'passwordMatch', function(value, element) {
    var password = $("#ep_password").val();
    var confirmPassword = $("#ep_conf_password").val();

    if (password != confirmPassword ) {
        return false;
    } else {
        return true;
    }

  }, "Your Passwords Must Match");

  $(document).ready(function() {
    $("#form_cp").validate({
      rules: {
        ep_cur_password: {
          required: true,
          "remote": {
            url: "<?=base_url('app/checkCurrPassword')?>",
            type: "POST",
            data: {
              currpass: function() {
                return $('#ep_cur_password').val();
              }
            }
          },
        },
        ep_password: {
          required: true,
          minlength: 6
        },
        ep_conf_password: {
          required: true,
          minlength: 6,
          passwordMatch: true
        }
      },
      messages: {
        ep_cur_password: {
          required: "Wajib diisi!",
          remote: "Password saat ini salah!"
        },
        ep_password: {
          required: "Wajib diisi!",
          minlength: "Min 6 characters!"
        },
        ep_conf_password: {
          required: "Wajib diisi!",
          minlength: "Min 6 characters!",
          passwordMatch: "Konfirmasi password harus sesuai dengan password baru!"
        }
      },
      errorClass: "text-danger"
    });
  });

  function checkCurrPassword() {
    var curr_password = $('#ep_cur_password').val();

    $.ajax({
      url: "<?=base_url('app/checkCurrPassword')?>",
      data: {currpass: curr_password},
      type: "POST",
      dataType: "json",
      success: function() {
        if (true) {

        }
      }
    });
  }
</script>
<?=js('js/bootstrap-select.min.js')?>
<?=js('js/moment.js')?>
<?=js('js/bootstrap-tagsinput.min.js')?>
<?=js('js/select2.min.js')?>
<?=js('theme/adminator/colorlib.com/polygon/adminator/vendor.js')?>
<?=js('theme/adminator/colorlib.com/polygon/adminator/bundle.js')?>
</body>
</html>

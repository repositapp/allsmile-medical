<script src="<?= base_url(); ?>assets/lib/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/bootstrap/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/pace/pace.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/nano-scroll/jquery.nanoscroller.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/metisMenu/metisMenu.min.js"></script>
<script src="<?= base_url(); ?>assets/js/custom.js"></script>

<!-- Datatables-->
<script src="<?= base_url(); ?>assets/lib/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/lib/toast/jquery.toast.min.js"></script>

<!-- Javascript Bootstrap Datepicker -->
<script src="<?= base_url(); ?>assets/lib/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<!-- Fotmatter Form Mask -->
<script src="<?= base_url(); ?>assets/lib/formatter/jquery.formatter.min.js"></script>

<script>
   $(document).ready(function() {
      $('#datatable').dataTable();
      $('#datatable2').dataTable();
      <?= $this->session->flashdata('msg'); ?>

      // cetak
      var maxGroup = 10;
      $(".cetak").click(function() {
         window.print();
      });

      //melakukan proses multiple input
      var maxGroup = 10;
      $(".addMoreDiag").click(function() {
         if ($('body').find('.tambDiagnos').length < maxGroup) {
            var fieldHTML = '<div class="row tambDiagnos">' + $(".tambDiagnosCopy").html() + '</div>';
            $('body').find('.tambDiagnos:last').after(fieldHTML);
         } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
         }
      });

      $(".addMoreTind").click(function() {
         if ($('body').find('.tambTind').length < maxGroup) {
            var fieldHTML = '<div class="row tambTind">' + $(".tambTindCopy").html() + '</div>';
            $('body').find('.tambTind:last').after(fieldHTML);
         } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
         }
      });

      $(".addMoreObat").click(function() {
         if ($('body').find('.tambObat').length < maxGroup) {
            var fieldHTML = '<div class="row tambObat">' + $(".tambObatCopy").html() + '</div>';
            $('body').find('.tambObat:last').after(fieldHTML);
         } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
         }
      });

      //remove fields group
      $("body").on("click", ".removeDiag", function() {
         $(this).parents(".tambDiagnos").remove();
      });
      $("body").on("click", ".removeTind", function() {
         $(this).parents(".tambTind").remove();
      });
      $("body").on("click", ".removeObat", function() {
         $(this).parents(".tambObat").remove();
      });
   });

   $('#berat_badan').formatter({
      'pattern': '{{999}}'
   });

   $('#tinggi_badan').formatter({
      'pattern': '{{999}}'
   });

   $('#pers_diskon').formatter({
      'pattern': '{{999}}'
   });

   $('#quantity_obat').formatter({
      'pattern': '{{9999}}'
   });

   $('#no_pasien').formatter({
      'pattern': '{{9999999999999999}}'
   });

   $('#tekanan_darah').formatter({
      'pattern': '{{999}}/{{999}}'
   });

   $(".theSelect").select2();

   $(document).ready(function() {
      $('#tgl_lahir').datepicker({
         format: "yyyy-mm-dd",
         autoclose: true
      });
      $('#date1').datepicker({
         format: "yyyy-mm-dd",
         autoclose: true
      });
      $('#date2').datepicker({
         format: "yyyy-mm-dd",
         autoclose: true
      });
   });

   function Toggle() {
      var temp = document.getElementById("thresholdconfig");
      if (temp.type === "password") {
         temp.type = "text";
      } else {
         temp.type = "password";
      }
   }

   var _validFileExtensions = [".png", ".jpg"];

   function validate(file) {
      if (file.type == "file") {
         var sFileName = file.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
               var sCurExtension = _validFileExtensions[j];
               if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                  var file_size = $('#gambar')[0].files[0].size;
                  if (file_size > 1000000) {
                     alert("Maaf. File Terlalu Besar ! Maksimal Upload 1 MB");
                     break;
                  } else {
                     blnValid = true;
                     break;
                  }
               }
            }

            if (!blnValid) {
               alert("Maaf Hanya Boleh File yang Berextensi : " + _validFileExtensions.join(", "));
               file.value = "";
               return false;
            }
         }
      }
      return true;
   }

   CKEDITOR.replace('editor-custom', {
      toolbar: [{
            name: 'clipboard',
            groups: ['clipboard', 'undo'],
            items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
         },
         {
            name: 'forms',
            items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField']
         },
         {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup'],
            items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
         },
         {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', ]
         },
         {
            name: 'styles',
            items: ['Format', 'Font', 'FontSize']
         },
         {
            name: 'tools',
            items: ['Maximize', 'ShowBlocks']
         },
      ]
   });
</script>

</body>

</html>
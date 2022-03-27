<script type="text/javascript">

       <?php if ($message = Session::get('flashy__info')) : ?>
              flashy('<?php echo " $message" ?>', {
                     type: 'flashy__info'
              });
       <?php endif ?>

       <?php if ($message = Session::get('flashy__warning')) : ?>
              flashy('<?php echo " $message" ?>', {
                     type: 'flashy__warning'
              });
       <?php endif ?>

       <?php if ($message = Session::get('flashy__danger')) : ?>
              flashy('<?php echo " $message" ?>', {
                     type: 'flashy__danger'
              });
       <?php endif ?>

       <?php if ($message = Session::get('flashy__success')) : ?>
              flashy('<?php echo " $message" ?>', {
                     type: 'flashy__success'
              });
       <?php endif ?>
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
<!-- <script src="<?= JSPATH ?>jquery.min.js"></script> -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

<script src="<?= JSPATH ?>jquery.slimscroll.min.js"></script>
<script type="text/javascript">
    $(".alert").delay(300).addClass("in").fadeOut(3500);

    $('.list-group-item.welcome').slimScroll({
        height: '90px',
        alwaysVisible: false,
        railVisible: true,
    });

</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <h4>Data : </h4><?php echo $t2;?>
    <form action="<?php echo route("test");?>" class="role" method="post" enctype="multipart/form-data">
        <?php echo _csrf(); ?>
        <input type="text" class="name" name="name" id="">
        <input type="submit" class="btn" value="submit">
    </form>

</body>
</html>
<script>
    // $('.btn').click(function(){
    //     // alert($('.name').val());
    //     $.ajax({
    //         type: 'get',
    //         url: 'http://localhost/php-mvc-framework/test',
    //         data: {'name':$('.name').val()},
    //         dataType: 'JSON',
    //         success: function(data) {
    //             console.log(data);
    //         }
    //     });
    // });
</script>
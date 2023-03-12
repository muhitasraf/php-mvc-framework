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
    
    <h1><?php echo $t2; ?></h1>
    <form action="" >
        <input type="text" class="name" name="name" id="">
        <input type="button" class="btn" value="submit">
    </form>

</body>
</html>
<script>
    $('.btn').click(function(){
        // alert($('.name').val());
        $.ajax({
            type: 'get',
            url: 'http://localhost/php-mvc-framework/test',
            data: {'name':$('.name').val()},
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                
            }
        });
    });
</script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="load()"> 
    <h1>Test page at: <? echo date("Y-m-d h:i:s"); ?></h1>
</body> 
</html>


<script type="text/javascript">
function load()
{
setTimeout("window.location.reload(true)", 5000);
}
</script>
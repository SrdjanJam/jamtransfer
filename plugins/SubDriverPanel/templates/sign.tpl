<!-- visak botun za natrag
<small style="font-size:2em; margin-left:2em">
	<a href="index.php?p=details&id=<?= $_REQUEST['id']?>">
		<i class="fa fa-navicon"></i>
	</a>
</small>
-->

<style>
body {
	padding: 0 !important;
	text-align: center;
}
#PaxName {
	display: block;
	width: 100%;
	position: fixed;
	top: 50%; left: 50%;
	transform: translate(-50%,-50%);
	font-weight: bolder;
}
</style>


<div>
	<img src="{$ROOT_HOME}i/logo_horN.png" width="250px">
	<br>
	<span id="PaxName" style="font-size: {$size}em;">{$paxname}</span>
</div>

<script>
	document.getElementsByClassName("navbar")[0].style.display = "none";
</script>


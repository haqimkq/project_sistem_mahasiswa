<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<style>
	@import url("https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600&display=swap");
	* {
		box-sizing: border-box;
		font-family: "Inter", sans-serif;
		padding: 0;
		color: #27374d;
		line-height: 1 !important;
		margin: 0;
	}
	.box{
		width: 100%;
		position: absolute;
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.inner>img{
		margin-top: 3em;
	}
	.inner{
		text-align: center;
	}
	.inner>h1{
		color: #0C356A;
		font-size: 3em;
		margin-bottom: 0.3em;
	}
</style>
<div class="box">
	<div class="inner">
		<h1>Restricted Access</h1>
		<p>Opss, sorry you don't have access to this page. Please <a href="#" onclick="history.back()">go back</a>.</p>
		<img src="<?php echo config_item('base_url()')?>/ijazah/assets/404.png" alt="illustration" width="300">
	</div>
</div>
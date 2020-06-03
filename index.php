<?php

$base = './../notes/';
$file = isset( $_GET['file'] ) ? $_GET['file'] : NULL;
$local = $base . $file .'.md';
$subject = $content = NULL;

if( file_exists( $local ) ){

	require_once 'Parsedown.php';

	$Parsedown = new Parsedown();
	$source = file_get_contents( $local, FILE_USE_INCLUDE_PATH);

	$content = $Parsedown->text($source);
	$content = str_replace( '<table>', '<table class="table table-striped">', $content );

	preg_match( '/<h1>(.+?)<\/h1>/', $content, $match );

	$subject = $match[1];

}

?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title><?php echo $subject ? $subject: 'Markdown Reading'; ?> - 开发笔记文档</title>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<style>
		address {
			margin-bottom: 20px;
			font-style: normal;
			line-height: 1.42857143
		}

		code,kbd,pre,samp {
			font-family: Menlo,Monaco,Consolas,"Courier New",monospace
		}

		code {
			padding: 2px 4px;
			font-size: 90%;
			color: #c7254e;
			background-color: #f9f2f4;
			border-radius: 4px
		}

		kbd {
			padding: 2px 4px;
			font-size: 90%;
			color: #fff;
			background-color: #333;
			border-radius: 3px;
			-webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.25);
			box-shadow: inset 0 -1px 0 rgba(0,0,0,.25)
		}

		kbd kbd {
			padding: 0;
			font-size: 100%;
			font-weight: 700;
			-webkit-box-shadow: none;
			box-shadow: none
		}

		pre {
			display: block;
			padding: 9.5px;
			margin: 0 0 10px;
			font-size: 0.85rem;
			line-height: 1.42857143;
			color: #333;
			word-break: break-all;
			word-wrap: break-word;
			background-color: #f5f5f5;
			border: 1px solid #ccc;
			border-radius: 4px
		}

		pre code {
			padding: 0;
			font-size: inherit;
			color: inherit;
			white-space: pre-wrap;
			background-color: transparent;
			border-radius: 0
		}

		.catalog{}

		.content{}
			.content h1{ margin-bottom: 2rem; }
			.content h2{ margin: 1.5rem 0; font-size: 1.8rem; padding-left: 10px; padding-right: 10px; display: inline-block; box-shadow: inset 0 -8px 0 #b0d3ff; }
			.content h3{ margin: 1rem 0; font-size: 1.5rem; }
			.content h4{ margin: 0.8rem 0; font-size: 1.2rem; }
			.content h5{ margin: 0.5rem 0; }
			.content img{ max-width:100%; }
			
		footer .shape{ position:fixed; bottom:50px; right:30px; text-align:center; font-size:16px; line-height:40px; }
			footer .shape a{ width:40px; padding:0; color:#FFF!important; background:#DDD; border-radius:50%; margin-bottom: 1rem; font-weight:normal; cursor:pointer; display: inline-block; transition:all .3s; }
			footer .shape a:hover{ background:#CCC; transform:scale(1.3,1.3);}

			footer .shape a.search{ display:none; }

			footer .shape a.gotop{ transform:rotate(90deg); display:none; }
			footer .shape a.gotop:hover{ transform:rotate(90deg) scale(1.3,1.3);}

	</style>
</head>
<body>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">在线实用小工具</a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo $file .'.md';?></li>
	</ol>
</nav>

<div class="my-3 mx-3"></div>

<div class="container" id="app">

	<div class="catalog">
		
	<?php
	$list = glob( $base.'*.md' );
	foreach( $list as $k => $v ){
		echo '<a class="btn btn-sm m-1 '. ( basename($v, '.md') == $file ? 'btn-secondary' : 'btn-light' ) .'" href="'. basename( $v ) .'" role="button">'. basename($v, '.md') .'</a>';
	}
	?>

	</div>

	<!-- 网文精选_自适应 -->
	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7104481011578148" data-ad-slot="7430051000" data-ad-format="auto" data-full-width-responsive="true"></ins>
	<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>

	<hr />

	<div class="content">

	<?php if( $content ): ?>
		
		<?php echo $content; ?>
		
		<hr />
		
		<div class="page-footer">
			<small class="pull-right">最后更新：<?php echo date('Y/m/d H:i:s', filemtime( $local ) );?></small>
		</div>
		
	<?php else: ?>
		
		<div class="page-header">
			<h1>Markdown</h1>
		</div>	  
		<p>Stay Hungry. Stay Foolish.</p>
		
	<?php endif; ?>

	<!-- 网文精选_自适应 -->
	<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7104481011578148" data-ad-slot="7430051000" data-ad-format="auto" data-full-width-responsive="true"></ins>
	<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>

	</div>

</div>

<hr />
<footer>
	<div class="shape">
		<a class="search">Q</a>
		<a class="gotop">&#10094;</a>
	</div>
	<p class="text-center"><i>Powered by <a href="http://www.veryide.com/" target="_blank">VeryIDE</a></i></p>
</footer>

<script src="/project/app.js"></script>

</body>
</html>
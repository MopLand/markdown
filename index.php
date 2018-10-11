<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<meta charset="UTF-8">
	<title>Markdown Reading</title>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/4.1.1/css/bootstrap.min.css">
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

	</style>
</head>
<body>

<?php
$base = './../notes/';
$file = isset( $_GET['file'] ) ? $_GET['file'] : NULL;
$local = $base . $file .'.md';
?>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/">在线实用小工具</a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo $file .'.md';?></li>
	</ol>
</nav>

<div class="my-3 mx-3"></div>

<div class="container" id="app">
		
	<?php
	$list = glob( $base.'*.md' );
	foreach( $list as $k => $v ){
		echo '<a class="btn btn-sm m-1 '. ( basename($v, '.md') == $file ? 'btn-secondary' : 'btn-outline-secondary' ) .'" href="'. basename( $v ) .'" role="button">'. basename($v, '.md') .'</a>';
	}
	?>

	<hr />

	<?php if( file_exists( $local ) ): ?>
		
		<?php
			require_once 'Parsedown.php';
			$Parsedown = new Parsedown();
			$source = file_get_contents( $local, FILE_USE_INCLUDE_PATH);
			echo $Parsedown->text($source);
		?>
		
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

</div>

<hr />
<footer>
	<p class="text-center"><i>Powered by <a href="http://www.veryide.com/" target="_blank">VeryIDE</a></i></p>
</footer>

<script src="./project/app.js"></script>

</body>
</html>
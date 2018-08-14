<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<meta charset="UTF-8">
	<title>Markdown Reading</title>
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
	<script src="//cdn.bootcss.com/vue/2.3.4/vue.min.js"></script>
	<style>
	@media (min-width: 992px){
		.open{
			display: none;
		}
	}
	@media (max-width: 992px){	
		.open{
			float: right;
			font-size: 26px;
			vertical-align: middle;
			line-height: 28px;
			margin: 8px 10px;			
			text-decoration: none!important;
			color: #444;
			outline: none;
		}	
	}
	</style>
</head>
<body>

<?php
$base = './../notes/';
$list = glob( $base.'*.md' );
$file = isset( $_GET['file'] ) ? $_GET['file'] : NULL;
$local = $base . $file .'.md';
?>

<div class="container" id="app">

	<div class="row">
	
	  <div class="col-md-2">	  
		<div class="page-header">
		  <a class="open" v-on:click="toggle()">&#9776;</a>
		  <h1>Catalog</h1>
		</div>		
		<div class="list-group" v-if="status">
		  <?php foreach ($list as $item) { ?>
		  <a href="<?php echo basename($item);?>" class="list-group-item <?php echo basename($item, '.md') == $file ? 'active' : NULL;?>"><?php echo basename($item, '.md');?></a>
		  <?php } ?>
		</div>  
	  </div>
	  
	  <div class="col-md-10">
		  
		<?php if( file_exists( $local ) ): ?>
			
			<div class="page-header">
			  <h1><?php echo $file;?>.md</h1>
			</div>
			
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
	</div>
</div>

<script>	
var catlog = new Vue({
	el : '#app',
	delimiters: ['${', '}'],
	data : {
		status : ( window.innerWidth >= 992 )
	},
	methods : {
		toggle : function(){
			this.status = 1 - this.status;
			console.log( this.status );
		}
	}
});
</script>

<hr />
<footer>
	<p class="text-center"><i>Powered by <a href="http://www.veryide.com/" target="_blank">VeryIDE</a></i></p>
</footer>

</body>
</html>
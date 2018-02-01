<body class="app">
	<div id="loader">
		<div class="spinner"></div>
	</div>
	<script type="text/javascript">
	window.addEventListener('load', () => {
	       const loader = document.getElementById('loader');
	       setTimeout(() => {
	         loader.classList.add('fadeOut');
	       }, 300);
	     });
	</script>
	<div class="peers ai-s fxw-nw h-100vh">
		<div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url(<?=base_url('public/theme/adminator/colorlib.com/polygon/adminator/assets/static/images/bg.jpg')?>)">
			<div class="pos-a centerXY">
				<div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px"><img alt="" class="pos-a centerXY" src="<?=base_url('public/theme/adminator/colorlib.com/polygon/adminator/assets/static/images/logo.png')?>"></div>
			</div>
		</div>
		<div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
			<h4 class="fw-300 c-grey-900 mB-40">AGapp beta-1.0</h4>
			<?php if (isNotification()): ?>
				<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Error!</strong> <?=notificationMessage()?>
				</div>
			<?php endif; ?>
			<form method="post" action="<?=site_url('app/auth_in')?>">
				<div class="form-group">
					<label class="text-normal text-dark">Username</label><input class="form-control" name="username" placeholder="Username" type="text">
				</div>
				<div class="form-group">
					<label class="text-normal text-dark">Password</label><input class="form-control" name="password" placeholder="Password" type="password">
				</div>
				<div class="form-group">
					<div class="peers ai-c jc-sb fxw-nw">
						<div class="peer">

						</div>
						<div class="peer">
							<button class="btn btn-primary">Login</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

<div class="container sm:px-10">
	<div class="block xl:grid grid-cols-2 gap-4">
		<!-- BEGIN: Login Info -->
		<div class="hidden xl:flex flex-col min-h-screen">
			<a href="" class="-intro-x flex items-center pt-5">
				<span class="text-white text-lg ml-3"> <?php echo ProjectName; ?> </span>
			</a>
			<div class="my-auto">
				<img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16"
					 src="<?php echo assets_url("images/illustration.svg") ?>">
				<div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
					<?php echo ProjectName ?>
					<br>
					[[SIGNIN_TO_ACCOUNT]]
				</div>
				<div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
					[[EASE_TO_MANAGE_BUSINESSS]]
				</div>
			</div>
		</div>
		<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
			<form method="post" class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
				<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
					[[SIGN_IN]]
				</h2>
				<div class="intro-x mt-2 text-slate-400 xl:hidden text-center">
					<?php echo ProjectName ?> [[SIGNIN_TO_ACCOUNT]] <br> [[EASE_TO_MANAGE_BUSINESSS]]
				</div>
				<div class="intro-x mt-8">
					<input name="username" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email">
					<input name="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password">
				</div>
				<div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
					<button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">[[SIGN_IN]]</button>
				</div>
			</form>
		</div>
	</div>
</div>

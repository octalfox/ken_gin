<div class="lang_changer cursor-pointer shadow-md fixed bottom-0 right-0 box border flex items-center justify-center p-1 z-50 mb-10 mr-10 p-0">
	<a <?php echo $_SESSION['language'] == 'en'? ' class="selected_lang bg-primary" ' : "" ; ?> href="<?php echo $_SESSION['language'] == 'en'? "javascript:;" : base_url("language/change/en") ?>">English</a>
	&nbsp;
	<a <?php echo $_SESSION['language'] == 'si_cn'? ' class="selected_lang bg-primary" ' : "" ; ?> href="<?php echo $_SESSION['language'] == 'si_cn'? "javascript:;" : base_url("language/change/si_cn") ?>">中文</a>
	&nbsp;
</div>

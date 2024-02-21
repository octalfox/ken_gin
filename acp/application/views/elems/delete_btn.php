<a href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-<?php echo $id ?>" class="flex items-center">
	<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
		 stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
		 icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1">
		<polyline points="3 6 5 6 21 6"></polyline>
		<path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
		<line x1="10" y1="11" x2="10" y2="17"></line>
		<line x1="14" y1="11" x2="14" y2="17"></line>
	</svg>
</a>

<div id="delete-modal-<?php echo $id ?>" class="modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="p-5 text-center"> <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
					<div class="text-3xl mt-5">[[LABEL_SURE]]?</div>
					<div class="text-slate-500 mt-2">
						[[LABEL_UNDO_NOT_POSSIBLE]]
					</div>
				</div>
				<div class="px-5 pb-8 text-center">
					<button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">[[CANCEL]]</button>
					<a href="<?php echo $link; ?>">
						<button type="button" class="btn btn-danger w-24">[[DELETE]]</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

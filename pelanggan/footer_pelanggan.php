</main>

<footer class="mt-10 border-t border-slate-200 dark:border-slate-700 bg-white/95 dark:bg-slate-800/95 backdrop-blur">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
		<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
			<div>
				<p class="text-sm font-semibold text-slate-900 dark:text-white">MR Clean Laundry</p>
				<p class="text-sm text-slate-600 dark:text-slate-400">Layanan laundry cepat, rapi, nyaman.</p>
			</div>
			<p class="text-sm text-slate-600 dark:text-slate-400">
				&copy; <span id="tahun"></span> All Rights Reserved.
			</p>
		</div>
	</div>
</footer>
</div>

<script>
	var now = new Date();
	var tahun = now.getFullYear();
	document.getElementById("tahun").innerHTML = tahun;
</script>

<script src="<?=url('_assets/js/rumah_laundry.js')?>"></script>
</body>
</html>

</main>

<footer class="mt-12 border-t border-slate-200/80 dark:border-slate-800 bg-white/80 dark:bg-slate-950/70 backdrop-blur">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
		<div class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white/90 dark:bg-slate-900/80 px-5 py-4 shadow-soft">
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

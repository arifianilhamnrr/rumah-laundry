<!-- Clean Footer -->
<footer class="bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700 mt-auto">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
		<p class="text-center text-sm text-slate-600 dark:text-slate-400">
			&copy; <span id="tahun"></span> MR Clean Laundry. All Rights Reserved.
		</p>
	</div>
</footer>

<script>
	var now = new Date();
	var tahun = now.getFullYear();
	document.getElementById("tahun").innerHTML = tahun;
</script>

<script src="<?=url('_assets/js/rumah_laundry.js')?>"></script>
</body>
</html>

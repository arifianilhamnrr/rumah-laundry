	<!-- Clean Minimalist Footer -->
	<footer class="mt-auto py-4 px-6 border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
		<p class="text-center text-sm text-slate-600 dark:text-slate-400">
			&copy; <span id="tahun"></span> MR Clean Laundry. All Rights Reserved.
		</p>
	</footer>

	<script>
		document.getElementById("tahun").innerHTML = new Date().getFullYear();
	</script>
	<script src="<?=url('_assets/js/rumah_laundry.js')?>"></script>
</body>
</html>
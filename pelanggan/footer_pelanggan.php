<footer>
		<p>&copy; <span id="tahun"></span> MR Clean Laundry. All Rights Reserved.</p>
		<script>
		var now = new Date();
		var tahun = now.getFullYear();
		document.getElementById("tahun").innerHTML = tahun;
		</script>
	</footer>

	<script src="<?=url('_assets/js/rumah_laundry.js')?>"></script>
</body>
</html>
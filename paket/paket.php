<?php require_once('../_header.php'); ?>

<!-- Main Content with Tailwind -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<div class="bg-white rounded-xl shadow-lg overflow-hidden">
		<!-- Header -->
		<div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-primary-50 to-secondary-50">
			<h2 class="text-2xl font-bold text-gray-900 flex items-center">
				<i class="fas fa-box-open text-primary-600 mr-3"></i>
				Daftar Paket Tersedia
			</h2>
			<a href="<?=url()?>" class="inline-flex items-center space-x-2 px-4 py-2 bg-white text-primary-600 rounded-lg font-semibold shadow hover:shadow-md transition-all hover:scale-105">
				<i class="fas fa-arrow-left"></i>
				<span>Kembali</span>
			</a>
		</div>

		<!-- Body -->
		<div class="p-8">
			<div class="text-center mb-8">
				<h3 class="text-xl font-semibold text-gray-800 mb-2">Pilih Jenis Paket</h3>
				<p class="text-gray-600">Kelola paket layanan laundry</p>
			</div>

			<!-- Package Cards -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
				<!-- Cuci Komplit -->
				<a href="<?=url('paket/pkt_ck/pkt_ck.php')?>" class="group">
					<div class="bg-white border-2 border-gray-200 rounded-xl p-6 text-center transition-all hover:border-primary-500 hover:shadow-xl transform hover:-translate-y-2">
						<div class="mb-4 transform group-hover:scale-110 transition-transform">
							<i class="fas fa-soap text-6xl text-primary-500"></i>
						</div>
						<h4 class="text-xl font-bold text-gray-900 mb-2">Paket Cuci Komplit</h4>
						<p class="text-sm text-gray-600 mb-4">Kelola paket cuci + setrika</p>
						<div class="inline-flex items-center space-x-2 text-primary-600 font-semibold">
							<span>Lihat Paket</span>
							<i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
						</div>
					</div>
				</a>

				<!-- Dry Clean -->
				<a href="<?=url('paket/pkt_dc/pkt_dc.php')?>" class="group">
					<div class="bg-white border-2 border-gray-200 rounded-xl p-6 text-center transition-all hover:border-purple-500 hover:shadow-xl transform hover:-translate-y-2">
						<div class="mb-4 transform group-hover:scale-110 transition-transform">
							<i class="fas fa-wind text-6xl text-purple-500"></i>
						</div>
						<h4 class="text-xl font-bold text-gray-900 mb-2">Paket Dry Clean</h4>
						<p class="text-sm text-gray-600 mb-4">Kelola paket cuci kering</p>
						<div class="inline-flex items-center space-x-2 text-purple-600 font-semibold">
							<span>Lihat Paket</span>
							<i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
						</div>
					</div>
				</a>

				<!-- Cuci Satuan -->
				<a href="<?=url('paket/pkt_cs/pkt_cs.php')?>" class="group">
					<div class="bg-white border-2 border-gray-200 rounded-xl p-6 text-center transition-all hover:border-green-500 hover:shadow-xl transform hover:-translate-y-2">
						<div class="mb-4 transform group-hover:scale-110 transition-transform">
							<i class="fas fa-tshirt text-6xl text-green-500"></i>
						</div>
						<h4 class="text-xl font-bold text-gray-900 mb-2">Paket Cuci Satuan</h4>
						<p class="text-sm text-gray-600 mb-4">Kelola paket per item</p>
						<div class="inline-flex items-center space-x-2 text-green-600 font-semibold">
							<span>Lihat Paket</span>
							<i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</main>

<?php require_once('../_footer.php'); ?>
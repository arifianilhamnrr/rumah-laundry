<!-- Clean Minimalist Sidebar Navigation -->
<aside id="sidebar" class="fixed left-0 top-16 h-[calc(100vh-4rem)] w-64 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-40">
	<nav class="h-full overflow-y-auto py-4 px-3">
		<!-- Dashboard -->
		<a href="<?=url()?>" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors mb-1">
			<i class="fas fa-home w-5 text-center"></i>
			<span class="text-sm font-medium">Dashboard</span>
		</a>

		<!-- Order Section -->
		<div class="mt-4">
			<p class="px-3 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Order</p>
			<a href="<?=url('order/order.php')?>" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors mb-1">
				<i class="fas fa-plus-circle w-5 text-center"></i>
				<span class="text-sm font-medium">Order Baru</span>
			</a>
			<a href="<?=url('riwayat_transaksi/riwayat.php')?>" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors mb-1">
				<i class="fas fa-history w-5 text-center"></i>
				<span class="text-sm font-medium">Riwayat Order</span>
			</a>
		</div>

		<!-- Management Section -->
		<div class="mt-4">
			<p class="px-3 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">Management</p>
			<a href="<?=url('karyawan/karyawan.php')?>" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors mb-1">
				<i class="fas fa-users w-5 text-center"></i>
				<span class="text-sm font-medium">Karyawan</span>
			</a>
			<a href="<?=url('admin/daftar_pelanggan.php')?>" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors mb-1">
				<i class="fas fa-user-friends w-5 text-center"></i>
				<span class="text-sm font-medium">Pelanggan</span>
			</a>
			<a href="<?=url('paket/paket.php')?>" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors mb-1">
				<i class="fas fa-box w-5 text-center"></i>
				<span class="text-sm font-medium">Paket</span>
			</a>
		</div>
	</nav>
</aside>

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 lg:hidden hidden"></div>

<!-- Mobile Menu Toggle -->
<button id="mobile-menu-toggle" class="fixed bottom-4 right-4 lg:hidden w-12 h-12 bg-primary-500 text-white rounded-full shadow-lg flex items-center justify-center z-50 hover:bg-primary-600 transition-colors">
	<i class="fas fa-bars"></i>
</button>

<!-- Main Content Wrapper -->
<div class="lg:ml-64 min-h-screen bg-slate-50 dark:bg-slate-900 transition-colors">
	<div class="pt-16">

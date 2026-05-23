<?php
	require_once('../_header.php');
	$data_karyawan = query('SELECT * FROM master LIMIT 20 OFFSET 1');
?>

<!-- Main Content with Tailwind -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
	<!-- Header Section -->
	<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
		<h2 class="text-3xl font-bold text-gray-900 flex items-center">
			<i class="fas fa-users text-primary-600 mr-3"></i>
			Management Karyawan
		</h2>
		<a href="<?=url('karyawan/tambah.php')?>" class="inline-flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
			<i class="fas fa-plus-circle"></i>
			<span>Tambah Karyawan</span>
		</a>
	</div>

	<!-- Table Card -->
	<div class="bg-white rounded-xl shadow-lg overflow-hidden">
		<!-- Card Header -->
		<div class="p-6 border-b border-gray-200 bg-gradient-to-r from-primary-50 to-secondary-50">
			<h3 class="text-xl font-bold text-gray-900 flex items-center">
				<i class="fas fa-list text-primary-600 mr-2"></i>
				Daftar Karyawan
			</h3>
		</div>

		<!-- Table -->
		<div class="overflow-x-auto">
			<table class="w-full">
				<thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
					<tr>
						<th class="px-6 py-4 text-left text-sm font-semibold">No</th>
						<th class="px-6 py-4 text-left text-sm font-semibold">Nama Karyawan</th>
						<th class="px-6 py-4 text-left text-sm font-semibold">Username</th>
						<th class="px-6 py-4 text-left text-sm font-semibold">Email</th>
						<th class="px-6 py-4 text-left text-sm font-semibold">Action</th>
					</tr>
				</thead>

				<tbody class="divide-y divide-gray-200">
					<?php $no = 1; ?>
					<?php foreach($data_karyawan as $karyawan) : ?>
						<tr class="hover:bg-gray-50 transition-colors">
							<td class="px-6 py-4 text-sm text-gray-900"><?= $no ?></td>
							<td class="px-6 py-4 text-sm font-semibold text-gray-900"><?= $karyawan['nama'] ?></td>
							<td class="px-6 py-4 text-sm text-gray-600"><?= $karyawan['username'] ?></td>
							<td class="px-6 py-4 text-sm text-gray-600"><?= $karyawan['email'] ?></td>
							<td class="px-6 py-4">
								<div class="flex space-x-2">
									<a href="<?=url('karyawan/edit.php')?>?id_user=<?=$karyawan['id_user']?>" class="inline-flex items-center space-x-1 px-3 py-1.5 bg-blue-500 text-white rounded-lg text-xs font-semibold hover:bg-blue-600 transition-colors">
										<i class="fas fa-edit"></i>
										<span>Edit</span>
									</a>
									<a href="<?=url('karyawan/hapus.php')?>?id_user=<?=$karyawan['id_user']?>" onclick="return confirm('Yakin akan menghapus?');" class="inline-flex items-center space-x-1 px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-semibold hover:bg-red-600 transition-colors">
										<i class="fas fa-trash"></i>
										<span>Hapus</span>
									</a>
								</div>
							</td>
						</tr>
						<?php $no++ ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</main>

<?php require_once('../_footer.php'); ?>
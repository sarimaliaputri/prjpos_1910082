<?= $this->extend('template/main') ?>
<?= $this->section('menu') ?>
<li class="nav-item">
    <a href="<?= site_url('layout/index') ?>" class="nav-link">
        <i class="nav-icon fas fa-home text-green"></i>
        <p>
            Home
        </p>
    </a>
</li>
<li class="nav-header">MASTER</li>
<a href="<?= site_url('barang/index') ?>" class="nav-link">
    <i class="nav-icon fas fa-th-list text-red"></i>
    <p>
        Barang
    </p>
</a>

<a href="<?= site_url('pelanggan/index') ?>" class="nav-link">
    <i class="nav-icon fas fa-users text-warning"></i>
    <p>
        Pelanggan
    </p>
</a>

<a href="<?= site_url('pemasok/index') ?>" class="nav-link">
    <i class="nav-icon fas fa-truck text-blue"></i>
    <p>
        Pemasok
    </p>
</a>
</li>

<li class="nav-header">TRANSAKSI</li>
<li class="nav-item">
    <a href="<?= site_url('barangmasuk/index') ?>" class="nav-link">
        <i class="nav-icon fa fa-arrow-circle-down text-blue"></i>
        <p>
            Barang Masuk
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?= site_url('barangkeluar/index') ?>" class="nav-link">
        <i class="nav-icon fa fa-arrow-circle-up text-warning"></i>
        <p>
            Barang Keluar
        </p>
    </a>
</li>
<?= $this->endSection() ?>
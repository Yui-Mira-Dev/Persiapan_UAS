<?php
require_once('form_code.php');
?>

<section>
    <main style="overflow: auto;">
        <section id="about">
            <div class="container text-center text-justify mt-3">
                <div class="info-list justify-content-center row row-cols-xxl-3 row-cols-xl-2 row-cols-1 mt-3">
                    <div class="col mt-3">
                        <h5>Personal Information</h5>
                        <form method="POST" action="">
                            <div class="info-list-row">
                                <div class="category">NPM</div>
                                <input type="text" name="npm" class="detail" value="<?php echo $npm; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Nama Lengkap</div>
                                <input type="text" name="nama_lengkap" class="detail" value="<?php echo $namaLengkap; ?>" />
                            </div>
                            <div class="info-list-row">
                            <div class="category">Email</div>
                                <input type="email" name="email" class="detail" value="<?php echo $email; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Tempat Lahir</div>
                                <input type="text" name="tempat_lahir" class="detail" value="<?php echo $tempatLahir; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Tanggal Lahir</div>
                                <input type="date" name="tanggal_lahir" class="detail" value="<?php echo $tanggalLahir; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Agama</div>
                                <input type="text" name="agama" class="detail" value="<?php echo $agama; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Jurusan</div>
                                <select name="jurusan" class="detail">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="Manajemen Informatika" <?php echo $jurusan === 'Manajemen Informatika' ? 'selected' : ''; ?>>Manajemen Informatika</option>
                                    <option value="Teknik Komputer" <?php echo $jurusan === 'Teknik Komputer' ? 'selected' : ''; ?>>Teknik Komputer</option>
                                    <option value="Akuntansi" <?php echo $jurusan === 'Akuntansi' ? 'selected' : ''; ?>>Akuntansi</option>
                                    <option value="Teknik Mesin" <?php echo $jurusan === 'Teknik Mesin' ? 'selected' : ''; ?>>Teknik Mesin</option>
                                    <option value="Bahasa Inggris" <?php echo $jurusan === 'Bahasa Inggris' ? 'selected' : ''; ?>>Bahasa Inggris</option>
                                </select>
                            </div>
                            <div class="info-list-row">
                                <div class="category">Angkatan</div>
                                <input type="text" name="angkatan" class="detail" value="<?php echo $angkatan; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Jenis Kelamin</div>
                                <div class="detail">
                                    <input type="radio" name="jenis_kelamin" value="Laki-Laki" <?php echo $jenisKelamin === 'Laki-Laki' ? 'checked' : ''; ?>> Laki-Laki
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo $jenisKelamin === 'Perempuan' ? 'checked' : ''; ?>> Perempuan
                                </div>
                            </div>
                            <div class="info-list-row">
                                <div class="category">Hobby</div>
                                <input type="text" name="hobby" class="detail" value="<?php echo $hobby; ?>" />
                            </div>
                            <div class="info-list-row">
                                <div class="category">Alamat</div>
                                <textarea name="alamat" class="detail"><?php echo $alamat; ?></textarea>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <input class="btn btn-primary" type="reset" value="Reset">
                                <a class="btn btn-primary" href="home">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>   
</section>
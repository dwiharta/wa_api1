<?php
session_start();
if (empty($_SESSION['auth_user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['auth_user'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - API WA</title>
<style>
*{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;background:#f4f7fb;color:#172033}
.top{background:#172033;color:#fff;padding:16px 24px;display:flex;justify-content:space-between;align-items:center}
.top a{color:#fff;text-decoration:none}.wrap{width:min(800px,92%);margin:30px auto}
.card{background:#fff;padding:30px;border-radius:18px;box-shadow:0 10px 35px #0001}
h1{margin-top:0}label{display:block;margin:14px 0 6px;font-weight:700}
input,textarea{width:100%;padding:12px;border:1px solid #ccd4e0;border-radius:9px;font:inherit}
textarea{min-height:90px;resize:vertical}.btn{padding:12px 18px;border:0;border-radius:9px;color:#fff;font-weight:700;cursor:pointer;margin-top:18px}
.save{background:#1769e0}.delete{background:#e54848}.msg{margin-top:15px;padding:12px;border-radius:9px;display:none}
</style>
</head>
<body>
<div class="top"><b>Dashboard Profil</b><a href="logout.php">Logout</a></div>
<div class="wrap"><div class="card">
<h1>Profil Pengguna</h1>
<form id="profileForm">
<label>Nama</label><input name="nama" value="<?= htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') ?>" required maxlength="100">
<label>Email</label><input name="email" type="email" value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>" required maxlength="100">
<label>No. HP / WhatsApp</label><input name="no_hp" value="<?= htmlspecialchars($user['no_hp'], ENT_QUOTES, 'UTF-8') ?>" required maxlength="20">
<label>Alamat</label><textarea name="alamat" required><?= htmlspecialchars($user['alamat'], ENT_QUOTES, 'UTF-8') ?></textarea>
<button class="btn save" type="submit">Simpan Perubahan</button>
<div id="msg" class="msg"></div>
</form>
<button class="btn delete" id="deleteBtn" type="button">Hapus Akun</button>
</div></div>
<script>
const form=document.getElementById('profileForm');
const msg=document.getElementById('msg');
const deleteBtn=document.getElementById('deleteBtn');

form.addEventListener('submit',async(e)=>{
 e.preventDefault();msg.style.display='none';
 try{
  const res=await fetch('api/update_profile.php',{method:'POST',body:new FormData(form)});
  const data=await res.json();
  msg.textContent=data.message+(data.whatsapp?' | WhatsApp: '+data.whatsapp.reason:'');
  msg.style.display='block';
  if(data.status) alert('Profil berhasil diperbarui.');
 }catch(err){msg.textContent='Terjadi kesalahan koneksi/server.';msg.style.display='block';}
});

deleteBtn.addEventListener('click',async()=>{
 if(!confirm('Yakin ingin menghapus akun ini?')) return;
 try{
  const res=await fetch('api/delete_account.php',{method:'POST'});
  const data=await res.json();
  if(data.status){
   alert('Akun berhasil dihapus.');
   location.href=data.redirect;
  }else{
   alert(data.message);
  }
 }catch(err){alert('Terjadi kesalahan koneksi/server.');}
});
</script>
</body>
</html>
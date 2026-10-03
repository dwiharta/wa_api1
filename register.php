<?php
session_start();
if (!empty($_SESSION['auth_user'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - API WA</title>
<style>
*{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;background:#f4f7fb;color:#172033}
.box{width:min(480px,92%);margin:40px auto;background:#fff;padding:30px;border-radius:18px;box-shadow:0 10px 35px #0001}
h1{margin-top:0}label{display:block;margin:14px 0 6px;font-weight:700}
input,textarea{width:100%;padding:12px;border:1px solid #ccd4e0;border-radius:9px;font:inherit}
textarea{min-height:90px;resize:vertical}button{width:100%;padding:13px;margin-top:20px;border:0;border-radius:9px;background:#1769e0;color:#fff;font-weight:700;cursor:pointer}
button:disabled{opacity:.6;cursor:not-allowed}.msg{margin-top:15px;padding:12px;border-radius:9px;display:none}.back{text-align:center;margin-top:18px}a{color:#1769e0;text-decoration:none}
</style>
</head>
<body>
<div class="box">
<h1>Registrasi</h1>
<p>Buat akun baru untuk masuk ke sistem.</p>
<form id="registerForm">
<label>Nama</label><input name="nama" required maxlength="100">
<label>Email</label><input name="email" type="email" required maxlength="100">
<label>No. HP / WhatsApp</label><input name="no_hp" required maxlength="20" placeholder="08xxxxxxxxxx">
<label>Alamat</label><textarea name="alamat" required></textarea>
<label>Password</label><input name="password" type="password" minlength="6" required>
<button id="submitBtn" type="submit">Daftar</button>
<div id="msg" class="msg"></div>
</form>
<div class="back">Sudah punya akun? <a href="login.php">Login</a></div>
</div>
<script>
const form=document.getElementById('registerForm');
const btn=document.getElementById('submitBtn');
const msg=document.getElementById('msg');

form.addEventListener('submit', async (e)=>{
 e.preventDefault();
 btn.disabled=true; btn.textContent='Memproses...';
 msg.style.display='none';

 try{
   const res=await fetch('api/register.php',{method:'POST',body:new FormData(form)});
   const data=await res.json();
   msg.textContent=data.message+(data.whatsapp ? ' | WhatsApp: '+data.whatsapp.reason : '');
   msg.style.display='block';
   if(data.status){
     alert('Registrasi berhasil.');
     location.href='login.php';
   }
 }catch(err){
   msg.textContent='Terjadi kesalahan koneksi/server.';
   msg.style.display='block';
 }finally{
   btn.disabled=false; btn.textContent='Daftar';
 }
});
</script>
</body>
</html>
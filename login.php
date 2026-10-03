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
<title>Login - API WA</title>
<style>
*{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;background:#f4f7fb;color:#172033}
.box{width:min(420px,92%);margin:70px auto;background:#fff;padding:30px;border-radius:18px;box-shadow:0 10px 35px #0001}
h1{margin-top:0}label{display:block;margin:14px 0 6px;font-weight:700}
input{width:100%;padding:12px;border:1px solid #ccd4e0;border-radius:9px;font:inherit}
button{width:100%;padding:13px;margin-top:20px;border:0;border-radius:9px;background:#1769e0;color:#fff;font-weight:700;cursor:pointer}
button:disabled{opacity:.6}.msg{margin-top:15px;padding:12px;border-radius:9px;display:none}a{color:#1769e0;text-decoration:none}
</style>
</head>
<body>
<div class="box">
<h1>Login</h1>
<p>Masuk ke akun kamu.</p>
<form id="loginForm">
<label>Email</label><input name="email" type="email" required>
<label>Password</label><input name="password" type="password" required>
<button id="submitBtn" type="submit">Login</button>
<div id="msg" class="msg"></div>
</form>
<p>Belum punya akun? <a href="register.php">Register</a></p>
</div>
<script>
const form=document.getElementById('loginForm');
const btn=document.getElementById('submitBtn');
const msg=document.getElementById('msg');

form.addEventListener('submit',async(e)=>{
 e.preventDefault();btn.disabled=true;btn.textContent='Memproses...';msg.style.display='none';
 try{
   const res=await fetch('api/login.php',{method:'POST',body:new FormData(form)});
   const data=await res.json();
   if(data.status){location.href=data.redirect;}
   else{msg.textContent=data.message;msg.style.display='block';}
 }catch(err){msg.textContent='Terjadi kesalahan koneksi/server.';msg.style.display='block';}
 finally{btn.disabled=false;btn.textContent='Login';}
});
</script>
</body>
</html>
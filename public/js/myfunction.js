function Check(value){
    const el = document.getElementById('password');
    if(value.checked){
        el.style.display = 'block';
        el.innerHTML += '<label>Password</label>';
        el.innerHTML += '<input type="password" name="password" required/>';
    }else{
        el.style.display = 'none';
        el.innerHTML='';
    }
}

function Check(value){
    const el = document.getElementById('password');
    if(value.checked){
        el.style.display = 'block';
        el.innerHTML += '<label>Password</label>';
        el.innerHTML += '<input type="password" id="txtNewPassword" name="password" />';
        el.innerHTML += '<label>Confirm Password</label>&nbsp;<span class="registrationFormAlert" id="CheckPasswordMatch">';
        el.innerHTML += '<input type="password" id="txtConfirmPassword" name="confpass" />';        

        function checkPasswordMatch() {
            var password = $("#txtNewPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword)
                $("#CheckPasswordMatch").html("(Password do not match!)").css('color', 'red');
            else
                $("#CheckPasswordMatch").html("(Password matches!)").css('color', 'blue');
        }
        $(document).ready(function() {
            $("#txtConfirmPassword").keyup(checkPasswordMatch);
        });
    }else{
        el.style.display = 'none';
        el.innerHTML='';
    }
}

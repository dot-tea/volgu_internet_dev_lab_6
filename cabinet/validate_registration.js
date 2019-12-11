function validateRegistration() {
    
    var there_are_empty_fields = false;
    var there_are_invalid_fields = false;
    var password_is_unsafe = false;
	var empty_fields = "";
    var invalid_fields = "";
    var safety_measures = "";
    
    var first_name = document.forms['registration_form']['first_name'].value;
    var first_name_pattern = /^[а-яА-ЯёЁ\-]+$/gi;
    if (!first_name_pattern.test(first_name)) {
        if ('' === first_name) {
            empty_fields += "* Имя\n";
            there_are_empty_fields = true;
        }
        else {
            invalid_fields += "* Имя\n";
            there_are_invalid_fields = true;
        }
    }
        
    var middle_name = document.forms['registration_form']['middle_name'].value;
    var middle_name_pattern = /^[а-яА-ЯёЁ\-]+$/gi;
    if ('' !== middle_name && !middle_name_pattern.test(middle_name)) {
        invalid_fields += "* Отчество\n";
        there_are_invalid_fields = true;
    }
        
    var last_name = document.forms['registration_form']['last_name'].value;
    var last_name_pattern = /^[а-яА-ЯёЁ\-]+$/gi;
    if (!last_name_pattern.test(last_name)) {
        if ('' === last_name) {
            empty_fields += "* Фамилия\n";
            there_are_empty_fields = true;
        }
        else {
            invalid_fields += "* Фамилия\n";
            there_are_invalid_fields = true;
        }
    }
    var email = document.forms['registration_form']['email'].value;
    var email_pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!email_pattern.test(email)) {
        if ("" === email) {
            empty_fields += "* Электронная почта\n";
            there_are_empty_fields = true;
        }
        else {
            invalid_fields += "* Электронная почта\n";
            there_are_invalid_fields = true;
        }
    }
    
    var phone_number = document.forms['registration_form']['phone_number'].value;
    var phone_number_pattern = /^\+7\d{10}$/;
    if (!phone_number_pattern.test(phone_number)) {
        if ("" === phone_number) {
            empty_fields += "* Номер телефона\n";
            there_are_empty_fields = true;
        }
        else {
            invalid_fields += "* Номер телефона\n";
            there_are_invalid_fields = true;
        }
    }
    
    var workplace = document.forms['registration_form']['workplace'].value;
    var workplace_pattern = /^[а-яА-ЯёЁa-zA-Z0-9 \-]+$/i;
    if ("" !== workplace && !workplace_pattern.test(workplace)) {
        invalid_fields += "* Место работы\n";
        there_are_invalid_fields = true;
    }
    
    var position = document.forms['registration_form']['position'].value;
    var position_pattern = /^[а-яА-ЯёЁa-zA-Z0-9 \-]+$/i;
    if ("" !== position && !position_pattern.test(position)) {
        invalid_fields += "* Должность\n";
        there_are_invalid_fields = true;
    }

    var login = document.forms['registration_form']['login'].value;
    var login_pattern = /^(?!_)(?!.*_{2})\w+(?<![_.])$/;
    if (!login_pattern.test(login)) {
        if ("" === login) {
            empty_fields += "* Логин\n";
            there_are_empty_fields = true;
        }
        else {
            invalid_fields += "* Логин (должен состоять только из английских букв/цифр/_)\n";
            there_are_invalid_fields = true;
        }
    }
    
    var password = document.forms['registration_form']['password'].value;
    var password_pattern = /^\w+$/;
    if (!password_pattern.test(password)) {
        if ("" === password) {
            empty_fields += "* Пароль\n";
            there_are_empty_fields = true;
        }
        else {
            invalid_fields += "* Пароль (допустимые символы: A-Z, a-z, 0-9, _)\n";
            there_are_invalid_fields = true;
        }
    }
    else {
        //Check if password is safe enough:
        if (password === login) {
            safety_measures += "* Пароль не должен совпадать с логином!\n";
            password_is_unsafe = true;
        }
        var capital_letters = /[A-Z]+/;
        if (!capital_letters.test(password)) {
            safety_measures += "* Добавьте в пароль заглавные буквы\n";
            password_is_unsafe = true;
        }
        var lowercase_letters = /[a-z]+/;
        if (!lowercase_letters.test(password)) {
            safety_measures += "* Добавьте в пароль строчные буквы\n";
            password_is_unsafe = true;
        }
        var numbers = /[0-9]+/;
        if (!numbers.test(password)) {
            safety_measures += "* Добавьте в пароль цифры\n";
            password_is_unsafe = true;
        }
        var min_length = 8;
        if (password.length < 8) {
            safety_measures += "* Пароль должен быть длиной не менее 8 символов\n";
            password_is_unsafe = true;
        }
    }

    if (there_are_empty_fields || there_are_invalid_fields || password_is_unsafe) {
        var errmessage = "";
        if (there_are_empty_fields)
            errmessage += "Заполните следующие поля:\n" + empty_fields;
        if (there_are_invalid_fields)
            errmessage += "Исправьте следующие поля\n" + invalid_fields;
        if (password_is_unsafe)
            errmessage += "Пароль небезопасен\n" + safety_measures;
        alert(errmessage);
        return false;
    }

    var confirm_password = document.forms['registration_form']['confirm_password'].value;
    if (confirm_password !== password) {
        alert("Пароли не совпадают! Убедитесь, что вы ввели его правильно.");
        document.forms['registration_form']['confirm_password'].value = "";
        return false;
    }
    return true; 
}
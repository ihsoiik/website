function validatePassword(event) {
    var password = document.getElementById('password').value;
    var regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{10,}$/;
    if (!regex.test(password)) {
        alert('The password length must be no less than 2 and no more than 50');
        event.preventDefault(); // Остановка отправки формы при невалидном пароле
    }
}

document.querySelector('form').addEventListener('submit', validatePassword);

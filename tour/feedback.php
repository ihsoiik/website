<form id="mailForm"> 
    <input type="text" id="email" name="email" placeholder="Email" >
    <input type="text" id="name" name="name" placeholder="Вdедите имя" >
    <input type="text" id="phone" name="phone" placeholder="Введите номер телефона" >
    <textarea type="text" id="message" name="message" placeholder="Введите сообщение" ></textarea>
    <button tupe="button" id="sendMail" name="button">Отправить</button>
</form>
<div id="errorMess"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/formMail.js"></script>
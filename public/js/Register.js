document.addEventListener("DOMContentLoaded", function () {
    let phoneInput = document.getElementById("phone");
    let alertMsg = document.getElementById("phone-alert");

    if (phoneInput) {
        phoneInput.addEventListener("input", function () {
            alertMsg.style.display = this.value.length > 0 ? "block" : "none";
        });
    }
});


document.getElementById("phone").addEventListener("input", function (e) {
    this.value = this.value.replace(/\D/g, ''); 
    let alertMsg = document.getElementById("phone-alert");
    alertMsg.style.display = this.value.length > 0 ? "block" : "none";
});


document.addEventListener("DOMContentLoaded", function () {
    const phoneInput = document.querySelector(".PhoneInputInput");

    phoneInput.addEventListener("input", function (event) {
        let value = phoneInput.value.replace(/\D/g, ""); // Hanya angka
        if (!value.startsWith("62")) {
            value = "62" + value; // Pastikan tetap menggunakan +62
        }
        phoneInput.value = "+" + value;
    });

    phoneInput.addEventListener("keypress", function (event) {
        if (!/[0-9]/.test(event.key)) {
            event.preventDefault(); // Cegah input selain angka
        }
    });
});

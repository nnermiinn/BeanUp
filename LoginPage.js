formBox.addEventListener("submit", function(e){
    e.preventDefault(); 

    const emailInput = formBox.querySelector('input[type="email"]');
    const passwordInput = formBox.querySelector('input[type="password"]');
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    if(email === "" || password === ""){
        alert("Ju lutem plotësoni të gjitha fushat.");
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailRegex.test(email)){
        alert("Ju lutem shkruani një email të vlefshëm.");
        return;
    }

    const users = [
        {email: "test@example.com", password: "123456"},
        {email: "user@example.com", password: "password"}
    ];

    const user = users.find(u => u.email === email && u.password === password);

    if(user){
        window.location.href = "home.html";
    } else {
        alert("Email ose password është gabim.");
    }
});

const form = document.getElementById("loginForm");

form.addEventListener("submit", function(e){
    const emailInput = form.querySelector('input[type="email"]');
    const passwordInput = form.querySelector('input[type="password"]');

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    if(email === "" || password === ""){
        alert("Ju lutem plotësoni të gjitha fushat.");
        e.preventDefault();
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.(com|net|org)$/;
    if(!emailRegex.test(email)){
        alert("Email duhet të përfundojë me .com, .net ose .org");
        e.preventDefault();
        return;
    }
});

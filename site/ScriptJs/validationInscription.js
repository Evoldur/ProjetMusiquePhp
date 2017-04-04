var password;

function highlight(input, error)
{
    if(error)
        input.style.backgroundColor = "#fba";
    else
        input.style.backgroundColor = "";
}

function checkName(input)
{
    var text = document.getElementById("nomError");
    if( (input.value.length < 3 && input.value.length >= 1) || input.value.length > 25)
    {
        highlight(input, true);
        text.style.color = '#f00';
        text.textContent = "Erreur !";
        return false;
    }
    else
    {
        highlight(input, false);
        text.textContent = "";
        return true;
    }


}


function checkMail(input)
{
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    var text = document.getElementById("emailError");
    if(regex.test(input.value) || input.value.length ==0)
    {
        highlight(input, false);
        text.textContent = "";
        return true;
    }

    else
    {
        highlight(input, true);
        text.style.color = '#f00';
        text.textContent = "Erreur : Email invalide";
        return false;


    }
}

function checkAge(champ)
{
    var regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
    var text = document.getElementById("ddnError");
    if(regex.test(champ.value)|| champ.value.length ==0) {

        highlight(champ, false);
        text.style.color = '#f00';
        text.textContent = "";
        return true;
    }
    else
    {
        highlight(champ, true);
        text.style.color = '#f00';
        text.textContent = "Erreur => Format : dd/mm/aaaa";
        return false;


    }
}

function checkForm(f)
{
    var firstnameOk = checkName(f.nom);
    var lastnameOk = checkName(f.prenom);
    var ageOk = checkAge(f.birthday);
    var mailOk = checkMail(f.email);


    if(firstnameOk && lastnameOk && mailOk && ageOk)
        document.getElementsByName("submitbutton").type = "submit";
    else
    {
        alert("Veuillez remplir correctement tous les champs");
        document.getElementsByName("submitbutton").type = "hidden";
    }


}

function checkFirstname(input) {
    var text = document.getElementById("prenomError");
    if ((input.value.length < 3 && input.value.length >= 1) || input.value.length > 25) {
        highlight(input, true);
        text.style.color = '#f00';
        text.textContent = "Erreur !";
        return false;
    }
    else {
        highlight(input, false);
        text.textContent = "";
        return true;
    }
}

    function checkPassword(input) {
        var text = document.getElementById("pswError");
        if ((input.value.length < 3 && input.value.length >= 1) || input.value.length > 25) {
            highlight(input, true);
            text.style.color = '#f00';
            text.textContent = "Erreur !";
            return false;
        }
        else {
            highlight(input, false);
            text.textContent = "";
            password = input.value;
            return true;
        }
    }

        function checkPasswordConfirm(input)
        {
            var text = document.getElementById("pswconfirmError");
            if(password != input.value)
            {
                highlight(input, true);
                text.style.color = '#f00';
                text.textContent = "Erreur !";
                return false;
            }
            else
            {
                highlight(input, false);
                text.textContent = "";
                return true;
            }


        }


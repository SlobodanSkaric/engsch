let btnSnedPhone = document.getElementById("sendphone");


btnSnedPhone.addEventListener("click", () =>{
    let phone = document.getElementById("phonenumber").value;
    let person = document.getElementById("person").value;
    if(checkPhone(phone)){
       fetch("/engsch/user/studentapi/" + person, {credentials: "include"})
            .then(result => result.json())
            .then(data => {
                console.log(data.student);
            });
    }else{
        alert("Phone number is not valid");
    }
});


function checkPhone(phoneNumber){
    let patern = /^[0-9][0-9]{6,17}$/; // implement exc +381

    if(phoneNumber.match(patern)){
        return true;
    }else{
        return false;
    }
}

function addPhoneNumber($id, $phonenumber){
    fetech("/engsch/user/phonestudentapi/" + )
}
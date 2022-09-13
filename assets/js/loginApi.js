let btnSnedPhone = document.getElementById("sendphone");
let red = document.getElementById("red");


btnSnedPhone.addEventListener("click", () =>{
    let phone = document.getElementById("phonenumber").value;
    let person = document.getElementById("person").value;
    
    if(checkPhone(phone)){
        fetch("/engsch/user/studentapi/" + person, {credentials: "include"})
            .then(result => result.json())
            .then(data => {
                addPhoneNumber(person,phone);
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

async function addPhoneNumber(id, phonenumber){
    fetch("/engsch/user/phonestudentapi/" + id + "/" + phonenumber, {credentials: "include"})
        .then(result => result.json())
        .then(data => {
            checkUpdate(data);
        });
}

function checkUpdate(data){
    if(data.student == "update"){
                    let alertPoneUpdate = document.getElementById("update");
                    alertPoneUpdate.classList.remove("phoneupdate");
                    alertPoneUpdate.classList.add("phoneupdateset");
    }
}

red.addEventListener("click", ()=>{
    
    let person = document.getElementById("person").value;
    window.location.replace("/engsch/user/studentprofiles/" + person);
});
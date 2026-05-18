function res_val(){

    let name = document.getElementById("name").value;
    let location = document.getElementById("location").value;
    let area = document.getElementById("area").value;
    let short_background = document.getElementById("short_background").value;
    let goals = document.getElementById("goals").value;

    let msg = document.getElementById("msg");

    if(name == ""){
        msg.innerHTML = "Restaurant name required!";
        return false;
    }

    else if(location == ""){
        msg.innerHTML = "Location required!";
        return false;
    }

    else if(area == ""){
        msg.innerHTML = "Area required!";
        return false;
    }

    else if(short_background == ""){
        msg.innerHTML = "Short background required!";
        return false;
    }

    else if(goals == ""){
        msg.innerHTML = "Goals required!";
        return false;
    }

    return true;
}
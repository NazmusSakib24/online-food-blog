function menu_val(){

    let restaurant_id = document.getElementById("restaurant_id").value;
    let name = document.getElementById("name").value;
    let description = document.getElementById("description").value;
    let price = document.getElementById("price").value;
    let image = document.getElementById("image").value;

    let msg = document.getElementById("msg");

    if(name == ""){
        msg.innerHTML = "Item name required!";
        return false;
    }

    else if(description == ""){
        msg.innerHTML = "Description required!";
        return false;
    }

    else if(price == ""){
        msg.innerHTML = "Price required!";
        return false;
    }

    else if(isNaN(price) || price <= 0){
        msg.innerHTML = "Price must be greater than 0!";
        return false;
    }

    else if(image == ""){
        msg.innerHTML = "Image required!";
        return false;
    }

    return true;
}
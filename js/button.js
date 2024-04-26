var count = 0;
document.getElementById("myButton").onclick = function () {
    count++;
    if (count % 2 == 0){
        document.getElementById("demo").innerHTML = ""
    } else {
        var img = document.createElement("img");
        img.src = "https://img.freepik.com/free-photo/sleepy-domestic-cat-sofa_1303-21750.jpg?t=st=1714051842~exp=1714055442~hmac=e0f143382f7fc5b1dd7b7b91c6439e4ec2be627eb3b28b750ea315e993fcbde7&w=740"
        document.getElementById("demo").appendChild(img)
        
        
    }
}
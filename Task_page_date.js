let today = new Date();
let date = today.getFullYear() + "-";

if (today.getMonth()+1 < 10)
    date += `0${today.getMonth()+1}-`;
else date += (today.getMonth()+1)+'-';

if (today.getDate() < 10)
    date += `0${today.getDate()}`;
else date += (today.getDate());

let a = document.getElementsByClassName("today");

console.log(a)

for (let i = 0; i < a.length; i++) {
  //a.setAttribute("min", today.toISOString().substr(0, 10));;
}

function SetTime(){
    today = new Date()
    let time;
    if (date == a.value)
        time = today.getHours() + ":" + today.getMinutes();
    else time = "00:00"

    b = document.getElementsByClassName("now")

    for (let k = 0; k < ab.length; k++) {
        b[k].setAttribute("min", time);;
    }
    
    console.log(time);
}
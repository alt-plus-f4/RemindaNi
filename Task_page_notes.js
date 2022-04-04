function addTask() {
    const form = document.createElement("form");
    form.setAttribute('class', "input-box");
    form.setAttribute('action', "Login_page.html");
    form.setAttribute('method', "post");

    const title = document.createElement("input");
    title.setAttribute('type', "text");
    title.setAttribute('class', "title");
    title.setAttribute('placeholder',"Enter title");
    title.setAttribute('required', '');

    const today = document.createElement("input");
    today.setAttribute('type', "date");
    today.setAttribute('class', "today");
    today.setAttribute('onchange', "SetTime()");
    today.setAttribute('required', '');

    const now = document.createElement("input");
    now.setAttribute('type', "time");
    now.setAttribute('class', "now");
    now.setAttribute('value', "23:59");
    now.setAttribute('min', "7:00:00");
    now.setAttribute('required', '');

    const discription = document.createElement("input");
    discription.setAttribute('type', "text");
    discription.setAttribute('class', "note");
    discription.setAttribute('required', '');
    discription.setAttribute('placeholder', "Some discription");

    const submit = document.createElement("input");
    submit.setAttribute('type', "submit");
    submit.setAttribute('value', "submit");
    submit.setAttribute('class', "submit");

    const deleat = document.createElement("button");
    deleat.setAttribute('type', "button");
    deleat.setAttribute('class', "deleat-button");
    deleat.setAttribute('onclick', "removeTask()");
    deleat.innerHTML = "X";

    form.appendChild(deleat);
    form.appendChild(title);
    form.appendChild(today);
    form.appendChild(now);
    form.appendChild(discription);
    form.appendChild(submit);

    const target = document.querySelector('#add-task-button');

    document.getElementById("add-task-box").insertBefore(form, target);
} 

function removeTask(id)
{
    const element = document.getElementById(id);
    element.remove();
}
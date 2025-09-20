const openTab = (e, content) => {
    let tabcontent = document.getElementsByClassName("tabcontent");
    let tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    for (i = 0; i < tablinks.length; i++) {
        console.log(tablinks[i].classList.remove("tabcontent-active"));
        tablinks[i].className = tablinks[i].className.replace(
            "tabcontent-active",
            ""
        );
    }

    document.getElementById(content).style.display = "block";
    e.currentTarget.className += "tabcontent-active";
};

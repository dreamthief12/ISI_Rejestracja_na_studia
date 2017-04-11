function logout()
{
    alert("Logged out");
}


function fill_menu(privileges)
{
    var menu = document.getElementById("user_menu");
    var menu_buttons = {};
    if(privileges == 1) // Student
        menu_buttons = {"Rekrutacja": "../after_login/rectrutation.html", "Edycja danych": "../after_login/data_edit.html",
        "Wyniki Matur": "../after_login/exam_results.html", "Wybór kierunku": "../after_login/studies.html",
        "Moje finanse": "../after_login/my_finances.html", "Nasza oferta": "../after_login/studing_offers.html"};
    else if(privileges == 2) // Czlonek komisji rekrutacyjnej
        menu_buttons = {"Weryfikuj studenta": "../after_login/student_verification.html"};
    else if(privileges == 3) // Sekretarz komisji uczelnianej
        menu_buttons = {"Protokoły rekrutacyjne": "../after_login/protocols.html"};
    else if(privileges == 4) // Sekretarz komisji wydziałowej
        menu_buttons = {"Protokoły rekrutacyjne": "../after_login/protocols.html", "Ustal ilość miejsc rezerwowych": "../after_login/reserve.html"};
    else if(privileges == 5) // Dziekan Wydziału
        menu_buttons = {"Ustal limit osób": "../after_login/students_limit.html", "Ustal ilość miejsc rezerwowych": "../after_login/reserve.html"};
    else if(privileges == 6) // Administrator
        menu_buttons = {"Panel administratora": "../after_login/administration_panel"};

    for(i=0; i < Object.keys(menu_buttons).length; i++)
        {
            var li = document.createElement('li');
            var a = document.createElement('a');
            a.innerHTML = Object.keys(menu_buttons)[i];
            a.href = menu_buttons[Object.keys(menu_buttons)[i]]
            li.appendChild(a);
            menu.appendChild(li);
        }

}

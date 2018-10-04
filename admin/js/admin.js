//Default Apps Filter
function mo_oauth_client_default_apps_input_filter() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("mo_oauth_client_default_apps_input");
    filter = input.value.toUpperCase();
    ul = document.getElementById("mo_oauth_client_default_apps");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
		console.log(a.innerHTML);
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
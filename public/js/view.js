var root = $("#app")[0];
var WebApi = window.WebApi;
var TYPE = 'emails';


function showError(text) {
    var span = f("span").addClass("text-danger")[0];
    span.innerText = text;
    if (root.firstChild)
        root.insertBefore(span, root.firstChild);
    else root.appendChild(span);
}

function deleteCard(e) {
    var el = e.currentTarget;
    var id = el.getAttribute("data-id");
    if (confirm('Delete this message?')) {
        WebApi.deleteJsonData(TYPE, id, function(err) {
            if (err) showError(err.message);
            else el.parentElement.parentElement.remove();
        });
    }
}

function deleteButton(id) {
    var a = f('button')[0];
    a.className = "btn float-right btn-outline-danger";
    a.onclick = deleteCard;
    console.log(a.onclick, deleteCard);
    a.innerText = "Delete";
    a.setAttribute("data-id", id);
    return a;
}
function showEmpty(){
    var span = "<h5 class='m-4'>No new messages</h5>";
    root.innerHTML = span;
}
function refreshView(data) {
    root.innerHTML = "";
    if(data.length<1){
        showEmpty();
    }
    else data.reverse().forEach(function(e) {
        var id = e.id;
        try {
            e = e.data();
        } catch (err) {
            e = "Error parsing data";
        }
        var card = f('div')[0];
        card.className = "card m-2 p-1";
        var body = f("div")[0];
        body.appendChild(createDataView(e));
        body.appendChild(deleteButton(id));
        card.appendChild(body);
        root.appendChild(card);
    });
}

function f(tag) {
    return $(document.createElement(tag));
}

function createDataView(data) {
    if (data && typeof data == 'object') {
        var body = f("table");
        body.attr('class', 'table table-striped');
        for (var i in data) {
            body[0].appendChild(createKeyVal(i, data[i]));
        }
        return body[0];
    } else return document.createTextNode(String(data));

}

function createKeyVal(key, val) {
    var td = f('td');
    td.addClass('result-key');
    td.text(key);
    var cont = f('td');
    cont.addClass('result-value');
    cont[0].appendChild(createDataView(val));
    var tr = f("tr")[0];
    tr.appendChild(td[0]);
    tr.appendChild(cont[0]);
    return tr;
}

if (window.$_DATA_) {
    refreshView(WebApi.inflate(window.$_DATA_));
} else {
    WebApi.listJsonData(TYPE, function(err, list) {
        if (err) {
            showError(err.message);
        } else refreshView(list);
    });
}
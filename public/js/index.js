$("#fetch-all").click(function() {
    let endpoint = "api/children";
    let params = $("#categories").serialize();
    fetchData(endpoint, params);
});

function buildResultHtml(data) {
    let html = "";

    data.forEach(row => {
        html += `<tr>
        <td>${row.age}</td>
        <td>${row.sex}</td>
        <td>${row.ethnicity}</td>
        <td>${row.health_status}</td>
        <tr>`;
    });

    return html;
}

$("#link-previous").on("click", function() {
    let endpoint = $(this).attr("data-href");
    let params = $("#categories").serialize();

    fetchData(endpoint, params);
});

$("#link-next").on("click", function() {
    let endpoint = $(this).attr("data-href");
    let params = $("#categories").serialize();

    fetchData(endpoint, params);
});

function fetchData(endpoint, params) {
    $.get(endpoint, params, function(response) {
        let tableRows = buildResultHtml(response.data);
        let table = `
        <h3>Total results ${response.total}</h3>
        <table width="100%">
            <thead>
                <td>Age</td>
                <td>Sex</td>
                <td>Ethnicity</td>
                <td>Health status</td>
            </thead>
            <tbody>${tableRows}</tbody>
        <html>`;

        $("#data-container").html(table);
        $("#results").show();

        if (response.prev_page_url != null) {
            $("#link-previous")
                .attr("data-href", response.prev_page_url)
                .show();
        } else {
            $("#link-previous").hide();
        }
        if (response.next_page_url != null) {
            $("#link-next")
                .attr("data-href", response.next_page_url)
                .show();
        } else {
            $("#link-next").hide();
        }

        //In case of the navigation butto being used,
        // scroll back to the top of the page
        window.scrollTo(0, 0);
    });
}

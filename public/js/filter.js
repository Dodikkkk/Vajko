var params = new URLSearchParams(document.location.search);
var search = params.get("search")??"";
var year = +params.get('year')??0;
var order = +params.get('order')??0;
document.getElementById('search').value = search;
if (year !== 0 && document.getElementById('yearBtn')) {
    document.getElementById('yearBtn').textContent = String(year);
    document.getElementById('year' + year)?.classList.add("active");
}
if (order > 0 && order < 6 && document.getElementById('orderBtn')) {
    document.getElementById('orderBtn').textContent = [
        "Alphabetically", "Rating - Best", "Rating - Worst", "Newest", "Oldest"
    ][order - 1];
    document.getElementById('order' + order)?.classList.add("active");
} else {
    order = 0;
}
function updateSearchFromFilters()
{
    search = document.getElementById('search').value;
    updateFilter();
}

function updateYearFilter(y)
{
    year = y;
    updateFilter();
}

function updateFilter()
{
    var params = "?c=home";
    if (search) {
        params += "&search=" + encodeURIComponent(search);
    }
    if (year > 0) {
        params += "&year=" + year;
    }
    if (order > 0) {
        params += "&order=" + order;
    }
    document.location.href = params;
}

function updateOrderFilter(o)
{
    order = o;
    updateFilter();
}